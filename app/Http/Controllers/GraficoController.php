<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\Matricula;
use App\Models\Aula;
use Carbon\Carbon;

class GraficoController extends Controller
{
    public function index(){
        $hoje = Carbon::today();

        // Contadores
        $totalAlunos = Pessoa::where('eh_instrutor', false)->count();
        $totalInstrutores = Pessoa::where('eh_instrutor', true)->count();
        $totalReceitas = Matricula::sum('valor_pago');

        // Status de Matrículas
        $matriculasAtivas = Matricula::where('data_fim', '>=', $hoje)->count();
        $matriculasVencidas = Matricula::where('data_fim', '<', $hoje)->count();
        
        // Dados para o Gráfico (Aulas x Alunos matriculados)
        $aulas = Aula::withCount('matriculas')->get();
        $chartLabels = $aulas->pluck('nome');
        $chartData = $aulas->pluck('matriculas_count');

        return view('dashboard', compact(
            'aulas',
            'totalAlunos',
            'totalInstrutores',
            'totalReceitas',
            'matriculasAtivas',
            'matriculasVencidas',
            'chartLabels',
            'chartData'
        ));
       

    }
}
