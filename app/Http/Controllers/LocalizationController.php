<?php

namespace App\Http\Controllers;



class LocalizationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($locale)
    {
        /** Verifica se o idioma é válido. */
        if (! in_array($locale, config('localization.locales'), true)) {
            abort(404);
        }
        /* Armazena a localização na sessão */
        session(['locale'=> $locale]);

        return redirect()->back();
    }
}
