<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class PessoaController extends Controller
{
    public function index()
    {
        $pessoas = User::latest()->get();
        return view('pessoas.index', compact('pessoas'));
    }

    public function create()
    {
        return view('pessoas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'nullable|string',
            'eh_instrutor' => 'sometimes|boolean'
        ]);

        User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make(Str::random(40)),
        'role' => $request->boolean('eh_instrutor') ? 'admin' : 'user', /** ? é um operador que salva admin caso o boolean = 1 e user se boolean = 0 */
    ]);

    return redirect()->route('pessoas.index')
        ->with('success', __('Usuário cadastrado'));

       

        return redirect()->route('pessoas.index')->with('success', __('Usuário cadastrado'));
    }


  
     
    public function edit(User $pessoa)
    {
        return view('pessoas.edit', compact('pessoa'));
    }

    
    public function update(Request $request, User $pessoa)
    {
         $request->validate([
            
            'name' => 'required|string|max:255',
            'email'=> 'required|string|max:255',
            
           
        ]);

        
    


        $pessoa->update($request->all());

        return redirect()->route('pessoas.index')->with('success', __('usuário atualizado'));
    }



    public function destroy(User $pessoa)
    {
        $pessoa->delete();
        return redirect()->route('pessoas.index')->with('success', __('usuário removido'));
    }
}
