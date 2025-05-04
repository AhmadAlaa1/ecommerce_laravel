<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if ($user->role !== $role) {
            return response()->json(['message' => 'Forbidden: Insufficient privileges'], 403);
        }

        return $next($request);
    }
}
