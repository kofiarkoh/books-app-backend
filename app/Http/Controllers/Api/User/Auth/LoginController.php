<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $validated = $request->validated();
        $request->ensureIsNotRateLimited();

        /** @var User $user */
        $user = User::whereEmail($validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            $request->incrementLoginAttempts();
        }

        $request->clearLoginAttempts();


        return response()->json([
            'message' => 'Login successful',
            "data" => fractal()->item($user, new UserTransformer()),
            "meta" => ['token' => $user->createToken($request->header('User-Agent'))->plainTextToken]
        ], Response::HTTP_OK);
    }
}
