<?php

namespace App\Http\Controllers\Web;

use App\Constants\PermissionsConstant;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDScDoctorRequest;
use App\Http\Requests\UpdateDScDoctorRequest;
use App\Models\DScDoctor;
use App\Services\DScDoctorService;
use Illuminate\Http\RedirectResponse;

class DscDoctorController extends Controller
{

    /**
     * @var DScDoctorService
     */
    private $doctorService;

    public function __construct(DScDoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(): string
    {
        return view('dsc-doctors.index', [
            'doctors' => $this->doctorService->fetchWithPagination(),
            'permissions' => [
                'edit' => PermissionsConstant::DSC_EDIT,
                'delete' => PermissionsConstant::DSC_DELETE,
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
        return view('dsc-doctors.create')->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDScDoctorRequest $request
     * @return RedirectResponse
     */
    public function store(StoreDScDoctorRequest $request): RedirectResponse
    {
        $this->doctorService->create($request->validated());

        return redirect()->route('dsc_doctors.index')->with([
            'message' => 'Создано'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param DScDoctor $dScDoctor
     * @return string
     */
    public function edit(DScDoctor $dScDoctor): string
    {
        return view('dsc-doctors.edit', [
            'dsc' => $dScDoctor
        ])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDScDoctorRequest $request
     * @param DScDoctor $dScDoctor
     * @return RedirectResponse
     */
    public function update(UpdateDScDoctorRequest $request, DScDoctor $dScDoctor): RedirectResponse
    {
        $this->doctorService->update($dScDoctor, $request->validated());

        return redirect()->route('dsc_doctors.index')->with([
            'message' => 'Изменено'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DScDoctor $dScDoctor
     * @return RedirectResponse
     */
    public function destroy(DScDoctor $dScDoctor): RedirectResponse
    {
        $this->doctorService->delete($dScDoctor);

        return redirect()->route('dsc_doctors.index')->with([
            'message' => 'Удалено'
        ]);
    }
}
