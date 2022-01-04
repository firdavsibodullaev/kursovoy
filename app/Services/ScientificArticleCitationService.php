<?php

namespace App\Services;

use App\Models\Journal;
use App\Models\ScientificArticleCitation;
use App\Spatie\Sorts\JournalSorts;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\AllowedSort;
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
        return QueryBuilder::for(ScientificArticleCitation::with(['users', 'journal']))
            ->defaultSort('id')
            ->allowedSorts([
                'article_title',
                AllowedSort::custom('magazine', new JournalSorts),
                'magazine_publish_date',
                'citations_count'
            ])
            ->paginate();
    }

    /**
     * @param array $validated
     * @return ScientificArticleCitation
     */
    public function create(array $validated): ScientificArticleCitation
    {

        $magazine = $this->getMagazine($validated['magazine_name']);

        unset($validated['magazine_name']);

        $validated['journal_id'] = $magazine->id;

        /** @var ScientificArticleCitation $articleCitation */
        $articleCitation = ScientificArticleCitation::query()->create($validated);

        if (isset($validated['users'])) {
            $users = $validated['users'];
            array_push($users, auth()->id());
        } else {
            $users = [auth()->id()];
        }

        $articleCitation->users()->sync($users);

        return $articleCitation->load(['users', 'journal']);
    }

    /**
     * @param ScientificArticleCitation $articleCitation
     * @param array $validated
     * @return ScientificArticleCitation
     */
    public function update(ScientificArticleCitation $articleCitation, array $validated): ScientificArticleCitation
    {
        /** @var ScientificArticleCitation $articleCitation */
        $articleCitation = tap($articleCitation)->update($validated);

        if (isset($validated['users'])) {
            $users = $validated['users'];
            array_push($users, auth()->id());
        } else {
            $users = [auth()->id()];
        }
        $articleCitation->users()->sync($users);

        return $articleCitation->load(['users', 'journal']);
    }

    public function delete(ScientificArticleCitation $articleCitation)
    {
        $articleCitation->delete();
    }

    /**
     * @return Collection|QueryBuilder[]
     */
    public function getJournalsList()
    {
        return QueryBuilder::for(Journal::class)->get();
    }

    /**
     * @param string $magazine
     * @return Builder|Model
     */
    protected function getMagazine(string $magazine)
    {
        return Journal::query()->firstOrCreate([
            'title' => $magazine
        ]);
    }
}
