<?php

namespace App\Http\Controllers\Api;

use App\Constants\LanguagesConstant;
use App\Http\Controllers\Controller;
use App\Http\Resources\MagazineResource;
use App\Http\Resources\ScientificArticleCitationResource;
use App\Models\ScientificArticleCitation;
use App\Http\Requests\StoreScientificArticleCitationRequest;
use App\Http\Requests\UpdateScientificArticleCitationRequest;
use App\Services\ScientificArticleCitationService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ScientificArticleCitationController extends Controller
{
    /**
     * @var ScientificArticleCitationService
     */
    private $citationService;

    public function __construct(ScientificArticleCitationService $citationService)
    {
        $this->citationService = $citationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ScientificArticleCitationResource::collection($this->citationService->fetchWithPagination());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreScientificArticleCitationRequest $request
     * @return ScientificArticleCitationResource
     */
    public function store(StoreScientificArticleCitationRequest $request): ScientificArticleCitationResource
    {
        $citation = $this->citationService->create($request->validated());

        return new ScientificArticleCitationResource($citation);
    }

    /**
     * Display the specified resource.
     *
     * @param ScientificArticleCitation $scientificArticleCitation
     * @return ScientificArticleCitationResource
     */
    public function show(ScientificArticleCitation $scientificArticleCitation): ScientificArticleCitationResource
    {
        return new ScientificArticleCitationResource($scientificArticleCitation->load(['users', 'magazine']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateScientificArticleCitationRequest $request
     * @param ScientificArticleCitation $scientificArticleCitation
     * @return ScientificArticleCitationResource
     */
    public function update(UpdateScientificArticleCitationRequest $request, ScientificArticleCitation $scientificArticleCitation): ScientificArticleCitationResource
    {
        $scientificArticleCitation = $this->citationService->update($scientificArticleCitation, $request->validated());
        return new ScientificArticleCitationResource($scientificArticleCitation);

    }

    /**
     * @param ScientificArticleCitation $scientificArticleCitation
     * @return ScientificArticleCitationResource
     */
    public function confirm(ScientificArticleCitation $scientificArticleCitation): ScientificArticleCitationResource
    {
        $scientificArticleCitation = $this->citationService->confirm($scientificArticleCitation);

        return new ScientificArticleCitationResource($scientificArticleCitation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ScientificArticleCitation $scientificArticleCitation
     * @return Response
     */
    public function destroy(ScientificArticleCitation $scientificArticleCitation): Response
    {
        $this->citationService->delete($scientificArticleCitation);

        return response('', 204);
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function magazines(): AnonymousResourceCollection
    {
        return MagazineResource::collection($this->citationService->getMagazinesList());
    }

    /**
     * @return array|string
     */
    public function languages()
    {
        return LanguagesConstant::translatedList();
    }

    public function getNotConfirmedArticlesList(): AnonymousResourceCollection
    {
        return ScientificArticleCitationResource::collection($this->citationService->getNotConfirmedArticlesList());
    }
}
