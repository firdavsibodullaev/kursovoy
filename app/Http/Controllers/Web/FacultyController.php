<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\FacultyRequest;
use App\Models\Faculty;
use App\Services\FacultyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * @var FacultyService
     */
    private $facultyService;

    public function __construct(FacultyService $facultyService)
    {
        $this->facultyService = $facultyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(): string
    {
        return view('faculty.index', [
            'faculties' => $this->facultyService->fetchFacultiesList()
        ])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create(): string
    {
        return view('faculty.create')->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FacultyRequest $request
     * @return RedirectResponse
     */
    public function store(FacultyRequest $request): RedirectResponse
    {
        $this->facultyService->create($request->validated());

        return redirect()->route('faculty.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Faculty $faculty
     * @return string
     */
    public function edit(Faculty $faculty): string
    {
        return view('faculty.edit', [
            'faculty' => $faculty
        ])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FacultyRequest $request
     * @param Faculty $faculty
     * @return RedirectResponse
     */
    public function update(FacultyRequest $request, Faculty $faculty): RedirectResponse
    {
        $this->facultyService->update($faculty, $request->validated());

        return redirect()->route('faculty.index');
    }

    /**
     * @param Faculty $faculty
     * @return RedirectResponse
     */
    public function destroy(Faculty $faculty): RedirectResponse
    {
        $this->facultyService->delete($faculty);

        return redirect()->route('faculty.index');
    }

}
