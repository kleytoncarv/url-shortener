<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Stateful Domains
    |--------------------------------------------------------------------------
    |
    | Domínios que receberão autenticação via cookies (apenas SPA). Para API token bearer,
    | não é necessário, mas pode manter localhost para desenvolvimento.
    |
    */
    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', 'localhost,127.0.0.1')),

    /*
    |--------------------------------------------------------------------------
    | Guard
    |--------------------------------------------------------------------------
    |
    | Guard usado para autenticar a request.
    |
    */
    'guard' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Expiration
    |--------------------------------------------------------------------------
    |
    | Tempo em minutos até o token expirar. Null = sem expiração.
    |
    */
    'expiration' => null,

    /*
    |--------------------------------------------------------------------------
    | Token Prefix
    |--------------------------------------------------------------------------
    */
    'token_prefix' => env('SANCTUM_TOKEN_PREFIX', ''),

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Middleware usado para autenticação via SPA. Para API token, não é necessário.
    |
    */
    'middleware' => [
        'authenticate_session' => Laravel\Sanctum\Http\Middleware\AuthenticateSession::class,
    ],

];
