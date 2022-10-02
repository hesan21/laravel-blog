<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => [
                'required'
              ],
            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'confirmed',
                'min:6',
            ],
        ]);

        // Get Only Fill-able Attributes from the request
        $attributes = $request->only(app(User::class)->getFillable());
        $attributes['password'] = Hash::make($attributes['password']);

        // Create a New User
        $user = User::create($attributes);

        // Get Token for Authenticated User
        $token = $user->createToken('authToken')->plainTextToken;

        // Create a Response for Registered
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json([
            'success' => true,
            'message' => 'Login Successful',
            'data' => $response
        ], HttpResponse::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required'
            ]
        ]);

        // If User email doesn't exist in the system or credentials doesn't match ( Can be Seperated Checks )
        $user = User::where('email', $request->get('email'))->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages(
                [
                    'credentials' => 'Incorrect Credentials',
                ]
            );
        }

        // Get Token for Authenticated User
        $token = $user->createToken('authToken')->plainTextToken;

        // Create a Response for Registered
        $loginResponse = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json([
            'success' => true,
            'message' => 'Login Successful',
            'data' => $loginResponse
        ], HttpResponse::HTTP_OK);
    }
}
