<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckModuleActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, int $moduleId): Response
    {
        $user = $request->user();

        if (!$user || !$user->hasActiveModule($moduleId)) {
            return response()->json([
                'error' => 'Module inactive. Please activate this module to use it.'
            ], 403);
        }

        return $next($request);
    }
}
