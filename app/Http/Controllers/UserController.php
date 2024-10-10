<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    public function register(UserRegisterRequest $request): JsonResponse
    {

        $data = $request->validated();

        if (User::where("username", $data["username"])->exists()) {
            throw new HttpResponseException(response([
                "errors" => [
                    "username" => ["Username already registered"]
                ]
            ], 400));
        }

        $user = new User($data);
        $user->password = Hash::make($data['password']);
        $user->save();

        return (new UserResource($user))->response()->setStatuscode(201);
    }

    public function login(UserLoginRequest $request): UserResource
    {

        $data = $request->validated();

        $user = User::where("username", $data["username"])->first();

        if (!$user || !Hash::check($data["password"], $user->password)) {
            throw new HttpResponseException(response([
                "errors" => [
                    "message" => ["username or password wrong"]
                ]
            ], 401));
        }

        $user->token = $user->createToken($user->username)->plainTextToken;
        $user->save();

        Log::debug("Login route api");
        Log::debug($user);

        return  new UserResource($user);
    }
}
