<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
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
        $query = Matricula::with(['aluno', 'plano'])->orderBy('data_fim', 'asc');

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
        $alunos = Pessoa::all();

        return view('matriculas.create', compact('alunos'));
    }

    /**
     * Armazena uma nova matrícula no banco de dados.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pessoa_id'   => ['required', 'exists:pessoas,id'],
            'plano_id'    => ['required', 'string', 'max:255'],
            'data_inicio' => ['required', 'date'],
            'data_fim'    => ['required', 'date', 'after_or_equal:data_inicio'],
            'status'      => ['required', 'string', 'in:ativa,vencida'],
        ]);

        Matricula::create($validated);

        return redirect()->route('matriculas.index')
            ->with('success', __('Matrícula criada com sucesso!'));
    }

}
