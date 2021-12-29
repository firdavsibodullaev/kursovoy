<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PhdDoctorResource;
use App\Models\PhdDoctor;
use App\Http\Requests\StorePhdDoctorRequest;
use App\Http\Requests\UpdatePhdDoctorRequest;
use App\Services\PhdDoctorService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
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
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $list = $this->doctorService->fetchWithPaginate();

        return PhdDoctorResource::collection($list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePhdDoctorRequest $request
     * @return PhdDoctorResource
     */
    public function store(StorePhdDoctorRequest $request): PhdDoctorResource
    {
        $doctor = $this->doctorService->create($request->validated());

        return new PhdDoctorResource($doctor);
    }

    /**
     * Display the specified resource.
     *
     * @param PhdDoctor $phdDoctor
     * @return PhdDoctorResource
     */
    public function show(PhdDoctor $phdDoctor): PhdDoctorResource
    {
        return new PhdDoctorResource($phdDoctor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePhdDoctorRequest $request
     * @param PhdDoctor $phdDoctor
     * @return PhdDoctorResource
     */
    public function update(UpdatePhdDoctorRequest $request, PhdDoctor $phdDoctor): PhdDoctorResource
    {
        $doctor = $this->doctorService->update($phdDoctor, $request->validated());
        return new PhdDoctorResource($doctor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PhdDoctor $phdDoctor
     * @return Response
     */
    public function destroy(PhdDoctor $phdDoctor): Response
    {
        $this->doctorService->delete($phdDoctor);
        return response('', 204);
    }
}
