<?php

namespace App\Repositories\Auth;

use App\Models\User;

class AuthRepository
{
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function revokeTokens(User $user): void
    {
        $user->tokens()->delete();
    }
}
