<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-zinc-100 leading-tight">
                {{ __('Detalhes da Aula') }}: {{ $aula->nome }}
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('aulas.edit', $aula) }}" class="px-4 py-2 bg-cyan-600 text-white rounded-lg text-sm font-semibold hover:bg-cyan-500 transition shadow-[0_0_15px_rgba(6,182,212,0.5)]">
                    {{ __('Editar Aula') }}
                </a>
                <a href="{{ route('aulas.index') }}" class="px-4 py-2 bg-zinc-800 text-zinc-300 rounded-lg text-sm font-semibold hover:bg-zinc-700 transition">
                    {{ __('Voltar') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto w-full max-w-5xl space-y-6">

            {{-- Card de Informações Gerais da Aula --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 sm:p-8 shadow-2xl">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 pb-6 border-b border-zinc-800">
                    <div>
                        <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">{{ __('Horário') }}</span>
                        <p class="text-lg font-semibold text-white mt-1">
                            {{ $aula->horario }}
                        </p>
                    </div>
                    <div>
                        <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">{{ __('Capacidade Máxima') }}</span>
                        <p class="text-lg font-semibold text-white mt-1">
                            {{ $aula->capacidade_maxima }} {{ __('alunos') }}
                        </p>
                    </div>
                    <div>
                        <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">{{ __('Vagas Ocupadas') }}</span>
                        <p class="text-lg font-semibold text-cyan-400 mt-1">
                            {{ $aula->matriculas->count() }} / {{ $aula->capacidade_maxima }}
                        </p>
                    </div>
                </div>

                {{-- Instrutor Responsável --}}
                <div class="bg-zinc-800/40 border border-zinc-800 rounded-xl p-5 mb-6">
                    <span class="text-xs font-medium text-cyan-400 uppercase tracking-wider">{{ __('Instrutor Responsável') }}</span>
                    <h3 class="text-lg font-bold text-white mt-2">
                        {{ $aula->instrutor->nome ?? __('Nenhum instrutor atribuído') }}
                    </h3>
                    @if($aula->instrutor)
                        <p class="text-sm text-zinc-400 mt-1">E-mail: {{ $aula->instrutor->email ?? 'N/A' }}</p>
                    @endif
                </div>

                {{-- Descrição (se houver) --}}
                @if($aula->descricao)
                    <div>
                        <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">{{ __('Descrição / Observações') }}</span>
                        <p class="text-sm text-zinc-300 bg-zinc-950/40 border border-zinc-800 rounded-xl p-4 mt-2">
                            {{ $aula->descricao }}
                        </p>
                    </div>
                @endif
            </div>

            {{-- Seção: Alunos Matriculados nesta Aula --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden shadow-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold text-lg text-zinc-100">
                        {{ __('Alunos Matriculados') }}
                    </h3>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-zinc-800 text-zinc-300 border border-zinc-700">
                        Total: {{ $aula->matriculas->count() }}
                    </span>
                </div>

                @if($aula->matriculas->isEmpty())
                    <p class="py-10 text-center text-zinc-500">{{ __('Nenhum aluno matriculado nesta aula até o momento.') }}</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-zinc-400">
                            <thead class="text-xs text-zinc-400 uppercase bg-zinc-800/40 border-b border-zinc-800">
                                <tr>
                                    <th class="px-6 py-4">{{ __('Aluno') }}</th>
                                    <th class="px-6 py-4">{{ __('Data da Matrícula') }}</th>
                                    <th class="px-6 py-4 text-center">{{ __('Status') }}</th>
                                    <th class="px-6 py-4 text-right">{{ __('Ações') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-800">
                                @foreach($aula->matriculas as $matricula)
                                    <tr class="hover:bg-zinc-800/30 transition">
                                        <td class="px-6 py-4 font-medium text-white flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-cyan-950 border border-cyan-800 flex items-center justify-center text-cyan-300 font-bold text-xs uppercase shadow-[0_0_5px_rgba(6,182,212,0.3)]">
                                                {{ substr($matricula->aluno->nome ?? 'AL', 0, 2) }}
                                            </div>
                                            {{ $matricula->aluno->nome ?? __('Aluno não encontrado') }}
                                        </td>
                                        <td class="px-6 py-4 text-zinc-300">
                                            {{ \Carbon\Carbon::parse($matricula->data_matricula)->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if($matricula->status === 'ativa')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-950 text-emerald-300 border border-emerald-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Ativa
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-zinc-800 text-zinc-300 border border-zinc-700">
                                                    {{ ucfirst($matricula->status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('matriculas.show', $matricula) }}" class="text-cyan-400 hover:text-cyan-300 font-medium transition">
                                                {{ __('Ver Matrícula') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>