<?php

namespace App\Http\Controllers\Web;

use App\Constants\LanguagesConstant;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScientificArticleCitationRequest;
use App\Http\Requests\UpdateScientificArticleCitationRequest;
use App\Models\ScientificArticleCitation;
use App\Services\ListService;
use App\Services\ScientificArticleCitationService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;

class ScientificArticleCitationController extends Controller
{
    /**
     * @var ScientificArticleCitationService
     */
    private $articleCitationService;

    /**
     * @param ScientificArticleCitationService $articleCitationService
     */
    public function __construct(ScientificArticleCitationService $articleCitationService)
    {
        $this->articleCitationService = $articleCitationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(): string
    {
        return view('article-citation.index', [
            'citations' => $this->articleCitationService->fetchWithPagination(),
            'languages' => LanguagesConstant::translatedList()
        ])->render();
    }

    public function notConfirmed()
    {
        return view('article-citation.not-confirmed', [
            'citations' => $this->articleCitationService->getNotConfirmedArticlesList(),
            'languages' => LanguagesConstant::translatedList()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create(): string
    {
        return view('article-citation.create', [
            'magazines' => (new ListService())->getMagazinesList(),
            'languages' => LanguagesConstant::translatedList(),
            'users' => (new UserService())->list()
        ])->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreScientificArticleCitationRequest $request
     * @return RedirectResponse
     */
    public function store(StoreScientificArticleCitationRequest $request): RedirectResponse
    {
        $this->articleCitationService->create($request->validated());
        return redirect()->route('article_citation.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ScientificArticleCitation $scientificArticleCitation
     * @return string
     */
    public function edit(ScientificArticleCitation $scientificArticleCitation): string
    {
        return view('article-citation.edit', [
            'citation' => $scientificArticleCitation->load(['magazine', 'users']),
            'magazines' => (new ListService())->getMagazinesList(),
            'languages' => LanguagesConstant::translatedList(),
            'users' => (new UserService())->list()
        ])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateScientificArticleCitationRequest $request
     * @param ScientificArticleCitation $scientificArticleCitation
     * @return RedirectResponse
     */
    public function update(UpdateScientificArticleCitationRequest $request, ScientificArticleCitation $scientificArticleCitation): RedirectResponse
    {
        $this->articleCitationService->update($scientificArticleCitation, $request->validated());

        $status = $request->get('status');
        $status = $status === 'not-confirmed' ? 'not_confirmed' : 'index';

        return redirect()->route("article_citation.{$status}");
    }

    /**
     * @param ScientificArticleCitation $scientificArticleCitation
     * @return RedirectResponse
     */
    public function confirm(ScientificArticleCitation $scientificArticleCitation): RedirectResponse
    {
        $this->articleCitationService->confirm($scientificArticleCitation);

        return redirect()->route("article_citation.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ScientificArticleCitation $scientificArticleCitation
     * @return RedirectResponse
     */
    public function destroy(ScientificArticleCitation $scientificArticleCitation): RedirectResponse
    {
        $this->articleCitationService->delete($scientificArticleCitation);

        return redirect()->route("article_citation.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ScientificArticleCitation $scientificArticleCitation
     * @return RedirectResponse
     */
    public function forceDestroy(ScientificArticleCitation $scientificArticleCitation): RedirectResponse
    {
        $this->articleCitationService->forceDelete($scientificArticleCitation);

        return redirect()->route("article_citation.not_confirmed");
    }
}
