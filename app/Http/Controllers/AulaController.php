<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    public function index()
    {
        $aulas = Aula::latest()->get();
        return view('aulas.index', compact('aulas'));
    }

    public function create()
    {
        return view('aulas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'horario' => 'required|string',
            'capacidade_maxima' => 'required|integer|min:1',
            'instrutor_id' => 'required|integer|max:3',
        ]);

        Aula::create($request->all());

        return redirect()->route('aulas.index')->with('success', 'Aula cadastrada com sucesso!');
    }


    /**
     * Exibe o formulário de edição de uma aula específica.
     */
    public function edit(Aula $aula)
    {
        return view('aulas.edit', compact('aula'));
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
            'instrutor' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $aula->update($request->all());

        return redirect()->route('aulas.index')->with('success', 'Aula atualizada com sucesso!');
    }



    public function destroy(Aula $aula)
    {
        $aula->delete();
        return redirect()->route('aulas.index')->with('success', 'Aula removida!');
    }
}
