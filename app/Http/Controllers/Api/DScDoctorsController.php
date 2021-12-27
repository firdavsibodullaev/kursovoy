<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DScDoctorResource;
use App\Models\DScDoctor;
use App\Http\Requests\StoreDScDoctorRequest;
use App\Http\Requests\UpdateDScDoctorRequest;
use App\Services\DScDoctorService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DScDoctorsController extends Controller
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
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $dsc_doctors = $this->doctorService->fetchWithPagination();

        return DScDoctorResource::collection($dsc_doctors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDScDoctorRequest $request
     * @return DScDoctorResource
     */
    public function store(StoreDScDoctorRequest $request): DScDoctorResource
    {
        $dsc_doctor = $this->doctorService->create($request->validated());

        return new DScDoctorResource($dsc_doctor);
    }

    /**
     * Display the specified resource.
     *
     * @param DScDoctor $dScDoctor
     * @return DScDoctorResource
     */
    public function show(DScDoctor $dScDoctor): DScDoctorResource
    {
        return new DScDoctorResource($dScDoctor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDScDoctorRequest $request
     * @param DScDoctor $dScDoctor
     * @return DScDoctorResource
     */
    public function update(UpdateDScDoctorRequest $request, DScDoctor $dScDoctor): DScDoctorResource
    {
        $doctor = $this->doctorService->update($dScDoctor, $request->validated());

        return new DScDoctorResource($doctor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DScDoctor $dScDoctor
     * @return Response
     */
    public function destroy(DScDoctor $dScDoctor): Response
    {
        $this->doctorService->delete($dScDoctor);

        return \response('', 204);
    }
}
