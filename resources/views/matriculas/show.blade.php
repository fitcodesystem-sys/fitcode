<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-zinc-100 leading-tight">
                {{ __('Detalhes da Matrícula') }} #{{ $matricula->id }}
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('matriculas.edit', $matricula) }}" class="px-4 py-2 bg-cyan-600 text-white rounded-lg text-sm font-semibold hover:bg-cyan-500 transition shadow-[0_0_15px_rgba(6,182,212,0.5)]">
                    {{ __('Editar Matrícula') }}
                </a>
                <a href="{{ route('matriculas.index') }}" class="px-4 py-2 bg-zinc-800 text-zinc-300 rounded-lg text-sm font-semibold hover:bg-zinc-700 transition">
                    {{ __('Voltar') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto w-full max-w-4xl space-y-6">

            {{-- Card Principal: Status e Informações Gerais --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 sm:p-8 shadow-2xl">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-zinc-800 pb-6 mb-6">
                    <div>
                        <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">{{ __('Status Atual') }}</span>
                        <div class="mt-1">
                            @if(\Carbon\Carbon::parse($matricula->data_fim)->isPast() || $matricula->status === 'vencida')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-950 text-red-300 border border-red-800 shadow-[0_0_8px_rgba(239,68,68,0.4)]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                                    {{ __('Vencida') }}
                                </span>
                            @elseif($matricula->status === 'ativa')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-950 text-emerald-300 border border-emerald-800 shadow-[0_0_8px_rgba(16,185,129,0.4)]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    {{ __('Ativa') }}
                                </span>
                            @elseif($matricula->status === 'pendente')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-950 text-amber-300 border border-amber-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    {{ __('Pendente') }}
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-zinc-800 text-zinc-300 border border-zinc-700">
                                    {{ ucfirst($matricula->status) }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="text-left sm:text-right">
                        <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">{{ __('Data da Matrícula') }}</span>
                        <p class="text-lg font-semibold text-white mt-1">
                            {{ \Carbon\Carbon::parse($matricula->data_matricula)->format('d/m/Y') }}
                        </p>
                    </div>
                </div>

                {{-- Grid de Detalhes (Aluno e Aula) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-zinc-800/40 border border-zinc-800 rounded-xl p-5">
                        <span class="text-xs font-medium text-cyan-400 uppercase tracking-wider">{{ __('Dados do Aluno') }}</span>
                        <h3 class="text-lg font-bold text-white mt-2">
                            {{ $matricula->aluno->nome ?? __('Aluno não encontrado') }}
                        </h3>
                        <p class="text-sm text-zinc-400 mt-1">CPF: {{ $matricula->aluno->cpf ?? 'N/A' }}</p>
                        <p class="text-sm text-zinc-400">E-mail: {{ $matricula->aluno->email ?? 'N/A' }}</p>
                    </div>

                    <div class="bg-zinc-800/40 border border-zinc-800 rounded-xl p-5">
                        <span class="text-xs font-medium text-cyan-400 uppercase tracking-wider">{{ __('Dados da Aula') }}</span>
                        <h3 class="text-lg font-bold text-white mt-2">
                            {{ $matricula->aula->nome ?? __('Aula não encontrada') }}
                        </h3>
                        <p class="text-sm text-zinc-400 mt-1">Horário: {{ $matricula->aula->horario ?? 'N/A' }}</p>
                        <p class="text-sm text-zinc-400">Capacidade: {{ $matricula->aula->capacidade_maxima ?? 'N/A' }} alunos</p>
                    </div>
                </div>

                {{-- Grid de Vigência e Financeiro --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-zinc-800">
                    <div>
                        <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">{{ __('Período de Vigência') }}</span>
                        <p class="text-sm font-medium text-white mt-1">
                            {{ optional($matricula->data_inicio)->format('d/m/Y') ?? 'Não informada' }} até 
                            {{ optional($matricula->data_fim)->format('d/m/Y') ?? 'Não informada' }}
                        </p>
                    </div>
                    <div>
                        <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">{{ __('Valor Pago') }}</span>
                        <p class="text-lg font-bold text-emerald-400 mt-1">
                            R$ {{ number_format($matricula->valor_pago, 2, ',', '.') }}
                        </p>
                    </div>
                    <div>
                        <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">{{ __('Data do Pagamento') }}</span>
                        <p class="text-sm font-medium text-white mt-1">
                            {{ $matricula->data_pagamento ? \Carbon\Carbon::parse($matricula->data_pagamento)->format('d/m/Y') : __('Pendente / Não paga') }}
                        </p>
                    </div>
                </div>

                {{-- Observações (se houver) --}}
                @if($matricula->observacoes)
                    <div class="mt-6 pt-6 border-t border-zinc-800">
                        <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">{{ __('Observações') }}</span>
                        <p class="text-sm text-zinc-300 bg-zinc-950/40 border border-zinc-800 rounded-xl p-4 mt-2">
                            {{ $matricula->observacoes }}
                        </p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>