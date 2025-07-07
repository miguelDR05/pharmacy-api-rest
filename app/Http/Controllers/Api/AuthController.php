<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Throwable;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->validated();

            $data = $this->authService->login(
                $credentials['email'],
                $credentials['password']
            );

            return responseApi(true, 'Inicio de sesión exitoso', 'Bienvenido', $data);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return responseApi(false, 'Credenciales inválidas', 'Error de autenticación', null, [
                'errors' => $e->errors()
            ], 422);
        } catch (Throwable $e) {
            return responseApi(false, 'Ocurrió un error inesperado', 'Error interno', null, [
                'error_detail' => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $this->authService->logout($request->user());
            return responseApi(true, 'Sesión cerrada', 'Hasta luego');
        } catch (Throwable $e) {
            return responseApi(false, 'Error al cerrar sesión', 'Error', null, [
                'error_detail' => $e->getMessage()
            ], 500);
        }
    }

    public function me(Request $request)
    {
        try {
            $user = $this->authService->me($request->user());
            return responseApi(true, 'Usuario autenticado', 'Datos de sesión', $user);
        } catch (Throwable $e) {
            return responseApi(false, 'Error al recuperar usuario', 'Error', null, [
                'error_detail' => $e->getMessage()
            ], 500);
        }
    }
}
