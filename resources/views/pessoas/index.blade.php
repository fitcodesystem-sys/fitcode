<script>
    window.traducao = {{ Illuminate\Support\Js::from([
        'excluirPessoa' => __('Tem certeza que deseja excluir esta pessoa?'),
    ]) }};
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-zinc-100">
                {{ __('Gerenciar Pessoas') }}
            </h2>
            <a href="{{ route('pessoas.create') }}" class="px-4 py-2 bg-cyan-600 hover:bg-cyan-500 text-white rounded-lg text-sm font-semibold transition shadow-[0_0_15px_rgba(6,182,212,0.5)]">
                {{ __('+ Adicionar Pessoa') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Mensagem de Sucesso --}}
            @if (session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-950 text-emerald-300 border border-emerald-800 shadow-[0_0_10px_rgba(16,185,129,0.3)]">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Área de Filtros (Abas Padronizadas Sleek Dark) --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-3 mb-8 flex items-center gap-2 shadow-inner">
                <a href="{{ route('pessoas.index', ['tipo' => 'todos']) }}" 
                   class="px-5 py-2 rounded-lg font-medium transition flex items-center gap-2 text-sm
                   {{ ($tipo ?? 'todos') === 'todos' ? 'bg-zinc-800 text-white shadow-md' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/60' }}">
                    <x-lucide-users class="w-4 h-4" />
                    {{ __('Todos') }}
                </a>
                <a href="{{ route('pessoas.index', ['tipo' => 'instrutores']) }}" 
                   class="px-5 py-2 rounded-lg font-medium transition flex items-center gap-2 text-sm
                   {{ ($tipo ?? '') === 'instrutores' ? 'bg-cyan-950 text-cyan-300 border border-cyan-800 shadow-[0_0_10px_rgba(6,182,212,0.3)]' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/60' }}">
                    <x-lucide-award class="w-4 h-4" />
                    {{ __('Instrutores') }}
                </a>
                <a href="{{ route('pessoas.index', ['tipo' => 'alunos']) }}" 
                   class="px-5 py-2 rounded-lg font-medium transition flex items-center gap-2 text-sm
                   {{ ($tipo ?? '') === 'alunos' ? 'bg-zinc-800 text-white shadow-md' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/60' }}">
                    <x-lucide-user class="w-4 h-4" />
                    {{ __('Alunos') }}
                </a>
            </div>

            <div class="bg-zinc-900 border border-zinc-800 overflow-hidden shadow-2xl sm:rounded-2xl">
                @if ($pessoas->isEmpty())
                    <p class="py-20 text-center text-zinc-600 bg-zinc-950/30">{{ __('Nenhuma Pessoa encontrada para este filtro.') }}</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-zinc-400">
                            <thead class="text-xs text-zinc-400 uppercase bg-zinc-800/30 border-b border-zinc-800">
                                <tr>
                                    <th scope="col" class="px-6 py-4">{{ __('Nome') }}</th>
                                    <th scope="col" class="px-6 py-4">{{ __('Email') }}</th>
                                    <th scope="col" class="px-6 py-4">{{ __('Profissão') }}</th>
                                    <th scope="col" class="px-6 py-4 text-center">{{ __('Perfil') }}</th>
                                    <th scope="col" class="px-6 py-4 text-right">{{ __('Ações') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-800">
                                @foreach ($pessoas as $pessoa)
                                    <tr class="hover:bg-zinc-800/30 transition">
                                        <td class="px-6 py-4 font-medium text-white whitespace-nowrap flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-cyan-950 border border-cyan-800 flex items-center justify-center text-cyan-300 font-bold text-xs uppercase shadow-[0_0_5px_rgba(6,182,212,0.3)]">
                                                {{ substr($pessoa->nome ?? 'US', 0, 2) }}
                                            </div>
                                            {{ $pessoa->nome }}
                                        </td>
                                        <td class="px-6 py-4 text-zinc-300">{{ $pessoa->email }}</td>
                                        <td class="px-6 py-4 text-zinc-300">{{ $pessoa->profissao ?? __('Não informada') }}</td>
                                        <td class="px-6 py-4 text-center">
                                            @if($pessoa->eh_instrutor)
                                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-cyan-950 text-cyan-300 border border-cyan-800 shadow-[0_0_8px_rgba(6,182,212,0.2)]">
                                                    {{ __('Instrutor') }}
                                                </span>
                                            @else
                                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-zinc-800 text-zinc-400 border border-zinc-700">
                                                    {{ __('Aluno') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-3">
                                                <a href="{{ route('pessoas.show', $pessoa) }}" class="text-zinc-400 hover:text-white transition font-medium text-xs">
                                                    {{ __('Visualizar') }}
                                                </a>
                                                <a href="{{ route('pessoas.edit', $pessoa) }}" class="text-cyan-400 hover:text-cyan-300 transition font-medium text-xs">
                                                    {{ __('Editar') }}
                                                </a>
                                                <form action="{{ route('pessoas.destroy', $pessoa) }}" method="POST" onsubmit="return confirm(window.traducao.excluirPessoa);" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-400 hover:text-red-300 transition font-medium text-xs">
                                                        {{ __('Excluir') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Links de Paginação --}}
                    <div class="p-6 border-t border-zinc-800">
                        {{ $pessoas->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>