<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScientificArticleAttachFileRequest;
use App\Http\Requests\ScientificArticleRequest;
use App\Http\Resources\ScientificArticleResource;
use App\Models\ScientificArticle;
use App\Services\ScientificArticleService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;

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
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ScientificArticleResource::collection($this->articleService->fetchWithPagination());
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function getNotConfirmedArticlesList(): AnonymousResourceCollection
    {
        return ScientificArticleResource::collection($this->articleService->getNotConfirmedArticlesList());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ScientificArticleRequest $request
     * @return ScientificArticleResource
     */
    public function store(ScientificArticleRequest $request): ScientificArticleResource
    {
        $article = $this->articleService->create($request->validated());

        return new ScientificArticleResource($article);
    }

    /**
     * @param ScientificArticleAttachFileRequest $request
     * @param ScientificArticle $scientificArticle
     * @return ScientificArticleResource
     */
    public function attach(ScientificArticleAttachFileRequest $request, ScientificArticle $scientificArticle): ScientificArticleResource
    {
        /** @var UploadedFile $file */
        $file = $request->validated()['file'];

        $scientificArticle = $this->articleService->attachFile($file, $scientificArticle);

        return new ScientificArticleResource($scientificArticle);
    }

    /**
     * @param ScientificArticle $scientificArticle
     * @return Response
     */
    public function confirm(ScientificArticle $scientificArticle): Response
    {
        $article = $this->articleService->confirm($scientificArticle);
        return response($article);
    }

    /**
     * Display the specified resource.
     *
     * @param ScientificArticle $scientificArticle
     * @return ScientificArticleResource
     */
    public function show(ScientificArticle $scientificArticle): ScientificArticleResource
    {
        return new ScientificArticleResource($scientificArticle->load(['users', 'magazine', 'country']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ScientificArticleRequest $request
     * @param ScientificArticle $scientificArticle
     * @return ScientificArticleResource
     */
    public function update(ScientificArticleRequest $request, ScientificArticle $scientificArticle): ScientificArticleResource
    {
        $article = $this->articleService->update($scientificArticle, $request->validated());

        return new ScientificArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ScientificArticle $scientificArticle
     * @return Response
     */
    public function destroy(ScientificArticle $scientificArticle): Response
    {
        $this->articleService->delete($scientificArticle);
        return response('', 204);
    }
}
