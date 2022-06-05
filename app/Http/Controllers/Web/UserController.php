<?php

namespace App\Http\Controllers\Web;

use App\Constants\PermissionsConstant;
use App\Constants\UserRoles;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserPermissionRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\PermissionsResource;
use App\Models\Faculty;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(): string
    {
        return view('users.index', [
            'users' => $this->userService->fetchWithPagination(),
            'permissions' => [
                'edit' => PermissionsConstant::USERS_EDIT,
                'roles' => PermissionsConstant::USERS_CHANGE_ROLES,
                'delete' => PermissionsConstant::USERS_DELETE,
            ]
        ])->render();
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function search(): AnonymousResourceCollection
    {
        return UserResource::collection($this->userService->fetchWithPagination());
    }

    /**
     * @param User $user
     * @return Collection
     */
    public function roles(User $user): Collection
    {
        return collect([
            'user' => new UserResource($user->load(['permissions', 'post_name.permissions'])),
            'permissions' => PermissionsResource::collection(Permission::query()->get())
        ]);
    }

    /**
     * @param User $user
     * @param UserPermissionRequest $request
     * @return RedirectResponse
     */
    public function saveRole(User $user, UserPermissionRequest $request): RedirectResponse
    {
        $this->userService->givePermissions($user, $request->validated());
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create(): string
    {
        return view('users.create', [
            'faculties' => Faculty::query()->orderBy('id')->get(),
            'roles' => UserRoles::translate()
        ])->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->userService->create($request->validated());

        return redirect()->route('users.index')->with([
            'message' => 'Успешно создано'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return string
     */
    public function edit(User $user): string
    {
        return view('users.edit', [
            'user' => $user->load('post_name'),
            'faculties' => Faculty::query()->orderBy('id')->get(),
            'departments' => $user->faculty()->with('departments')->first()->departments ?? [],
            'roles' => UserRoles::translate()
        ])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $this->userService->update($user, $request->validated());

        return redirect()->route('users.index')->with([
            'message' => 'Успешно обновлено'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->userService->delete($user);

        return redirect()->route('users.index')->with([
            'message' => 'Успешно удалено'
        ]);
    }
}
