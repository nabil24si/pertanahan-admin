<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        $userRole = Auth::user()->role;

        // 2. Jika role = Admin → boleh akses SEMUA
        if ($userRole === 'Admin') {
            return $next($request);
        }

        // 3. Jika user punya role yang diizinkan
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // 4. Selain itu → tolak

        return abort(403, 'Forbidden');
    }
}
