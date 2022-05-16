<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CopyrightProtectedVariousMaterialInformationRequest;
use App\Models\CopyrightProtectedVariousMaterialInformation;
use App\Services\CopyrightProtectedVariousMaterialInformationService;
use App\Services\ListService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CopyrightProtectedVariousMaterialInformationController extends Controller
{
    /**
     * @var CopyrightProtectedVariousMaterialInformationService
     */
    private $informationService;

    public function __construct(CopyrightProtectedVariousMaterialInformationService $informationService)
    {
        $this->informationService = $informationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(): string
    {
        return view('copyright-protected-various-material-information.index', [
            'information' => $this->informationService->fetchWithPagination()
        ])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create(): string
    {
        return view('copyright-protected-various-material-information.create', [
            'institutes' => (new ListService())->getInstitutesList(),
            'users' => (new UserService())->list(),
        ])->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CopyrightProtectedVariousMaterialInformationRequest $request
     * @return RedirectResponse
     */
    public function store(CopyrightProtectedVariousMaterialInformationRequest $request): RedirectResponse
    {
        $this->informationService->create($request->validated());

        return redirect()->route('copyright_protected_various_material_information.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CopyrightProtectedVariousMaterialInformation $information
     * @return string
     */
    public function edit(CopyrightProtectedVariousMaterialInformation $information): string
    {
        return view('copyright-protected-various-material-information.edit', [
            'information' => $information->load(['user', 'institute']),
            'institutes' => (new ListService())->getInstitutesList(),
            'users' => (new UserService())->list(),
        ])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CopyrightProtectedVariousMaterialInformationRequest $request
     * @param CopyrightProtectedVariousMaterialInformation $information
     * @return RedirectResponse
     */
    public function update(CopyrightProtectedVariousMaterialInformationRequest $request, CopyrightProtectedVariousMaterialInformation $information): RedirectResponse
    {
        $this->informationService->update($information, $request->validated());

        return redirect()->route('copyright_protected_various_material_information.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CopyrightProtectedVariousMaterialInformation $information
     * @return RedirectResponse
     */
    public function destroy(CopyrightProtectedVariousMaterialInformation $information): RedirectResponse
    {
        $this->informationService->delete($information);

        return redirect()->route('copyright_protected_various_material_information.index');
    }
}
