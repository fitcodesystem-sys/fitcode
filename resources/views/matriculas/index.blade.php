<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-zinc-100 leading-tight">
                {{ __('Gerenciar Matrículas') }}
            </h2>
            <a href="{{ route('matriculas.create') }}" class="px-4 py-2 bg-cyan-600 text-white rounded-lg text-sm font-semibold hover:bg-cyan-500 transition shadow-[0_0_15px_rgba(6,182,212,0.5)]">
                + Nova Matrícula
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Área de Filtros (Abas) --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-3 mb-8 flex items-center gap-2 shadow-inner">
                <a href="{{ route('matriculas.index') }}" 
                   class="px-5 py-2 rounded-lg font-medium transition flex items-center gap-2 text-sm
                   {{ $currentFilter === 'todas' ? 'bg-zinc-800 text-white shadow-md' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/60' }}">
                    <x-lucide-list class="w-4 h-4" />
                    Todas
                </a>
                <a href="{{ route('matriculas.index', ['status' => 'ativas']) }}" 
                   class="px-5 py-2 rounded-lg font-medium transition flex items-center gap-2 text-sm
                   {{ $currentFilter === 'ativas' ? 'bg-emerald-950 text-emerald-300 border border-emerald-800 shadow-[0_0_10px_rgba(16,185,129,0.3)]' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/60' }}">
                    <x-lucide-check-circle class="w-4 h-4" />
                    Ativas
                </a>
                <a href="{{ route('matriculas.index', ['status' => 'vencidas']) }}" 
                   class="px-5 py-2 rounded-lg font-medium transition flex items-center gap-2 text-sm
                   {{ $currentFilter === 'vencidas' ? 'bg-red-950 text-red-300 border border-red-800 shadow-[0_0_10px_rgba(239,68,68,0.3)]' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/60' }}">
                    <x-lucide-x-circle class="w-4 h-4" />
                    Vencidas
                </a>
            </div>

            {{-- Tabela de Matrículas (Sleek Dark) --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden shadow-2xl">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-zinc-800 bg-zinc-800/30">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-zinc-300">Aluno</th>
                            <th class="px-6 py-4 font-semibold text-zinc-300">Plano</th>
                            <th class="px-6 py-4 font-semibold text-zinc-300">Data Início</th>
                            <th class="px-6 py-4 font-semibold text-zinc-300">Data Fim</th>
                            <th class="px-6 py-4 font-semibold text-zinc-300 text-center">Status</th>
                            <th class="px-6 py-4 font-semibold text-zinc-300 text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800">
                        @forelse ($matriculas as $matricula)
                            <tr class="hover:bg-zinc-800/30 transition">
                                <td class="px-6 py-4 font-medium text-white flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-cyan-950 border border-cyan-800 flex items-center justify-center text-cyan-300 font-bold text-xs uppercase shadow-[0_0_5px_rgba(6,182,212,0.3)]">
                                        {{ substr($matricula->aluno->name ?? 'AL', 0, 2) }}
                                    </div>
                                    {{ $matricula->aluno->name ?? 'Aluno não encontrado' }}
                                </td>
                                <td class="px-6 py-4 text-zinc-300">{{ $matricula->plano->nome ?? 'Plano' }}</td>
                                <td class="px-6 py-4 text-zinc-400">{{ \Carbon\Carbon::parse($matricula->data_inicio)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-zinc-400 font-medium">
                                    {{ \Carbon\Carbon::parse($matricula->data_fim)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if(\Carbon\Carbon::parse($matricula->data_fim)->isPast() || $matricula->status === 'vencida')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-950 text-red-300 border border-red-800 shadow-[0_0_8px_rgba(239,68,68,0.4)]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                                            Vencida
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-950 text-emerald-300 border border-emerald-800 shadow-[0_0_8px_rgba(16,185,129,0.4)]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Ativa
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('matriculas.show', $matricula) }}" class="text-zinc-500 hover:text-white transition">Visualizar</a>
                                    <a href="{{ route('matriculas.edit', $matricula) }}" class="text-cyan-400 hover:text-cyan-300 font-medium transition">Editar</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-20 text-zinc-600 bg-zinc-950/30">
                                    Nenhuma matrícula encontrada para o filtro selecionado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginação --}}
            <div class="mt-8">
                {{ $matriculas->appends(['status' => $currentFilter])->links() }}
            </div>

        </div>
    </div>
</x-app-layout>