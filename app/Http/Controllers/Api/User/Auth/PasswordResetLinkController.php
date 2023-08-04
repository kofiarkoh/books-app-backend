<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ForgotPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{
    /**
     * @param PasswordResetLinkRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResetLink(ForgotPasswordRequest $request)
    {


        $status = $request->sendResetLink();

        if ($status !== Password::RESET_LINK_SENT) {
            throw ValidationException::withMessages([
                'email' => __($status)
            ]);
        }


        return response()->json([
            'message' => __($status)
        ]);
    }
}
