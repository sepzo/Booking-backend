<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    ) {}

    public function login(LoginRequest $request)
    {
        try {
            [$token, $user] = $this->authService->attemptLogin(
                $request->email,
                $request->password
            );

            $data = [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ];

            return api_success($data, 'Login successful');

        } catch (HttpException $e) {
            return api_error($e->getMessage(), $e->getStatusCode());
        } catch (\Exception $e) {
            Log::error('Auth login error', [
                'error' => $e->getMessage(),
                'input' => $request->only('email')
            ]);
            return api_error('Unexpected error during login.', 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $this->authService->logout($request->user());
            return api_success(null, 'Successfully logged out');
        } catch (HttpException $e) {
            return api_error($e->getMessage(), $e->getStatusCode());
        } catch (\Exception $e) {
            Log::error('Auth logout error', ['error' => $e->getMessage()]);
            return api_error('Unexpected error during logout.', 500);
        }
    }
}
