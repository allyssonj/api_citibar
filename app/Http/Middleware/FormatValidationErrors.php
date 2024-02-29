<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FormatValidationErrors
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response->exception instanceof ValidationException) {
            return response()->json(['errors' => $response->exception->errors()], 422);
        }

        return $response;
    }
}
