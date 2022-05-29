<?php

namespace App\Services;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\ScientificResearchEffectiveness;
use App\Models\User;
use App\Spatie\Filters\UsersRelationFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection as CollectionAlias;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class ScientificResearchEffectivenessService
 * @package App\Services
 */
class ScientificResearchEffectivenessService
{
    /**
     * @return LengthAwarePaginator
     */
    public function fetchWithPagination(): LengthAwarePaginator
    {
        return QueryBuilder::for(ScientificResearchEffectiveness::with(['users', 'publication']))
            ->defaultSort('id')
            ->allowedFilters([
                AllowedFilter::custom('user', new UsersRelationFilter)
            ])
            ->where('is_confirmed', '=', true)
            ->paginate()
            ->withQueryString();
    }

    /**
     * @param array $validated
     * @return ScientificResearchEffectiveness
     */
    public function create(array $validated): ScientificResearchEffectiveness
    {
        $validated['publication_id'] = (new ListService())->getPublicationByName($validated['publication_name'])->id;

        /** @var ScientificResearchEffectiveness $effectiveness */
        $effectiveness = ScientificResearchEffectiveness::query()->create($validated);

        $effectiveness->users()->sync($validated['users']);

        return $effectiveness->load('users');
    }

    /**
     * @param ScientificResearchEffectiveness $effectiveness
     * @param array $validated
     * @return ScientificResearchEffectiveness
     */
    public function update(ScientificResearchEffectiveness $effectiveness, array $validated): ScientificResearchEffectiveness
    {
        $validated['publication_id'] = (new ListService())->getPublicationByName($validated['publication_name'])->id;

        /** @var ScientificResearchEffectiveness $effectiveness */
        $effectiveness = tap($effectiveness)->update($validated);

        $effectiveness->users()->sync($validated['users']);

        return $effectiveness->load('users');
    }

    /**
     * @param ScientificResearchEffectiveness $effectiveness
     * @return bool|null
     */
    public function delete(ScientificResearchEffectiveness $effectiveness): ?bool
    {
        return $effectiveness->delete();
    }

    /**
     * @return CollectionAlias
     */
    public function getReport(): CollectionAlias
    {
        $year = request('year');
        $articles_count = ScientificResearchEffectiveness::query()
            ->where('is_confirmed', '=', true)
            ->when($year, function (Builder $query) use ($year) {
                $query->where('accepted_date', '=', $year);
            })
            ->count();
        $faculties = Faculty::query()->with('users.oakScientificArticles')->get();
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
                    ->scientificResearchEffectiveness()
                    ->where('scientific_research_effectivenesses.is_confirmed', '=', true)
                    ->when($year, function (Builder $query) use ($year) {
                        $query->where('scientific_research_effectivenesses.accepted_date', '=', $year);
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
        $articles_count = ScientificResearchEffectiveness::query()
            ->join('scientific_research_effectiveness_users', 'scientific_research_effectivenesses.id', '=', 'scientific_research_effectiveness_users.scientific_research_effectiveness_id')
            ->join('users', 'scientific_research_effectiveness_users.user_id', '=', 'users.id')
            ->where('users.faculty_id', '=', $faculty)
            ->where('is_confirmed', '=', true)
            ->when($year, function (Builder $query) use ($year) {
                $query->where('scientific_research_effectivenesses.accepted_date', '=', $year);
            })
            ->count('scientific_research_effectivenesses.*');

        $departments = Department::query()
            ->with('users.oakScientificArticles')
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
                    ->scientificResearchEffectiveness()
                    ->where('scientific_research_effectivenesses.is_confirmed', '=', true)
                    ->when($year, function (Builder $query) use ($year) {
                        $query->where('scientific_research_effectivenesses.accepted_date', '=', $year);
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
