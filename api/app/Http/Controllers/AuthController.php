<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Handle user login.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // 1. Validar la petición de login
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Intentar encontrar el usuario por email
        $user = User::where('email', $request->email)->first();

        // 3. Verificar usuario y contraseña
        if (!$user || !Hash::check($request->password, $user->password)) {
            // Lanza una excepción si las credenciales son inválidas
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        // 4. Generar el token de autenticación (Sanctum)
        // Eliminamos tokens antiguos para evitar acumulación, luego creamos uno nuevo
        $user->tokens()->where('name', 'fenix_token')->delete();
        $token = $user->createToken('fenix_token')->plainTextToken;

        // 5. Devolver la respuesta con el token y el usuario
        return response()->json([
            'user' => $user,
            'token' => $token,
            'message' => 'Inicio de sesión exitoso.'
        ], 200);
    }

    /**
     * Get the authenticated User.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(Request $request)
    {
        // Esta función devuelve el usuario actualmente autenticado (via token Sanctum)
        return response()->json($request->user());
    }

    /**
     * Logout the authenticated user (Revoke token).
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Revocamos el token actual usado para la petición
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Cierre de sesión exitoso.'
        ], 200);
    }
}