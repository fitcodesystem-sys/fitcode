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
        // Obtém os idiomas suportados a partir das chaves do arquivo de configuração
        $supportedLocales = array_keys(config('localization.locales', []));

        /** Verifica se a sigla do idioma é válida. */
        if (! in_array($locale, $supportedLocales, true)) {
            abort(404);
        }
        /* Armazena a localização na sessão */
        session(['locale'=> $locale]);

        return redirect()->back();
    }
}
