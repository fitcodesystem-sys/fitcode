<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Localization
 {
    public function handle(Request $request, Closure $next)
    {
        /** Seta a localização de acordo com o que está no config */
        app()->setLocale(session('locale', config('app.locale')));

        return $next($request);
    }
}
