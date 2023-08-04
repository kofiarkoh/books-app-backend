<?php

namespace App\Http\Requests\User;

use App\Enums\TokenStatus;
use App\Models\OtpToken;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class VerifyEmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !$this->user()->hasVerifiedEmail();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'token' => ['required', 'string']
        ];
    }

    public function verify()
    {

        /** @var User $user */
        $user = $this->user();

        /** @var OtpToken $token */
        $token = OtpToken::firstWhere([
            'token' => $this->token,
            'user_id' => $user->id
        ]);

        if (!$token) {
            return [
                'status' => TokenStatus::INVALID,
                'message' => 'The provided token is invalid'
            ];
        }

        if ($token->hasExpired()) {
            return [
                'status' => TokenStatus::EXPIRED,
                'message' => 'The token has expired. Please request for new one.'
            ];
        }

        $user->markEmailAsVerified();

        $user->otptokens()->delete();

        return [
            'status' => TokenStatus::VALID,
            'message' => 'Email verified'
        ];
    }
}
