<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    public function index(Request $request)
{
    $instrutorId = $request->query('instrutor_id');

    // Inicia a query com o relacionamento do instrutor
    $query = Aula::with('instrutor');

    // Filtra por instrutor se informado e válido
    if ($instrutorId && $instrutorId !== 'todos') {
        $query->where('instrutor_id', $instrutorId);
    }

    $aulas = $query->latest()->paginate(10)->withQueryString();
    
    // Busca apenas as pessoas que são instrutores para alimentar as abas
    $instrutores = Pessoa::where('eh_instrutor', true)->orderBy('nome')->get();

    return view('aulas.index', compact('aulas', 'instrutores', 'instrutorId'));
}

#    public function create()
#    {
#        return view('aulas.create');
#    }

    public function create()
    {
        $instrutores = Pessoa::instrutores()->orderBy('nome')->get();
        return view('aulas.create', compact('instrutores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'horario' => 'required|string',
            'capacidade_maxima' => 'required|integer|min:1',
            'instrutor_id' => ['required', 'exists:pessoas,id'],
        ]);

        Aula::create($request->all());

        return redirect()->route('aulas.index')->with('success', __('Aula cadastrada com sucesso!'));
    }


    /**
     * Exibe o formulário de edição de uma aula específica.
     */
    public function edit(Aula $aula)
    {
        $instrutores = Pessoa::instrutores()->orderBy('nome')->get();
        return view('aulas.edit', compact('aula', 'instrutores'));
    }

    /**
     * Atualiza os dados da aula no banco de dados.
     */
    public function update(Request $request, Aula $aula)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'horario' => 'required|string',
            'capacidade_maxima' => 'required|integer|min:1',
            'instrutor_id' => ['required', 'exists:pessoas,id'],
            'descricao' => 'nullable|string',
        ]);

        $aula->update($request->all());

        return redirect()->route('aulas.index')->with('success', __('Aula atualizada com sucesso!'));
    }

    public function show(Aula $aula)
    {
    // Carrega o instrutor e as matrículas com seus respectivos alunos
        $aula->load(['instrutor', 'matriculas.aluno']);

        return view('aulas.show', compact('aula'));
    }

    public function destroy(Aula $aula)
    {
        $aula->delete();
        return redirect()->route('aulas.index')->with('success', __('Aula removida!'));
    }
}
