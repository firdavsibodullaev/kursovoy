<?php

namespace App\Services;

use App\Constants\MediaCollectionsConstant;
use App\Constants\UserRoles;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\ScientificArticle;
use App\Models\User;
use App\Spatie\Filters\UsersRelationFilter;
use App\Spatie\Sorts\MagazineSorts;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection as CollectionAlias;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class ScientificArticleService
 * @package App\Services
 */
class ScientificArticleService
{
    /**
     * @return LengthAwarePaginator
     */
    public function fetchWithPagination(): LengthAwarePaginator
    {
        /** @var User $user */
        $user = auth()->user();

        return QueryBuilder::for(ScientificArticle::with(['users', 'magazine', 'country']))
            ->where('is_confirmed', '=', true)
            ->when(!is_super_admin(), function (Builder $query) use ($user) {
                $query->whereHas('users', function (Builder $query) use ($user) {
                    $query->where('scientific_article_users.user_id', '=', $user->id);
                });
            })
            ->allowedFilters([
                AllowedFilter::custom('user', new UsersRelationFilter)
            ])
            ->defaultSort('id')
            ->allowedSorts([
                'title',
                AllowedSort::custom('magazine', new MagazineSorts, 'scientific_articles'),
                'publish_year'
            ])
            ->paginate()
            ->withQueryString();
    }

    /**
     * @return Collection|QueryBuilder[]
     */
    public function getNotConfirmedArticlesList()
    {
        /** @var User $user */
        $user = auth()->user();

        return QueryBuilder::for(ScientificArticle::with(['users', 'magazine', 'country']))
            ->defaultSort('id')
            ->where('is_confirmed', '=', false)
            ->when(!is_super_admin(), function (Builder $query) use ($user) {
                $query->whereHas('users', function (Builder $query) use ($user) {
                    $query->where('scientific_article_users.user_id', '=', $user->id);
                });
            })
            ->get();
    }

    /**
     * @param array $validated
     * @return ScientificArticle
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function create(array $validated): ScientificArticle
    {
        $magazine = (new ListService())->getMagazineByTitle($validated['magazine_name']);
        $validated['magazine_id'] = $magazine->id;

        $country = (new ListService())->getCountryByName($validated['country_name']);
        $validated['country_id'] = $country->id;

        /** @var ScientificArticle $article */
        $article = ScientificArticle::query()->create($validated);

        $article->users()->sync(array_unique($validated['users']));

        $this->attachFile($validated['file'], $article);

        return $article->load(['users', 'magazine', 'country']);
    }

    /**
     * @param ScientificArticle $article
     * @param array $validated
     * @return ScientificArticle
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(ScientificArticle $article, array $validated): ScientificArticle
    {
        $magazine = (new ListService())->getMagazineByTitle($validated['magazine_name']);
        $validated['magazine_id'] = $magazine->id;

        $country = (new ListService())->getCountryByName($validated['country_name']);
        $validated['country_id'] = $country->id;

        /** @var ScientificArticle $article */
        $article = tap($article)->update($validated);

        if (is_super_admin()) {
            $article->users()->sync($validated['users']);
        }

        if (isset($validated['file'])) {
            $this->attachFile($validated['file'], $article);
        }

        return $article->load(['users', 'magazine', 'country']);
    }

    /**
     * @param UploadedFile $file
     * @param ScientificArticle $article
     * @return ScientificArticle
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function attachFile(UploadedFile $file, ScientificArticle $article): ScientificArticle
    {
        if ($f = $article->getFirstMedia(MediaCollectionsConstant::SCIENTIFIC_ARTICLE_FILE)) {
            $f->delete();
        }

        $article->addMedia($file)->toMediaCollection(MediaCollectionsConstant::SCIENTIFIC_ARTICLE_FILE);

        return $article;
    }

    /**
     * @param ScientificArticle $article
     * @return bool
     */
    public function confirm(ScientificArticle $article): bool
    {
        return $article->update([
            'is_confirmed' => true
        ]);
    }

    /**
     * @param ScientificArticle $article
     * @return bool|null
     */
    public function delete(ScientificArticle $article): ?bool
    {
        return $article->delete();
    }

    /**
     * @param ScientificArticle $article
     * @return bool|null
     */
    public function forceDelete(ScientificArticle $article): ?bool
    {
        return $article->forceDelete();
    }

    /**
     * @return CollectionAlias
     */
    public function getReport(): CollectionAlias
    {
        $year = request('year');
        $articles_count = ScientificArticle::query()
            ->where('is_confirmed', '=', true)
            ->when($year, function (Builder $query) use ($year) {
                $query->where('publish_year', '=', $year);
            })
            ->count();
        $faculties = Faculty::query()->with('users.scientificArticles')->get();
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
                    ->scientificArticles()
                    ->where('scientific_articles.is_confirmed', '=', true)
                    ->when($year, function (Builder $query) use ($year) {
                        $query->where('publish_year', '=', $year);
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
        $articles_count = ScientificArticle::query()
            ->join('scientific_article_users', 'scientific_articles.id', '=', 'scientific_article_users.scientific_article_id')
            ->join('users', 'scientific_article_users.user_id', '=', 'users.id')
            ->where('users.faculty_id', '=', $faculty)
            ->where('is_confirmed', '=', true)
            ->when($year, function (Builder $query) use ($year) {
                $query->where('scientific_articles.publish_year', '=', $year);
            })
            ->groupBy('scientific_articles.id')
            ->get('scientific_articles.id')->count();

        $departments = Department::query()
            ->with('users.scientificArticles')
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
                    ->scientificArticles()
                    ->where('scientific_articles.is_confirmed', '=', true)
                    ->when($year, function (Builder $query) use ($year) {
                        $query->where('scientific_articles.publish_year', '=', $year);
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
