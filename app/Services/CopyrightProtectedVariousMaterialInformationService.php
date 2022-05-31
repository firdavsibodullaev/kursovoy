<?php

namespace App\Services;

use App\Constants\MediaCollectionsConstant;
use App\Models\CopyrightProtectedVariousMaterialInformation;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as CollectionAlias;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class CopyrightProtectedVariousMaterialInformationService
 * @package App\Services
 */
class CopyrightProtectedVariousMaterialInformationService
{
    public function fetchWithPagination(): LengthAwarePaginator
    {
        /** @var User $user */
        $user = auth()->user();
        return QueryBuilder::for(CopyrightProtectedVariousMaterialInformation::with(['institute', 'users', 'file']))
            ->where('is_confirmed', '=', true)
            ->when(!is_super_admin(), function (Builder $query) use ($user) {
                $query->whereHas('users', function (Builder $query) use ($user) {
                    $query->where('copyright_protected_various_material_information_users.user_id', '=', $user->id);
                });
            })
            ->paginate();
    }

    /**
     * @return Collection
     */
    public function getNotConfirmedArticlesList(): Collection
    {
        return CopyrightProtectedVariousMaterialInformation::query()->with(['institute', 'users', 'file'])
            ->where('is_confirmed', '=', false)
            ->get();
    }

    /**
     * @param array $validated
     * @return CopyrightProtectedVariousMaterialInformation
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function create(array $validated): CopyrightProtectedVariousMaterialInformation
    {
//        $institute = (new ListService())->getInstituteByName($validated['institute_name']);
//        $validated['institute_id'] = $institute->id;

        /** @var CopyrightProtectedVariousMaterialInformation $copyright */
        $copyright = CopyrightProtectedVariousMaterialInformation::query()->create($validated);

        $copyright->users()->sync($validated['users']);

        $copyright->addMedia($validated['file'])->toMediaCollection(MediaCollectionsConstant::COPYRIGHT);

        return $copyright->load(['users', 'institute', 'file']);
    }

    /**
     * @param CopyrightProtectedVariousMaterialInformation $information
     * @param array $validated
     * @return CopyrightProtectedVariousMaterialInformation
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(CopyrightProtectedVariousMaterialInformation $information, array $validated): CopyrightProtectedVariousMaterialInformation
    {
//        $institute = (new ListService())->getInstituteByName($validated['institute_name']);
//        $validated['institute_id'] = $institute->id;
        /** @var CopyrightProtectedVariousMaterialInformation $copyright */
        $copyright = tap($information)->update($validated);

        if (is_super_admin()) {
            $copyright->users()->sync($validated['users']);
        }

        if (isset($validated['file'])) {
            $copyright->getFirstMedia(MediaCollectionsConstant::COPYRIGHT)->delete();
            $copyright->addMedia($validated['file'])->toMediaCollection(MediaCollectionsConstant::COPYRIGHT);
        }
        return $copyright->load(['institute', 'users', 'file']);
    }

    /**
     * @param CopyrightProtectedVariousMaterialInformation $information
     * @return bool
     */
    public function confirm(CopyrightProtectedVariousMaterialInformation $information): bool
    {
        return $information->update([
            'is_confirmed' => true,
            'confirmed_at' => now()
        ]);
    }

    /**
     * @param CopyrightProtectedVariousMaterialInformation $information
     * @return bool|null
     */
    public function delete(CopyrightProtectedVariousMaterialInformation $information): ?bool
    {
        return $information->delete();
    }

    /**
     * @return CollectionAlias
     */
    public function getReport(): CollectionAlias
    {
        $year = request('year');
        $articles_count = CopyrightProtectedVariousMaterialInformation::query()
            ->where('is_confirmed', '=', true)
            ->when($year, function (Builder $query) use ($year) {
                $query->whereYear('date', '=', $year);
            })
            ->count();
        $faculties = Faculty::query()->with('users.copyrightProtectedVariousMaterialInformation')->get();
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
                    ->copyrightProtectedVariousMaterialInformation()
                    ->where('copyright_protected_various_material_information.is_confirmed', '=', true)
                    ->when($year, function (Builder $query) use ($year) {
                        $query->whereYear('copyright_protected_various_material_information.date', '=', $year);
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
        $articles_count = CopyrightProtectedVariousMaterialInformation::query()
            ->join('copyright_protected_various_material_information_users', 'copyright_protected_various_material_information.id', '=', 'copyright_protected_various_material_information_users.copyright_protected_various_material_information_id')
            ->join('users', 'copyright_protected_various_material_information_users.user_id', '=', 'users.id')
            ->where('users.faculty_id', '=', $faculty)
            ->where('is_confirmed', '=', true)
            ->when($year, function (Builder $query) use ($year) {
                $query->whereYear('copyright_protected_various_material_information.date', '=', $year);
            })
            ->count('copyright_protected_various_material_information.*');

        $departments = Department::query()
            ->with('users.copyrightProtectedVariousMaterialInformation')
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
                    ->copyrightProtectedVariousMaterialInformation()
                    ->where('copyright_protected_various_material_information.is_confirmed', '=', true)
                    ->when($year, function (Builder $query) use ($year) {
                        $query->whereYear('copyright_protected_various_material_information.date', '=', $year);
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
