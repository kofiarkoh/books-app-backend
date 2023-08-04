<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PasswordResetTokenVerifyRequest;
use App\Http\Requests\User\ForgotPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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


    public function verifyResetToken(PasswordResetTokenVerifyRequest $request)
    {

        /** @var User $user */
        $user = $request->userFromEmail();

        if (!Password::tokenExists($user, $request->validated('token'))) {
            throw ValidationException::withMessages(([
                'token' => __(Password::INVALID_TOKEN)
            ]));
        }

        return response()->json([
            'message' => 'Forgot password token verified successfully'
        ], Response::HTTP_OK);
    }
}
