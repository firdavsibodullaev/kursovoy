<?php

namespace App\Services;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\ScientificArticleCitation;
use App\Models\User;
use App\Spatie\Filters\UsersRelationFilter;
use App\Spatie\Sorts\MagazineSorts;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as CollectionAlias;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Concerns\SortsQuery;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class ScientificArticleCitationService
 * @package App\Services
 */
class ScientificArticleCitationService
{
    /**
     * @return LengthAwarePaginator
     */
    public function fetchWithPagination(): LengthAwarePaginator
    {
        /** @var User $user */
        $user = auth()->user();

        return QueryBuilder::for(ScientificArticleCitation::with(['users', 'magazine']))
            ->defaultSort('id')
            ->allowedFilters([
                AllowedFilter::custom('user', new UsersRelationFilter)
            ])
            ->when(!is_super_admin(), function (Builder $query) use ($user) {
                $query->whereHas('users', function (Builder $query) use ($user) {
                    $query->where('user_id', '=', $user->id);
                });
            })
            ->where('is_confirmed', '=', true)
            ->allowedSorts([
                'id',
                'article_title',
                AllowedSort::custom('magazine', new MagazineSorts, 'scientific_article_citations'),
                'magazine_publish_date',
                'citations_count'
            ])
            ->paginate()
            ->withQueryString();
    }

    /**
     * @return Collection|QueryBuilder[]|SortsQuery[]
     */
    public function getNotConfirmedArticlesList()
    {
        return QueryBuilder::for(ScientificArticleCitation::with(['users', 'magazine']))
            ->defaultSort('id')
            ->where('is_confirmed', '=', false)
            ->allowedSorts([
                'article_title',
            ])
            ->get();
    }

    /**
     * @param array $validated
     * @return ScientificArticleCitation
     */
    public function create(array $validated): ScientificArticleCitation
    {

        $magazine = (new ListService())->getMagazineByTitle($validated['magazine_name']);

        $validated['magazine_id'] = $magazine->id;

        /** @var ScientificArticleCitation $articleCitation */
        $articleCitation = ScientificArticleCitation::query()->create($validated);

        $users = $validated['users'];

        $articleCitation->users()->sync(array_unique($users));

        return $articleCitation->load(['users', 'magazine']);
    }

    /**
     * @param ScientificArticleCitation $articleCitation
     * @param array $validated
     * @return ScientificArticleCitation
     */
    public function update(ScientificArticleCitation $articleCitation, array $validated): ScientificArticleCitation
    {
        $magazine = (new ListService())->getMagazineByTitle($validated['magazine_name']);
        $validated['magazine_id'] = $magazine->id;

        /** @var ScientificArticleCitation $articleCitation */
        $articleCitation = tap($articleCitation)->update($validated);

        if (is_super_admin()) {
            $users = $validated['users'] ?? [auth()->id()];
            $articleCitation->users()->sync($users);
        }

        return $articleCitation->load(['users', 'magazine']);
    }

    /**
     * @param ScientificArticleCitation $articleCitation
     * @return mixed
     */
    public function confirm(ScientificArticleCitation $articleCitation)
    {
        return tap($articleCitation)->update([
            'is_confirmed' => true
        ]);
    }

    /**
     * @param ScientificArticleCitation $articleCitation
     * @return bool|null
     */
    public function delete(ScientificArticleCitation $articleCitation): ?bool
    {
        return $articleCitation->delete();
    }

    /**
     * @param ScientificArticleCitation $articleCitation
     * @return bool|null
     */
    public function forceDelete(ScientificArticleCitation $articleCitation): ?bool
    {
        return $articleCitation->forceDelete();
    }

    /**
     * @return CollectionAlias
     */
    public function getReport(): CollectionAlias
    {
        $year = request('year');
        $articles_count = ScientificArticleCitation::query()
            ->where('is_confirmed', '=', true)
            ->when($year, function (Builder $query) use ($year) {
                $query->whereYear('magazine_publish_date', '=', $year);
            })
            ->count();
        $faculties = Faculty::query()->with('users.scientificArticleCitations')->get();
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
                    ->scientificArticleCitations()
                    ->where('scientific_article_citations.is_confirmed', '=', true)
                    ->when($year, function (Builder $query) use ($year) {
                        $query->whereYear('magazine_publish_date', '=', $year);
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
        $articles_count = ScientificArticleCitation::query()
            ->join('scientific_article_citation_user', 'scientific_article_citations.id', '=', 'scientific_article_citation_user.scientific_article_citation_id')
            ->join('users', 'scientific_article_citation_user.user_id', '=', 'users.id')
            ->where('users.faculty_id', '=', $faculty)
            ->where('is_confirmed', '=', true)
            ->when($year, function (Builder $query) use ($year) {
                $query->whereYear('scientific_article_citations.magazine_publish_date', '=', $year);
            })
            ->count('scientific_article_citations.*');

        $departments = Department::query()
            ->with('users.scientificArticleCitations')
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
                    ->scientificArticleCitations()
                    ->where('scientific_article_citations.is_confirmed', '=', true)
                    ->when($year, function (Builder $query) use ($year) {
                        $query->whereYear('scientific_article_citations.magazine_publish_date', '=', $year);
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
