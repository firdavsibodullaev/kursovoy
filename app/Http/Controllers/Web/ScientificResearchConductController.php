<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScientificResearchConductRequest;
use App\Models\ScientificResearchConduct;
use App\Services\ScientificResearchConductService;
use Illuminate\Http\RedirectResponse;

class ScientificResearchConductController extends Controller
{
    /**
     * @var ScientificResearchConductService
     */
    private $conductService;

    public function __construct(ScientificResearchConductService $conductService)
    {
        $this->conductService = $conductService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(): string
    {
        return view('scientific-research-conduct.index', [
            'orders' => $this->conductService->fetchWithPagination()
        ])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create(): string
    {
        return view('scientific-research-conduct.create')->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ScientificResearchConductRequest $request
     * @return RedirectResponse
     */
    public function store(ScientificResearchConductRequest $request): RedirectResponse
    {
        $this->conductService->create($request->validated());

        return redirect()->route('scientific_research_conduct.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ScientificResearchConduct $scientificResearchConduct
     * @return string
     */
    public function edit(ScientificResearchConduct $scientificResearchConduct): string
    {
        return view('scientific-research-conduct.edit', [
            'order' => $scientificResearchConduct
        ])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ScientificResearchConductRequest $request
     * @param ScientificResearchConduct $scientificResearchConduct
     * @return RedirectResponse
     */
    public function update(ScientificResearchConductRequest $request, ScientificResearchConduct $scientificResearchConduct): RedirectResponse
    {
        $this->conductService->update($scientificResearchConduct, $request->validated());

        return redirect()->route('scientific_research_conduct.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ScientificResearchConduct $scientificResearchConduct
     * @return RedirectResponse
     */
    public function destroy(ScientificResearchConduct $scientificResearchConduct): RedirectResponse
    {
        $this->conductService->delete($scientificResearchConduct);

        return redirect()->route('scientific_research_conduct.index');
    }
}
