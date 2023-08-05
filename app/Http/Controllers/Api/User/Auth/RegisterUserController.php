<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class RegisterUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data + ['password' => bcrypt($data['password'])]);

        return response()->json([
            'message' => 'user registered successfully',
            'data' => fractal()->item($user, new UserTransformer),
            "meta" => ['token' => $user->createToken($request->header('User-Agent'))->plainTextToken]

        ]);
    }
}
