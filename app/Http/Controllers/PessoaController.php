<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public function index(Request $request)
    {
        $tipo = $request->query('tipo', 'todos');
    
        $query = Pessoa::latest();

        if ($tipo === 'instrutores') {
            $query->instrutores();
        } elseif ($tipo === 'alunos') {
            $query->alunos();
        }

#        $pessoas = $query->paginate(15);
        $pessoas = $query->paginate(15)->withQueryString();

        return view('pessoas.index', compact('pessoas', 'tipo'));
    }



    public function create()
    {
        return view('pessoas.create');
    }

    public function store(Request $request)
    {
        $request->merge([
            'cpf' => preg_replace('/[^0-9]/', '', $request->cpf),
            'responsavel_documento' => preg_replace('/[^0-9]/', '', $request->responsavel_documento),
        ]);

        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:11', 'unique:pessoas,cpf'],
            'rg' => ['required', 'string', 'max:9'],
            'genero' => ['required', 'in:masculino,feminino,outro'],
            'profissao' => ['required', 'string', 'max:32'],
            'nascimento' => ['required', 'date'],
            'email' => ['required', 'email', 'max:128', 'unique:pessoas,email'],            
            'contato_emergencia' => ['required', 'string', 'max:128'],
            'saude' => ['required', 'string'],
            'eh_instrutor' => ['nullable', 'boolean'],

            // Aqui é obrigatório apenas se menor de idade
            'responsavel_nome' => [
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->nascimento && \Carbon\Carbon::parse($request->nascimento)->age < 18 && empty($value)) {
                        $fail(__('O nome do responsável é obrigatório para menores de idade.'));
                    }
                },
                'nullable', 'string', 'max:128'
            ],
            'responsavel_parentesco' => [
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->nascimento && \Carbon\Carbon::parse($request->nascimento)->age < 18 && empty($value)) {
                        $fail(__('O parentesco do responsável é obrigatório para menores de idade.'));
                    }
                },
                'nullable', 'string', 'max:128'
            ],
            'responsavel_contato' => [
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->nascimento && \Carbon\Carbon::parse($request->nascimento)->age < 18 && empty($value)) {
                        $fail(__('O contato do responsável é obrigatório para menores de idade.'));
                    }
                },
                'nullable', 'string', 'max:128'
            ],
            'responsavel_documento' => [
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->nascimento && \Carbon\Carbon::parse($request->nascimento)->age < 18 && empty($value)) {
                        $fail(__('O documento do responsável é obrigatório para menores de idade.'));
                    }
                },
                'nullable', 'string', 'max:11'
            ],
        ]);
        $validated['responsavel_nome'] = $validated['responsavel_nome'] ?? null;
        $validated['responsavel_parentesco'] = $validated['responsavel_parentesco'] ?? null;
        $validated['responsavel_contato'] = $validated['responsavel_contato'] ?? null;
        $validated['responsavel_documento'] = $validated['responsavel_documento'] ?? null;
        Pessoa::create($validated);

        return redirect()->route('pessoas.index')
            ->with('success', __('Pessoa cadastrada com sucesso!'));
    }

    public function edit(Pessoa $pessoa)
    {
        return view('pessoas.edit', compact('pessoa'));
    }

    public function update(Request $request, Pessoa $pessoa)
    {
        $request->merge([
            'cpf' => preg_replace('/[^0-9]/', '', $request->cpf),
            'responsavel_documento' => preg_replace('/[^0-9]/', '', $request->responsavel_documento),
        ]);
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:11', 'unique:pessoas,cpf,' . $pessoa->id],
            'rg' => ['required', 'string', 'max:9'],
            'genero' => ['required', 'in:masculino,feminino,outro'],
            'profissao' => ['required', 'string', 'max:32'],
            'nascimento' => ['required', 'date'],
            'email' => ['required', 'email', 'max:128', 'unique:pessoas,email,' . $pessoa->id],
            'contato_emergencia' => ['required', 'string', 'max:128'],
            'saude' => ['required', 'string'],
            'eh_instrutor' => ['nullable', 'boolean'],
            // Aqui é obrigatório apenas se menor de idade
            'responsavel_nome' => [
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->nascimento && \Carbon\Carbon::parse($request->nascimento)->age < 18 && empty($value)) {
                        $fail(__('O nome do responsável é obrigatório para menores de idade.'));
                    }
                },
                'nullable', 'string', 'max:128'
            ],
            'responsavel_parentesco' => [
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->nascimento && \Carbon\Carbon::parse($request->nascimento)->age < 18 && empty($value)) {
                        $fail(__('O parentesco do responsável é obrigatório para menores de idade.'));
                    }
                },
                'nullable', 'string', 'max:128'
            ],
            'responsavel_contato' => [
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->nascimento && \Carbon\Carbon::parse($request->nascimento)->age < 18 && empty($value)) {
                        $fail(__('O contato do responsável é obrigatório para menores de idade.'));
                    }
                },
                'nullable', 'string', 'max:128'
            ],
            'responsavel_documento' => [
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->nascimento && \Carbon\Carbon::parse($request->nascimento)->age < 18 && empty($value)) {
                        $fail(__('O documento do responsável é obrigatório para menores de idade.'));
                    }
                },
                'nullable', 'string', 'max:11'
            ],
        ]);
        $validated['responsavel_nome'] = $validated['responsavel_nome'] ?? null;
        $validated['responsavel_parentesco'] = $validated['responsavel_parentesco'] ?? null;
        $validated['responsavel_contato'] = $validated['responsavel_contato'] ?? null;
        $validated['responsavel_documento'] = $validated['responsavel_documento'] ?? null;
        
        $pessoa->update($validated);

        return redirect()->route('pessoas.index')
            ->with('success', __('Pessoa atualizada com sucesso!'));
    }

    public function destroy(Pessoa $pessoa)
    {
        $pessoa->delete();
        
        return redirect()->route('pessoas.index')
            ->with('success', __('Pessoa removida com sucesso!'));
    }
}