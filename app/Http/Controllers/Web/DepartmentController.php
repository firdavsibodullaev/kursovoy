<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Services\DepartmentService;
use App\Services\FacultyService;
use Illuminate\Http\RedirectResponse;

class DepartmentController extends Controller
{
    /**
     * @var DepartmentService
     */
    private $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(): string
    {
        return view('department.index', [
            'faculties' => (new FacultyService())->fetchFacultiesList()
        ])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create(): string
    {
        return view('department.create', [
            'faculties' => (new FacultyService())->fetchFacultiesList()
        ])->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DepartmentRequest $request
     * @return RedirectResponse
     */
    public function store(DepartmentRequest $request): RedirectResponse
    {
        $this->departmentService->create($request->validated());

        return redirect()->route('department.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Department $department
     * @return string
     */
    public function edit(Department $department): string
    {
        return view('department.edit', [
            'department' => $department,
            'faculties' => (new FacultyService())->fetchFacultiesList()
        ])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DepartmentRequest $request
     * @param Department $department
     * @return RedirectResponse
     */
    public function update(DepartmentRequest $request, Department $department): RedirectResponse
    {
        $this->departmentService->update($department, $request->validated());
        return redirect()->route('department.index');
    }

    /**
     * @param Department $department
     * @return RedirectResponse
     */
    public function destroy(Department $department): RedirectResponse
    {
        $this->departmentService->delete($department);
        return redirect()->route('department.index');
    }
}
