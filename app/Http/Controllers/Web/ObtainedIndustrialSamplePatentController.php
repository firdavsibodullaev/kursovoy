<?php

namespace App\Http\Controllers\Web;

use App\Constants\MediaCollectionsConstant;
use App\Http\Controllers\Controller;
use App\Http\Requests\ObtainedIndustrialSamplePatentRequest;
use App\Models\ObtainedIndustrialSamplePatent;
use App\Services\ListService;
use App\Services\ObtainedIndustrialSamplePatentService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ObtainedIndustrialSamplePatentController extends Controller
{
    /**
     * @var ObtainedIndustrialSamplePatentService
     */
    private $patentService;

    public function __construct(ObtainedIndustrialSamplePatentService $patentService)
    {
        $this->patentService = $patentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(): string
    {
        return view('obtained-industrial-sample-patent.index', [
            'patents' => $this->patentService->fetchWithPagination()
        ])->render();
    }

    /**
     * @return string
     */
    public function getNotConfirmedArticlesList(): string
    {
        return view('obtained-industrial-sample-patent.not-confirmed', [
            'patents' => $this->patentService->getNotConfirmedArticlesList()
        ])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create(): string
    {
        return view('obtained-industrial-sample-patent.create', [
//            'institutes' => (new ListService())->getInstitutesList(),
            'users' => (new UserService())->list()
        ])->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ObtainedIndustrialSamplePatentRequest $request
     * @return RedirectResponse
     */
    public function store(ObtainedIndustrialSamplePatentRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $this->patentService->create($request->validated());
        });

        return redirect()->route('obtained_industrial_sample_patent.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ObtainedIndustrialSamplePatent $obtainedIndustrialSamplePatent
     * @return string
     */
    public function edit(ObtainedIndustrialSamplePatent $obtainedIndustrialSamplePatent): string
    {
        return view('obtained-industrial-sample-patent.edit', [
            'patent' => $obtainedIndustrialSamplePatent->load(['users', 'institute', 'file']),
//            'institutes' => (new ListService())->getInstitutesList(),
            'users' => (new UserService())->list(),
        ])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ObtainedIndustrialSamplePatentRequest $request
     * @param ObtainedIndustrialSamplePatent $obtainedIndustrialSamplePatent
     * @return RedirectResponse
     */
    public function update(ObtainedIndustrialSamplePatentRequest $request, ObtainedIndustrialSamplePatent $obtainedIndustrialSamplePatent): RedirectResponse
    {
        DB::transaction(function () use ($request, $obtainedIndustrialSamplePatent) {
            $this->patentService->update($obtainedIndustrialSamplePatent, $request->validated());
        });

        return redirect()->route('obtained_industrial_sample_patent.index');
    }

    public function confirm(ObtainedIndustrialSamplePatent $obtainedIndustrialSamplePatent)
    {
        $this->patentService->confirm($obtainedIndustrialSamplePatent);

        return redirect()->route('obtained_industrial_sample_patent.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ObtainedIndustrialSamplePatent $obtainedIndustrialSamplePatent
     * @return RedirectResponse
     */
    public function destroy(ObtainedIndustrialSamplePatent $obtainedIndustrialSamplePatent): RedirectResponse
    {
        $this->patentService->destroy($obtainedIndustrialSamplePatent);

        return redirect()->route('obtained_industrial_sample_patent.index');
    }
}
