<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProjectStatusAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $status = $request->get('status');
        
        // Solo admin può accedere ai draft
        if ($status === 'draft' && (!auth()->check() || !auth()->user()->isAdmin())) {
            abort(403, 'Non hai i permessi per visualizzare questi progetti.');
        }
        
        return $next($request);
    }
}
