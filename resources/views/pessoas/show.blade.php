<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-zinc-100 leading-tight">
                {{ __('Detalhes da Pessoa') }}: {{ $pessoa->nome }}
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('pessoas.edit', $pessoa) }}" class="px-4 py-2 bg-cyan-600 text-white rounded-lg text-sm font-semibold hover:bg-cyan-500 transition shadow-[0_0_15px_rgba(6,182,212,0.5)]">
                    {{ __('Editar') }}
                </a>
                <a href="{{ route('pessoas.index') }}" class="px-4 py-2 bg-zinc-800 text-zinc-300 rounded-lg text-sm font-semibold hover:bg-zinc-700 transition">
                    {{ __('Voltar') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto w-full max-w-4xl space-y-6">

            {{-- Card de Informações Gerais --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 sm:p-8 shadow-2xl">
                <div class="flex items-center gap-4 mb-6 pb-6 border-b border-zinc-800">
                    <div class="w-16 h-16 rounded-full bg-cyan-950 border border-cyan-800 flex items-center justify-center text-cyan-300 font-bold text-xl uppercase shadow-[0_0_10px_rgba(6,182,212,0.3)]">
                        {{ substr($pessoa->nome, 0, 2) }}
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">{{ $pessoa->nome }}</h3>
                        <p class="text-sm text-zinc-400">{{ $pessoa->email }}</p>
                        <div class="mt-2">
                            @if($pessoa->eh_instrutor)
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-cyan-950 text-cyan-300 border border-cyan-800">
                                    {{ __('Instrutor') }}
                                </span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-zinc-800 text-zinc-400 border border-zinc-700">
                                    {{ __('Aluno') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">{{ __('Profissão') }}</span>
                        <p class="text-base text-zinc-200 mt-1">{{ $pessoa->profissao ?? __('Não informada') }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">{{ __('Cadastrado em') }}</span>
                        <p class="text-base text-zinc-200 mt-1">{{ $pessoa->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            {{-- Se for Instrutor: Listar Aulas Ministradas --}}
            @if($pessoa->eh_instrutor)
                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-2xl">
                    <h3 class="font-semibold text-lg text-zinc-100 mb-4">{{ __('Aulas Ministradas') }}</h3>
                    @if($pessoa->aulas->isEmpty())
                        <p class="text-zinc-500 text-sm py-4">{{ __('Nenhuma aula atribuída a este instrutor.') }}</p>
                    @else
                        <ul class="divide-y divide-zinc-800">
                            @foreach($pessoa->aulas as $aula)
                                <li class="py-3 flex justify-between items-center text-sm">
                                    <span class="text-white font-medium">{{ $aula->nome }}</span>
                                    <span class="text-zinc-400">{{ $aula->horario }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            {{-- Se for Aluno: Listar Matrículas --}}
            @else
                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-2xl">
                    <h3 class="font-semibold text-lg text-zinc-100 mb-4">{{ __('Matrículas do Aluno') }}</h3>
                    @if($pessoa->matriculas->isEmpty())
                        <p class="text-zinc-500 text-sm py-4">{{ __('Nenhuma matrícula encontrada para este aluno.') }}</p>
                    @else
                        <ul class="divide-y divide-zinc-800">
                            @foreach($pessoa->matriculas as $matricula)
                                <li class="py-3 flex justify-between items-center text-sm">
                                    <span class="text-white font-medium">{{ $matricula->aula->nome ?? __('Aula') }}</span>
                                    <span class="text-zinc-400">Início: {{ \Carbon\Carbon::parse($matricula->data_inicio)->format('d/m/Y') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endif

        </div>
    </div>
</x-app-layout>