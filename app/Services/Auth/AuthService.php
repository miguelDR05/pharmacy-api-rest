<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    protected AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(string $email, string $password): array
    {
        $user = $this->authRepository->findByEmail($email);

        if (! $user || ! Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'credentials' => ['Correo o contraseña incorrectos.']
            ]);
        }

        $expiresAt = now()->addDays(30)->floorSecond();
        $token = $user->createToken('api-token', ['*'], $expiresAt);

        return [
            'token' => $token->plainTextToken,
            'user' => $user,
        ];
    }

    public function logout(User $user): void
    {
        $this->authRepository->revokeTokens($user);
    }

    public function user(User $user): User
    {
        return $user;
    }
}
