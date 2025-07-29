<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Throwable;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /*
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

    public function user(Request $request)
    {
        try {
            $user = $this->authService->user($request->user());
            return responseApi(true, 'Usuario autenticado', 'Datos de sesión', $user);
        } catch (Throwable $e) {
            return responseApi(false, 'Error al recuperar usuario', 'Error', null, [
                'error_detail' => $e->getMessage()
            ], 500);
        }
    }*/

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->validated();

            // *** ESTO ES LO CRÍTICO: Usar Auth::attempt() ***
            if (! Auth::attempt($credentials)) {
                throw ValidationException::withMessages([
                    'email' => ['Las credenciales proporcionadas son incorrectas.'],
                ]);
            }

            // Si Auth::attempt() es exitoso, Laravel ya ha iniciado la sesión
            // y ha establecido la cookie de sesión en el navegador.
            // No necesitas generar un token personal aquí para la autenticación de SPA.

            // Opcional: Regenerar la sesión para prevenir ataques de fijación de sesión
            $request->session()->regenerate();

            return responseApi(true, 'Inicio de sesión exitoso', 'Bienvenido', [
                'user' => Auth::user(), // El usuario autenticado
            ]);
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
        Auth::guard('web')->logout(); // Invalida la sesión web

        $request->session()->invalidate(); // Invalida la sesión actual
        $request->session()->regenerateToken(); // Regenera el token CSRF

        return responseApi(true, 'Sesión cerrada exitosamente', 'Adiós', null);
    }

    public function user(Request $request)
    {
        return responseApi(true, 'Datos de usuario obtenidos', 'Usuario', $request->user());
    }
}
