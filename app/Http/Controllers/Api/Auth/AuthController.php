<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    /**
     * @param StoreUserRequest $request
     * @return array
     */
    public function register(StoreUserRequest $request): array
    {
        $user = (new UserService())->create($request->validated());

        Auth::attempt(Arr::only($request->validated(), ['username', 'password']));
        /** @var User $user */
        $token = $user->createToken(json_encode([$request->userAgent(), $request->ip()]))->plainTextToken;

        return [
            'type' => 'Bearer',
            'token' => $token,
            'user' => new UserResource($user)
        ];
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'remember' => ['required', 'string', Rule::in('yes', 'on')],
        ]);
        if (!Auth::attempt(Arr::except($credentials, 'remember'), $credentials['remember'] === 'yes')) {
            return response('Unauthorized', 401);
        }
        /** @var User $user */
        $user = $request->user();
        $token = $user->createToken(json_encode([$request->userAgent(), $request->ip()]))->plainTextToken;

        return [
            'type' => 'Bearer',
            'token' => $token,
            'user' => new UserResource($user)
        ];
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        return response('', 204);
    }
}
