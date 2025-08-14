<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Registra um novo usuário
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

        // Retorna sucesso
        return response()->json([
            'message' => 'Usuário registrado com sucesso',
            'user' => $user,
        ], 201);
    }

    /**
     * Faz login do usuário
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

        // Retorna sucesso (pode ser token ou usuário)
        return response()->json([
            'message' => 'Login realizado com sucesso',
            'user' => $user,
        ], 200);
    }
}
