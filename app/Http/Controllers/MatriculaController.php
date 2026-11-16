<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Pessoa;
use App\Models\Aula;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    /**
     * Exibe a listagem de matrículas com filtros aplicados.
     */
    public function index(Request $request)
    {
        // Obtém o filtro atual da URL (ex: ?status=ativas)
        $currentFilter = $request->query('status', 'todas'); // Padrão é 'todas'

        // Inicia a query base carregando relacionamentos para evitar N+1 queries
        $query = Matricula::with(['aluno', 'aula'])->orderBy('data_fim', 'asc');

        // Aplica o filtro baseado na seleção do usuário usando as scopes do Model
        if ($currentFilter === 'ativas') {
            $query->ativas();
        } elseif ($currentFilter === 'vencidas') {
            $query->vencidas();
        }

        // Pagina o resultado (ex: 15 por página)
        $matriculas = $query->paginate(15);

        // Retorna a view com os dados
        return view('matriculas.index', compact('matriculas', 'currentFilter'));
    }

    
    /**
     * Exibe o formulário de criação de nova matrícula.
     */
    public function create()
    {
        // Busca os alunos (Pessoas) cadastrados para preencher o select
#        $alunos = Pessoa::all();
        $pessoas = Pessoa::orderBy('nome')->get();
        $aulas = Aula::orderBy('nome')->get();

#        return view('matriculas.create', compact('alunos'));
        return view('matriculas.create', compact('pessoas', 'aulas'));
    }


    /**
     * Exibe o formulário de edição de uma matrícula existente.
     */
    public function edit(Matricula $matricula)
    {
        $pessoas = Pessoa::orderBy('nome')->get();
        $aulas = Aula::orderBy('nome')->get();

        return view('matriculas.edit', compact('matricula', 'pessoas', 'aulas'));
    }
    
    /**
     * Armazena uma nova matrícula no banco de dados.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pessoa_id' => ['required', 'exists:pessoas,id'],
            'aula_id' => ['required', 'exists:aulas,id'],
            'data_matricula' => ['required', 'date'],
            'valor_pago' => ['required', 'numeric', 'min:0'],
            'data_pagamento' => ['nullable', 'date'],
            'data_inicio' => ['nullable', 'date'],
            'data_fim' => ['nullable', 'date', 'after_or_equal:data_inicio'],
            'observacoes' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:ativa,vencida,cancelada,pendente'],
        ]);

        Matricula::create($validated);

        return redirect()->route('matriculas.index')
            ->with('success', __('Matrícula criada com sucesso!'));
    }

    /**
    * Exibe os detalhes de uma matrícula específica.
    */
    public function show(Matricula $matricula)
    {
    // Carrega explicitamente os relacionamentos caso já não venham carregados
        $matricula->load(['aluno', 'aula']);

        return view('matriculas.show', compact('matricula'));
    }

}
