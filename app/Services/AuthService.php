<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthService
{
    public function __construct(
        private UserRepository $userRepo
    ) {}

    public function attemptLogin(string $email, string $password)
    {
        $user = $this->userRepo->findByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            throw new HttpException(401, 'Invalid credentials.');
        }

        $token = $user->createToken('API Token')->plainTextToken;

        return [$token, $user];
    }

    public function logout($user): void
    {
        $user->currentAccessToken()?->delete();
    }

    public function register(array $data)
    {
        // Check if email already exists
        if ($this->userRepo->findByEmail($data['email'])) {
            throw new HttpException(409, 'Email already exists.');
        }

        $user = $this->userRepo->create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('API Token')->plainTextToken;

        return [$token, $user];
    }
}

