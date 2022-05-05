<?php

namespace App\Services;

use App\Constants\MediaCollectionsConstant;
use App\Models\ScientificArticle;
use App\Models\User;
use App\Spatie\Filters\UsersRelationFilter;
use App\Spatie\Sorts\MagazineSorts;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
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

        return QueryBuilder::for(ScientificArticle::with(['users', 'magazine', 'country']))
            ->defaultSort('id')
            ->where('is_confirmed', '=', false)
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
}
