<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Enums\TokenStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\VerifyEmailRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VerifyEmailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(VerifyEmailRequest $request)
    {
        $verification = $request->verify();

        if ($verification['status'] !== TokenStatus::VALID) {

            throw ValidationException::withMessages([
                'token' => $verification['message']
            ]);
        }

        return response()->json([
            'message' => 'Email verified successfully'
        ]);
    }
}
