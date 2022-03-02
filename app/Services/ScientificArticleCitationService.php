<?php

namespace App\Services;

use App\Models\Magazine;
use App\Models\ScientificArticleCitation;
use App\Models\User;
use App\Spatie\Sorts\MagazineSorts;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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
            ->when($user->post !== 1, function (Builder $query) use ($user) {
                $query->whereHas('users', function (Builder $query) use ($user) {
                    $query->where('user_id', '=', $user->id);
                });
            })
            ->where('is_confirmed', '=', true)
            ->allowedSorts([
                'article_title',
                AllowedSort::custom('magazine', new MagazineSorts),
                'magazine_publish_date',
                'citations_count'
            ])
            ->paginate();
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

        $magazine = $this->getMagazine($validated['magazine_name']);

        $validated['magazine_id'] = $magazine->id;

        /** @var ScientificArticleCitation $articleCitation */
        $articleCitation = ScientificArticleCitation::query()->create($validated);

        if (isset($validated['users'])) {
            $users = $validated['users'];
            $users[] = auth()->id();
        } else {
            $users = [auth()->id()];
        }

        $articleCitation->users()->sync($users);

        return $articleCitation->load(['users', 'magazine']);
    }

    /**
     * @param ScientificArticleCitation $articleCitation
     * @param array $validated
     * @return ScientificArticleCitation
     */
    public function update(ScientificArticleCitation $articleCitation, array $validated): ScientificArticleCitation
    {
        $magazine = $this->getMagazine($validated['magazine_name']);
        $validated['magazine_id'] = $magazine->id;

        /** @var ScientificArticleCitation $articleCitation */
        $articleCitation = tap($articleCitation)->update($validated);

        if (isset($validated['users'])) {
            $users = $validated['users'];
            $users[] = auth()->id();
        } else {
            $users = [auth()->id()];
        }
        $articleCitation->users()->sync($users);

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
     * @return void
     */
    public function delete(ScientificArticleCitation $articleCitation)
    {
        $articleCitation->delete();
    }

    /**
     * @return Collection|QueryBuilder[]
     */
    public function getMagazinesList()
    {
        return QueryBuilder::for(Magazine::class)->get();
    }

    /**
     * @param string $magazine
     * @return Builder|Model
     */
    protected function getMagazine(string $magazine)
    {
        return Magazine::query()->firstOrCreate([
            'title' => $magazine
        ]);
    }
}
