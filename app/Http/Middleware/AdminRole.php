<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si l'utilisateur est authentifié et s'il a le rôle admin
        if (Auth::check() && Auth::user()->isAdmin()) { // Ajout des parenthèses
            return $next($request);
        }

        // Si l'utilisateur n'est pas admin ou non authentifié, retourner une erreur 403
        return abort(403, 'Accès refusé');
    }
}
