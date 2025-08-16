<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Registra um novo usuário e retorna token de autenticação
     */
    public function register(Request $request)
    {
        // Validação dos dados
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Cria o usuário
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Cria token de autenticação
        $token = $user->createToken('auth_token')->plainTextToken;

        // Retorna sucesso com token
        return response()->json([
            'message' => 'Usuário registrado com sucesso',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * Faz login do usuário e retorna token
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais estão incorretas.'],
            ]);
        }

        // Cria token de autenticação
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login realizado com sucesso',
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    /**
     * Faz logout do usuário (revoga token atual)
     */
    public function logout(Request $request)
    {
        // Revoga o token do usuário que fez a requisição
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso',
        ], 200);
    }
}
