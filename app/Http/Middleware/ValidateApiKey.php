<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $key = $request->header('X-API-Key');

        if (!$key || !ApiKey::validate($key)) {
            return response()->json([
                'message' => 'API key inválida o ausente.',
            ], 401);
        }

        return $next($request);
    }
}
