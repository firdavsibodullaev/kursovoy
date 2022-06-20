<?php

namespace App\Services;

use App\Constants\MediaCollectionsConstant;
use App\Constants\UserRoles;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\ObtainedIndustrialSamplePatent;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as CollectionAlias;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class ObtainedIndustrialSamplePatentService
 * @package App\Services
 */
class ObtainedIndustrialSamplePatentService
{
    /**
     * @return LengthAwarePaginator
     */
    public function fetchWithPagination(): LengthAwarePaginator
    {
        /** @var User $user */
        $user = auth()->user();

        return QueryBuilder::for(ObtainedIndustrialSamplePatent::with(['users', 'institute', 'file']))
            ->orderByDesc('date')
            ->when(!auth()->user()->hasRole(UserRoles::SUPER_ADMIN), function (Builder $query) use ($user) {
                $query->whereHas('users', function (Builder $query) use ($user) {
                    $query->where('patent_users.user_id', '=', $user->id);
                });
            })
            ->where('is_confirmed', '=', true)
            ->paginate()
            ->withQueryString();
    }

    /**
     * @return Collection
     */
    public function getNotConfirmedArticlesList(): Collection
    {
        /** @var User $user */
        $user = auth()->user();
        return ObtainedIndustrialSamplePatent::query()->orderByDesc('id')
            ->where('is_confirmed', '=', false)
            ->when(!auth()->user()->hasRole(UserRoles::SUPER_ADMIN), function (Builder $query) use ($user) {
                $query->whereHas('users', function (Builder $query) use ($user) {
                    $query->where('patent_users.user_id', '=', $user->id);
                });
            })
            ->get();
    }

    /**
     * @param array $validated
     * @return ObtainedIndustrialSamplePatent
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function create(array $validated): ObtainedIndustrialSamplePatent
    {
//        $institute = (new ListService())->getInstituteByName($validated['institute_name']);
//
//        $validated['institute_id'] = $institute->id;

        /** @var ObtainedIndustrialSamplePatent $patent */
        $patent = ObtainedIndustrialSamplePatent::query()->create($validated);

        $patent->users()->sync($validated['users']);

        $patent->addMedia($validated['file'])->toMediaCollection(MediaCollectionsConstant::PATENT);

        return $patent->load(['users', 'institute']);
    }

    /**
     * @param ObtainedIndustrialSamplePatent $patent
     * @param array $validated
     * @return ObtainedIndustrialSamplePatent
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(ObtainedIndustrialSamplePatent $patent, array $validated): ObtainedIndustrialSamplePatent
    {
//        $institute = (new ListService())->getInstituteByName($validated['institute_name']);
//
//        $validated['institute_id'] = $institute->id;

        /** @var ObtainedIndustrialSamplePatent $patent */
        $patent = tap($patent)->update($validated);

        if (auth()->user()->hasRole(UserRoles::SUPER_ADMIN)) {
            $patent->users()->sync($validated['users']);
        }

        if (isset($validated['file'])) {
            $patent->getFirstMedia(MediaCollectionsConstant::PATENT)->delete();
            $patent->addMedia($validated['file'])->toMediaCollection(MediaCollectionsConstant::PATENT);
        }

        return $patent->load(['users', 'institute']);
    }

    public function confirm(ObtainedIndustrialSamplePatent $patent)
    {
        $patent->update([
            'is_confirmed' => true,
            'confirmed_at' => now()
        ]);
    }

    /**
     * @param ObtainedIndustrialSamplePatent $patent
     * @return bool|null
     */
    public function destroy(ObtainedIndustrialSamplePatent $patent): ?bool
    {
        return $patent->delete();
    }

    /**
     * @return CollectionAlias
     */
    public function getReport(): CollectionAlias
    {
        $year = request('year');
        $articles_count = ObtainedIndustrialSamplePatent::query()
            ->where('is_confirmed', '=', true)
            ->when($year, function (Builder $query) use ($year) {
                $query->whereYear('date', '=', $year);
            })
            ->count();
        $faculties = Faculty::query()->with('users.obtainedIndustrialSamplePatent')->get();
        $collection = [];
        $collection['labels'] = $faculties->pluck('short_name');
        $collection['datasets'][] = [
            'data' => [],
            'backgroundColor' => []
        ];
        $faculties->each(function (Faculty $faculty) use (&$collection, $year) {
            $temp_number = 0;
            $faculty->users->each(function (User $user) use (&$temp_number, $year) {
                $temp_number += $user
                    ->obtainedIndustrialSamplePatent()
                    ->where('obtained_industrial_sample_patents.is_confirmed', '=', true)
                    ->when($year, function (Builder $query) use ($year) {
                        $query->whereYear('obtained_industrial_sample_patents.date', '=', $year);
                    })
                    ->count();
            });
            $collection['datasets'][0]['data'][] = $temp_number;
            $collection['datasets'][0]['backgroundColor'][] = random_color($collection['datasets'][0]['backgroundColor']);
        });

        return collect([
            'all' => $articles_count,
            'data' => $collection
        ]);
    }

    /**
     * @return CollectionAlias
     */
    public function getReportByFaculty(): CollectionAlias
    {
        $year = request('year');
        $faculty = request('faculty', 1);
        $articles_count = ObtainedIndustrialSamplePatent::query()
            ->join('patent_users', 'obtained_industrial_sample_patents.id', '=', 'patent_users.obtained_industrial_sample_patent_id')
            ->join('users', 'patent_users.user_id', '=', 'users.id')
            ->where('users.faculty_id', '=', $faculty)
            ->where('is_confirmed', '=', true)
            ->when($year, function (Builder $query) use ($year) {
                $query->whereYear('obtained_industrial_sample_patents.date', '=', $year);
            })
            ->groupBy('obtained_industrial_sample_patents.id')
            ->get('obtained_industrial_sample_patents.id')->count();

        $departments = Department::query()
            ->with('users.obtainedIndustrialSamplePatent')
            ->where('faculty_id', '=', $faculty)
            ->get();

        $collection = [];
        $collection['labels'] = $departments->pluck('short_name');

        $collection['datasets'][] = [
            'data' => [],
            'backgroundColor' => []
        ];
        $departments->each(function (Department $department) use (&$collection, $year) {
            $temp_number = 0;
            $department->users->each(function (User $user) use (&$temp_number, $year) {
                $temp_number += $user
                    ->obtainedIndustrialSamplePatent()
                    ->where('obtained_industrial_sample_patents.is_confirmed', '=', true)
                    ->when($year, function (Builder $query) use ($year) {
                        $query->whereYear('obtained_industrial_sample_patents.date', '=', $year);
                    })
                    ->count();
            });
            $collection['datasets'][0]['data'][] = $temp_number;
            $collection['datasets'][0]['backgroundColor'][] = random_color($collection['datasets'][0]['backgroundColor']);
        });

        return collect([
            'all' => $articles_count,
            'data' => $collection
        ]);

    }
}
