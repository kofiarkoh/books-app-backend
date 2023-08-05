<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\OTPResendRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class OTPResendController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(OTPResendRequest $request)
    {
        $data = $request->validated();

        $user = User::whereEmail($data['email'])->first();

        if ($data['is_password_reset']) {
            Password::sendResetLink($request->only('email'));
        } else {
            $user->otptokens()->delete();
            $user->sendEmailVerificationNotification();
        }



        return response()->json([
            'message' => 'OTP resent successfully'
        ]);
    }
}
