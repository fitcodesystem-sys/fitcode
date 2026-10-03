<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificaAdm
{

    public  function  handle ( Request $request, Closure $next ) 
    { 
        if ($request->user()->role !== 'admin') {
    abort(403, 'Acesso negado');
}


        return $next($request); 
    } 
}

