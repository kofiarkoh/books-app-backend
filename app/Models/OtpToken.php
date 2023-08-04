<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OtpToken extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function generateFor(User $user): static
    {
        return static::firstOrCreate([
            'user_id' => $user->id,
            'token' => self::generateToken(),
            'created_at' => now()
        ]);
    }

    protected static function generateToken(): string
    {
        return sprintf("%04d", mt_rand(1, 9999));
    }

    public function send($callback): void
    {
        $callback($this->user, $this->token);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
