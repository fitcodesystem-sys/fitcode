<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aula;

class GraficoController extends Controller
{
    public function index(){
        $aulas = Aula::withCount('users')->get();

        return view('dashboard',compact('aulas'));
      

    }
}
