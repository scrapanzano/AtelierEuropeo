<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Array delle lingue supportate
        $supportedLocales = ['it', 'en'];
        
        // Ottieni la lingua dalla sessione, dai parametri URL o usa quella predefinita
        $locale = $request->get('lang') ?? Session::get('locale') ?? config('app.locale');
        
        // Verifica che la lingua sia supportata
        if (!in_array($locale, $supportedLocales)) {
            $locale = config('app.locale');
        }
        
        // Imposta la lingua per l'applicazione
        App::setLocale($locale);
        
        // Salva la lingua nella sessione per le richieste future
        Session::put('locale', $locale);
        
        return $next($request);
    }
}
