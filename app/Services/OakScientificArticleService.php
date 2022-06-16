<?php

namespace App\Services;

use App\Constants\MediaCollectionsConstant;
use App\Constants\UserRoles;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\OakScientificArticle;
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
 * Class OakOakScientificArticleService
 * @package App\Services
 */
class OakScientificArticleService
{
    /**
     * @return LengthAwarePaginator
     */
    public function fetchWithPagination(): LengthAwarePaginator
    {
        /** @var User $user */
        $user = auth()->user();

        return QueryBuilder::for(OakScientificArticle::with(['users', 'magazine']))
            ->where('is_confirmed', '=', true)
            ->when(!auth()->user()->hasRole(UserRoles::SUPER_ADMIN), function (Builder $query) use ($user) {
                $query->whereHas('users', function (Builder $query) use ($user) {
                    $query->where('oak_scientific_article_users.user_id', '=', $user->id);
                });
            })
            ->allowedFilters([
                AllowedFilter::custom('user', new UsersRelationFilter)
            ])
            ->defaultSort('id')
            ->allowedSorts([
                'title',
                AllowedSort::custom('magazine', new MagazineSorts, 'oak_scientific_articles'),
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

        return QueryBuilder::for(OakScientificArticle::with(['users', 'magazine']))
            ->defaultSort('id')
            ->when(!auth()->user()->hasRole(UserRoles::SUPER_ADMIN), function (Builder $query) use ($user) {
                $query->whereHas('users', function (Builder $query) use ($user) {
                    $query->where('oak_scientific_article_users.user_id', '=', $user->id);
                });
            })
            ->where('is_confirmed', '=', false)
            ->get();
    }

    /**
     * @param array $validated
     * @return OakScientificArticle
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function create(array $validated): OakScientificArticle
    {
        $magazine = (new ListService())->getMagazineByTitle($validated['magazine_name']);
        $validated['magazine_id'] = $magazine->id;

        /** @var OakScientificArticle $article */
        $article = OakScientificArticle::query()->create($validated);

        $article->users()->sync(array_unique($validated['users']));

        $this->attachFile($validated['file'], $article);

        return $article->load(['users', 'magazine']);
    }

    /**
     * @param OakScientificArticle $article
     * @param array $validated
     * @return OakScientificArticle
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(OakScientificArticle $article, array $validated): OakScientificArticle
    {
        $magazine = (new ListService())->getMagazineByTitle($validated['magazine_name']);
        $validated['magazine_id'] = $magazine->id;

        /** @var OakScientificArticle $article */
        $article = tap($article)->update($validated);

        if (auth()->user()->hasRole(UserRoles::SUPER_ADMIN)) {
            $article->users()->sync($validated['users']);
        }

        if (isset($validated['file'])) {
            $this->attachFile($validated['file'], $article);
        }

        return $article->load(['users', 'magazine']);
    }

    /**
     * @param UploadedFile $file
     * @param OakScientificArticle $article
     * @return OakScientificArticle
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function attachFile(UploadedFile $file, OakScientificArticle $article): OakScientificArticle
    {
        if ($f = $article->getFirstMedia(MediaCollectionsConstant::OAK_SCIENTIFIC_ARTICLE_FILE)) {
            $f->delete();
        }

        $article->addMedia($file)->toMediaCollection(MediaCollectionsConstant::OAK_SCIENTIFIC_ARTICLE_FILE);

        return $article;
    }

    /**
     * @param OakScientificArticle $article
     * @return bool
     */
    public function confirm(OakScientificArticle $article): bool
    {
        return $article->update([
            'is_confirmed' => true
        ]);
    }

    /**
     * @param OakScientificArticle $article
     * @return bool|null
     */
    public function delete(OakScientificArticle $article): ?bool
    {
        return $article->delete();
    }

    /**
     * @param OakScientificArticle $article
     * @return bool|null
     */
    public function forceDelete(OakScientificArticle $article): ?bool
    {
        return $article->forceDelete();
    }

    /**
     * @return CollectionAlias
     */
    public function getReport(): CollectionAlias
    {
        $year = request('year');
        $articles_count = OakScientificArticle::query()
            ->where('is_confirmed', '=', true)
            ->when($year, function (Builder $query) use ($year) {
                $query->where('publish_year', '=', $year);
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
                    ->oakScientificArticles()
                    ->where('oak_scientific_articles.is_confirmed', '=', true)
                    ->when($year, function (Builder $query) use ($year) {
                        $query->where('oak_scientific_articles.publish_year', '=', $year);
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
        $articles_count = OakScientificArticle::query()
            ->join('oak_scientific_article_users', 'oak_scientific_articles.id', '=', 'oak_scientific_article_users.oak_scientific_article_id')
            ->join('users', 'oak_scientific_article_users.user_id', '=', 'users.id')
            ->where('users.faculty_id', '=', $faculty)
            ->where('is_confirmed', '=', true)
            ->when($year, function (Builder $query) use ($year) {
                $query->where('oak_scientific_articles.publish_year', '=', $year);
            })
            ->groupBy('oak_scientific_articles.id')
            ->get('oak_scientific_articles.id')->count();

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
                    ->oakScientificArticles()
                    ->where('oak_scientific_articles.is_confirmed', '=', true)
                    ->when($year, function (Builder $query) use ($year) {
                        $query->where('oak_scientific_articles.publish_year', '=', $year);
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
