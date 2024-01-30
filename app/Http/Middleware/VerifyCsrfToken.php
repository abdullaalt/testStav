<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\HttpException;

class VerifyCsrfToken extends \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Указываем разрешенный домен
        $allowedDomain = ['http://abdulla-alt.com'];

        if (strpos($request->header('User-Agent'), 'PostmanRuntime') !== false) {
            return $next($request);
        }

        // Проверяем, что запрос пришел с разрешенного домена
        if (!in_array($request->header('Origin'), $allowedDomain)) {
            throw new HttpException(403, 'Доступ запрещен');
        }

        $response = $next($request);

        // Добавляем заголовки CORS
        $response->header('Access-Control-Allow-Origin', $allowedDomain);
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
        $response->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        return $response;
    }
}