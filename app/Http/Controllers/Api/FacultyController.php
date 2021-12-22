<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FacultyResource;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FacultyController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {

        $faculties = Faculty::query()->with('departments')->get();

        return FacultyResource::collection($faculties);
    }

    /**
     * @param Faculty $faculty
     * @return FacultyResource
     */
    public function show(Faculty $faculty): FacultyResource
    {
        return new FacultyResource($faculty->load('departments'));
    }
}
