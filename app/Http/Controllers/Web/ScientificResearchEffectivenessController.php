<?php

namespace App\Http\Controllers\Web;

use App\Constants\PermissionsConstant;
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
            'researches' => $this->effectivenessService->fetchWithPagination(),
            'permissions' => [
                'confirm' => PermissionsConstant::SCIENTIFIC_RESEARCH_EFFECTIVENESS_CONFIRM,
                'edit' => PermissionsConstant::SCIENTIFIC_RESEARCH_EFFECTIVENESS_EDIT,
                'delete' => PermissionsConstant::SCIENTIFIC_RESEARCH_EFFECTIVENESS_DELETE,
            ]
        ])->render();
    }

    /**
     * @return string
     */
    public function getNotConfirmedArticlesList(): string
    {
        return view('scientific-research-effectiveness.not-confirmed', [
            'researches' => $this->effectivenessService->getNotConfirmedArticlesList(),
            'permissions' => [
                'edit' => PermissionsConstant::SCIENTIFIC_RESEARCH_EFFECTIVENESS_EDIT,
                'delete' => PermissionsConstant::SCIENTIFIC_RESEARCH_EFFECTIVENESS_DELETE,
            ]
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
        $scientificResearchEffectiveness = $scientificResearchEffectiveness->load(['users', 'publication']);
        abort_unless(has_access_to_edit($scientificResearchEffectiveness->users->pluck('id')->toArray()), 404);

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
        abort_unless(has_access_to_edit($scientificResearchEffectiveness->users->pluck('id')->toArray()), 404);

        $this->effectivenessService->update($scientificResearchEffectiveness, $request->validated());

        return redirect()->route('scientific_research_effectiveness.index');
    }

    /**
     * @param ScientificResearchEffectiveness $scientificResearchEffectiveness
     * @return RedirectResponse
     */
    public function confirm(ScientificResearchEffectiveness $scientificResearchEffectiveness): RedirectResponse
    {
        $this->effectivenessService->confirm($scientificResearchEffectiveness);

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
