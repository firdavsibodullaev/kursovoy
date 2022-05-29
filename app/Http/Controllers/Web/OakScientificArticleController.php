<?php

namespace App\Http\Controllers\Web;

use App\Constants\MediaCollectionsConstant;
use App\Http\Controllers\Controller;
use App\Models\OakScientificArticle;
use App\Http\Requests\OakScientificArticleRequest;
use App\Services\ListService;
use App\Services\OakScientificArticleService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class OakScientificArticleController extends Controller
{

    /**
     * @var OakScientificArticleService
     */
    private $articleService;

    public function __construct(OakScientificArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(): string
    {
        return view('oak-articles.index', [
            'articles' => $this->articleService->fetchWithPagination(),
            'collection' => MediaCollectionsConstant::OAK_SCIENTIFIC_ARTICLE_FILE
        ])->render();
    }

    /**
     * @return string
     */
    public function getNotConfirmedArticlesList(): string
    {
        return view('oak-articles.not-confirmed', [
            'articles' => $this->articleService->getNotConfirmedArticlesList(),
            'collection' => MediaCollectionsConstant::OAK_SCIENTIFIC_ARTICLE_FILE
        ])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create(): string
    {
        return view('oak-articles.create', [
            'users' => (new UserService())->list(),
            'magazines' => (new ListService())->getMagazinesList()
        ])->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OakScientificArticleRequest $request
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(OakScientificArticleRequest $request): RedirectResponse
    {
        $this->articleService->create($request->validated());
        return redirect()->route('oak_scientific_article.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param OakScientificArticle $oakScientificArticle
     * @return string
     */
    public function edit(OakScientificArticle $oakScientificArticle): string
    {
        $oakScientificArticle = $oakScientificArticle->load(['users', 'magazine']);
        abort_unless(has_access_to_edit($oakScientificArticle->users->pluck('id')->toArray()), 404);

        return view('oak-articles.edit', [
            'article' => $oakScientificArticle,
            'users' => (new UserService())->list(),
            'magazines' => (new ListService())->getMagazinesList(),
            'collection' => MediaCollectionsConstant::OAK_SCIENTIFIC_ARTICLE_FILE
        ])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OakScientificArticleRequest $request
     * @param OakScientificArticle $oakScientificArticle
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(OakScientificArticleRequest $request, OakScientificArticle $oakScientificArticle): RedirectResponse
    {
        $oakScientificArticle = $oakScientificArticle->load(['users', 'magazine']);
        abort_unless(has_access_to_edit($oakScientificArticle->users->pluck('id')->toArray()), 404);

        $this->articleService->update($oakScientificArticle, $request->validated());

        $status = $request->get('status');
        $status = $status === 'not-confirmed' ? 'not_confirmed' : 'index';
        return redirect()->route("oak_scientific_article.{$status}");
    }

    /**
     * @param OakScientificArticle $oakScientificArticle
     * @return RedirectResponse
     */
    public function confirm(OakScientificArticle $oakScientificArticle): RedirectResponse
    {
        $this->articleService->confirm($oakScientificArticle);

        return redirect()->route('oak_scientific_article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param OakScientificArticle $oakScientificArticle
     * @return RedirectResponse
     */
    public function destroy(OakScientificArticle $oakScientificArticle): RedirectResponse
    {
        $this->articleService->delete($oakScientificArticle);

        return redirect()->route('oak_scientific_article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param OakScientificArticle $oakScientificArticle
     * @return RedirectResponse
     */
    public function forceDestroy(OakScientificArticle $oakScientificArticle): RedirectResponse
    {
        $this->articleService->forceDelete($oakScientificArticle);

        return redirect()->route("oak_scientific_article.not_confirmed");
    }
}
