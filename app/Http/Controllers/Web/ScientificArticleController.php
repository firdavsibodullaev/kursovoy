<?php

namespace App\Http\Controllers\Web;

use App\Constants\LanguagesConstant;
use App\Constants\MediaCollectionsConstant;
use App\Constants\PermissionsConstant;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScientificArticleRequest;
use App\Models\ScientificArticle;
use App\Services\ListService;
use App\Services\ScientificArticleService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use function redirect;
use function view;

class ScientificArticleController extends Controller
{
    /**
     * @var ScientificArticleService
     */
    private $articleService;

    public function __construct(ScientificArticleService $articleService)
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
        return view('articles.index', [
            'articles' => $this->articleService->fetchWithPagination(),
            'collection' => MediaCollectionsConstant::SCIENTIFIC_ARTICLE_FILE,
            'permissions' => [
                'confirm' => PermissionsConstant::SCIENTIFIC_ARTICLE_CONFIRM,
                'edit' => PermissionsConstant::SCIENTIFIC_ARTICLE_EDIT,
                'delete' => PermissionsConstant::SCIENTIFIC_ARTICLE_DELETE,
            ]
        ])->render();
    }

    /**
     * @return string
     */
    public function getNotConfirmedArticlesList(): string
    {
        return view('articles.not-confirmed', [
            'articles' => $this->articleService->getNotConfirmedArticlesList(),
            'collection' => MediaCollectionsConstant::SCIENTIFIC_ARTICLE_FILE,
            'edit' => PermissionsConstant::SCIENTIFIC_ARTICLE_EDIT,
            'delete' => PermissionsConstant::SCIENTIFIC_ARTICLE_DELETE,
        ])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create(): string
    {
        return view('articles.create', [
            'countries' => (new ListService())->getCountries(),
            'users' => (new UserService())->list(),
            'magazines' => (new ListService())->getMagazinesList()
        ])->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ScientificArticleRequest $request
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(ScientificArticleRequest $request): RedirectResponse
    {
        $this->articleService->create($request->validated());
        return redirect()->route('scientific_article.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ScientificArticle $scientificArticle
     * @return string
     */
    public function edit(ScientificArticle $scientificArticle): string
    {
        $scientificArticle = $scientificArticle->load(['users', 'magazine', 'country']);
        abort_unless(has_access_to_edit($scientificArticle->users->pluck('id')->toArray()), 404);

        return view('articles.edit', [
            'article' => $scientificArticle,
            'countries' => (new ListService())->getCountries(),
            'users' => (new UserService())->list(),
            'magazines' => (new ListService())->getMagazinesList(),
            'collection' => MediaCollectionsConstant::SCIENTIFIC_ARTICLE_FILE
        ])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ScientificArticleRequest $request
     * @param ScientificArticle $scientificArticle
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(ScientificArticleRequest $request, ScientificArticle $scientificArticle): RedirectResponse
    {
        abort_unless(has_access_to_edit($scientificArticle->users->pluck('id')->toArray()), 404);

        $this->articleService->update($scientificArticle, $request->validated());
        $status = $request->get('status');
        $status = $status === 'not-confirmed' ? 'not_confirmed' : 'index';
        return redirect()->route("scientific_article.{$status}");
    }

    /**
     * @param ScientificArticle $scientificArticle
     * @return RedirectResponse
     */
    public function confirm(ScientificArticle $scientificArticle): RedirectResponse
    {
        $this->articleService->confirm($scientificArticle);

        return redirect()->route('scientific_article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ScientificArticle $scientificArticle
     * @return RedirectResponse
     */
    public function destroy(ScientificArticle $scientificArticle): RedirectResponse
    {
        $this->articleService->delete($scientificArticle);

        return redirect()->route('scientific_article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ScientificArticle $scientificArticle
     * @return RedirectResponse
     */
    public function forceDestroy(ScientificArticle $scientificArticle): RedirectResponse
    {
        $this->articleService->forceDelete($scientificArticle);

        return redirect()->route("scientific_article.not_confirmed");
    }
}
