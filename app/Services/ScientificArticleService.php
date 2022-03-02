<?php

namespace App\Services;

use App\Models\ScientificArticle;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
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
        return QueryBuilder::for(ScientificArticle::with(['users', 'magazine', 'country']))
            ->where('is_confirmed', '=', true)
            ->paginate();
    }

    /**
     * @return Collection|QueryBuilder[]
     */
    public function getNotConfirmedArticlesList()
    {

        return QueryBuilder::for(ScientificArticle::with(['users', 'magazine', 'country']))
            ->where('is_confirmed', '=', false)
            ->get();
    }

    /**
     * @param array $validated
     * @return ScientificArticle
     */
    public function create(array $validated): ScientificArticle
    {
        $magazine = (new ListService())->getMagazineByTitle($validated['magazine_name']);
        $validated['magazine_id'] = $magazine->id;

        $country = (new ListService())->getCountryByName($validated['country_name']);
        $validated['country_id'] = $country->id;

        /** @var ScientificArticle $article */
        $article = ScientificArticle::query()->create($validated);

        $validated['users'] = $validated['users'] ?? [auth()->id()];

        $article->users()->sync($validated['users']);

        return $article->load(['users', 'magazine', 'country']);
    }

    /**
     * @param ScientificArticle $article
     * @param array $validated
     * @return ScientificArticle
     */
    public function update(ScientificArticle $article, array $validated): ScientificArticle
    {
        $magazine = (new ListService())->getMagazineByTitle($validated['magazine_name']);
        $validated['magazine_id'] = $magazine->id;

        $country = (new ListService())->getCountryByName($validated['country_name']);
        $validated['country_id'] = $country->id;

        /** @var ScientificArticle $article */
        $article = tap($article)->update($validated);

        /** @var User $user */
        $user = auth()->user();

        if ($user->post == 1) {
            $validated['users'] = $validated['users'] ?? [$user->id];
            $article->users()->sync($validated['users']);
        }


        return $article->load(['users', 'magazine', 'country']);
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

    public function delete(ScientificArticle $article)
    {
        $article->delete();
    }
}
