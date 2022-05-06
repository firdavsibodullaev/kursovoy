<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScientificResearchEffectivenessRequest;
use App\Models\ScientificResearchEffectiveness;
use App\Services\ListService;
use App\Services\ScientificResearchEffectivenessService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;

class ScientificResearchEffectivenessController extends Controller
{
    /**
     * @var ScientificResearchEffectivenessService
     */
    private $effectivenessService;

    public function __construct(ScientificResearchEffectivenessService $effectivenessService)
    {
        $this->effectivenessService = $effectivenessService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(): string
    {
        return view('scientific-research-effectiveness.index', [
            'researches' => $this->effectivenessService->fetchWithPagination()
        ])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create(): string
    {
        return view('scientific-research-effectiveness.create', [
            'publications' => (new ListService())->getPublicationsList(),
            'users' => (new UserService())->list(),
        ])->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ScientificResearchEffectivenessRequest $request
     * @return RedirectResponse
     */
    public function store(ScientificResearchEffectivenessRequest $request): RedirectResponse
    {
        $this->effectivenessService->create($request->validated());

        return redirect()->route('scientific_research_effectiveness.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ScientificResearchEffectiveness $scientificResearchEffectiveness
     * @return string
     */
    public function edit(ScientificResearchEffectiveness $scientificResearchEffectiveness): string
    {
        return view('scientific-research-effectiveness.edit', [
            'research' => $scientificResearchEffectiveness,
            'publications' => (new ListService())->getPublicationsList(),
            'users' => (new UserService())->list(),
        ])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ScientificResearchEffectivenessRequest $request
     * @param ScientificResearchEffectiveness $scientificResearchEffectiveness
     * @return RedirectResponse
     */
    public function update(ScientificResearchEffectivenessRequest $request, ScientificResearchEffectiveness $scientificResearchEffectiveness): RedirectResponse
    {
        $this->effectivenessService->update($scientificResearchEffectiveness, $request->validated());

        return redirect()->route('scientific_research_effectiveness.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ScientificResearchEffectiveness $scientificResearchEffectiveness
     * @return RedirectResponse
     */
    public function destroy(ScientificResearchEffectiveness $scientificResearchEffectiveness): RedirectResponse
    {
        $this->effectivenessService->delete($scientificResearchEffectiveness);

        return redirect()->route('scientific_research_effectiveness.index');
    }
}
