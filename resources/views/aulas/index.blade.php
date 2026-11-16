<script>
    window.traducao = {{ Illuminate\Support\Js::from([
        'excluirAula' => __('Tem certeza que deseja excluir esta aula?'),
    ]) }};
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-zinc-100 leading-tight">
                {{ __('Gerenciar Aulas') }}
            </h2>
            <a href="{{ route('aulas.create') }}" class="px-4 py-2 bg-cyan-600 text-white rounded-lg text-sm font-semibold hover:bg-cyan-500 transition shadow-[0_0_15px_rgba(6,182,212,0.5)]">
                {{ __('+ Nova Aula') }}
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

            {{-- Área de Filtros por Instrutor (Sleek Dark) --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-3 mb-8 flex items-center gap-2 shadow-inner overflow-x-auto">
                <a href="{{ route('aulas.index') }}" 
                   class="px-5 py-2 rounded-lg font-medium transition flex items-center gap-2 text-sm whitespace-nowrap
                   {{ empty($instrutorId) || $instrutorId === 'todos' ? 'bg-zinc-800 text-white shadow-md' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/60' }}">
                    <x-lucide-list class="w-4 h-4" />
                    {{ __('Todas as Aulas') }}
                </a>

                @foreach ($instrutores as $instrutor)
                    <a href="{{ route('aulas.index', ['instrutor_id' => $instrutor->id]) }}" 
                       class="px-5 py-2 rounded-lg font-medium transition flex items-center gap-2 text-sm whitespace-nowrap
                       {{ (string)($instrutorId ?? '') === (string)$instrutor->id ? 'bg-cyan-950 text-cyan-300 border border-cyan-800 shadow-[0_0_10px_rgba(6,182,212,0.3)]' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/60' }}">
                        <x-lucide-award class="w-4 h-4" />
                        {{ $instrutor->nome }}
                    </a>
                @endforeach
            </div>

            {{-- Tabela de Aulas (Sleek Dark) --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden shadow-2xl">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-zinc-800 bg-zinc-800/30">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-zinc-300">{{ __('Nome') }}</th>
                            <th class="px-6 py-4 font-semibold text-zinc-300">{{ __('Instrutor') }}</th>
                            <th class="px-6 py-4 font-semibold text-zinc-300">{{ __('Horário') }}</th>
                            <th class="px-6 py-4 font-semibold text-zinc-300">{{ __('Capacidade') }}</th>
                            <th class="px-6 py-4 font-semibold text-zinc-300 text-right">{{ __('Ações') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800">
                        @forelse ($aulas as $aula)
                            <tr class="hover:bg-zinc-800/30 transition">
                                <td class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                    {{ $aula->nome }}
                                </td>
                                <td class="px-6 py-4 text-zinc-300">
                                    {{ $aula->instrutor->nome ?? __('Não atribuído') }}
                                </td>
                                <td class="px-6 py-4 text-zinc-400">
                                    {{ $aula->horario }}
                                </td>
                                <td class="px-6 py-4 text-zinc-400">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-zinc-800 text-zinc-300 border border-zinc-700">
                                        {{ $aula->capacidade_maxima }} {{ __('alunos') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('aulas.show', $aula) }}" class="text-zinc-400 hover:text-white transition font-medium text-xs">
                                            {{ __('Visualizar') }}
                                        </a>
                                        <a href="{{ route('aulas.edit', $aula) }}" class="text-cyan-400 hover:text-cyan-300 transition font-medium text-xs">
                                            {{ __('Editar') }}
                                        </a>
                                        <form action="{{ route('aulas.destroy', $aula) }}" method="POST" onsubmit="return confirm(window.traducao.excluirAula);" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 transition font-medium text-xs">
                                                {{ __('Excluir') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-20 text-zinc-600 bg-zinc-950/30">
                                    {{ __('Nenhuma aula encontrada para este instrutor.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginação --}}
            <div class="mt-8">
                {{ $aulas->appends(['instrutor_id' => $instrutorId])->links() }}
            </div>

        </div>
    </div>
</x-app-layout>