<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class CheckNoUsers
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (User::count() > 0) {
            return redirect()->route('login')->with('error', 'Registro não disponível.');
        }

        return $next($request);
    }
}