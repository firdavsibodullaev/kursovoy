<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePhdDoctorRequest;
use App\Http\Requests\UpdatePhdDoctorRequest;
use App\Models\PhdDoctor;
use App\Services\PhdDoctorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class PhdDoctorController extends Controller
{
    /**
     * @var PhdDoctorService
     */
    private $doctorService;

    public function __construct(PhdDoctorService $doctorService)
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
        return view('phd-doctors.index', [
            'doctors' => $this->doctorService->fetchWithPaginate()
        ])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create(): string
    {
        return view('phd-doctors.create')->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePhdDoctorRequest $request
     * @return RedirectResponse
     */
    public function store(StorePhdDoctorRequest $request): RedirectResponse
    {
        $this->doctorService->create($request->validated());

        return redirect()->route('phd_doctors.index')->with([
            'message' => 'Создано'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PhdDoctor $phdDoctor
     * @return string
     */
    public function edit(PhdDoctor $phdDoctor): string
    {
        return view('phd-doctors.edit', [
            'phd' => $phdDoctor
        ])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePhdDoctorRequest $request
     * @param PhdDoctor $phdDoctor
     * @return RedirectResponse
     */
    public function update(UpdatePhdDoctorRequest $request, PhdDoctor $phdDoctor): RedirectResponse
    {
        $this->doctorService->update($phdDoctor, $request->validated());

        return redirect()->route('phd_doctors.index')->with([
            'message' => 'Изменено'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PhdDoctor $phdDoctor
     * @return RedirectResponse
     */
    public function destroy(PhdDoctor $phdDoctor): RedirectResponse
    {
        $this->doctorService->delete($phdDoctor);

        return redirect()->route('phd_doctors.index')->with([
            'message' => 'Удалено'
        ]);
    }
}
