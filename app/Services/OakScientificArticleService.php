<?php

namespace App\Services;

use App\Constants\MediaCollectionsConstant;
use App\Models\OakScientificArticle;
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
            ->when(!is_super_admin(), function (Builder $query) use ($user) {
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
        return QueryBuilder::for(OakScientificArticle::with(['users', 'magazine']))
            ->defaultSort('id')
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

        if (is_super_admin()) {
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
}
