<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-100 leading-tight">
            {{ __('Editar Matrícula') }} #{{ $matricula->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto w-full max-w-4xl rounded-2xl border border-zinc-800 bg-zinc-900 p-6 sm:p-8 shadow-2xl">
            
            <form action="{{ route('matriculas.update', $matricula) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Seleção de Aluno (Pessoa) --}}
                    <div>
                        <x-input-label for="pessoa_id" :value="__('Aluno')" class="text-zinc-300" />
                        <select id="pessoa_id" name="pessoa_id" class="mt-1 block w-full rounded-md bg-zinc-800 border-zinc-700 text-zinc-100 shadow-sm focus:border-cyan-500 focus:ring-cyan-500" required autofocus>
                            <option value="">{{ __('Selecione um aluno...') }}</option>
                            @foreach ($pessoas as $pessoa)
                                <option value="{{ $pessoa->id }}" {{ old('pessoa_id', $matricula->pessoa_id) == $pessoa->id ? 'selected' : '' }}>
                                    {{ $pessoa->nome }} (CPF: {{ $pessoa->cpf }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('pessoa_id')" class="mt-2 text-red-400" />
                    </div>

                    {{-- Seleção de Aula --}}
                    <div>
                        <x-input-label for="aula_id" :value="__('Aula')" class="text-zinc-300" />
                        <select id="aula_id" name="aula_id" class="mt-1 block w-full rounded-md bg-zinc-800 border-zinc-700 text-zinc-100 shadow-sm focus:border-cyan-500 focus:ring-cyan-500" required>
                            <option value="">{{ __('Selecione uma aula...') }}</option>
                            @foreach ($aulas as $aula)
                                <option value="{{ $aula->id }}" {{ old('aula_id', $matricula->aula_id) == $aula->id ? 'selected' : '' }}>
                                    {{ $aula->nome }} — {{ $aula->horario }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('aula_id')" class="mt-2 text-red-400" />
                    </div>

                    {{-- Data da Matrícula --}}
                    <div>
                        <x-input-label for="data_matricula" :value="__('Data da Matrícula')" class="text-zinc-300" />
                        <x-text-input id="data_matricula" name="data_matricula" type="date" class="mt-1 block w-full bg-zinc-800 border-zinc-700 text-zinc-100 focus:border-cyan-500 focus:ring-cyan-500" :value="old('data_matricula', optional($matricula->data_matricula)->format('Y-m-d') ?? $matricula->data_matricula)" required />
                        <x-input-error :messages="$errors->get('data_matricula')" class="mt-2 text-red-400" />
                    </div>

                    {{-- Valor Pago --}}
                    <div>
                        <x-input-label for="valor_pago" :value="__('Valor Pago (R$)')" class="text-zinc-300" />
                        <x-text-input id="valor_pago" name="valor_pago" type="number" step="0.01" min="0" class="mt-1 block w-full bg-zinc-800 border-zinc-700 text-zinc-100 focus:border-cyan-500 focus:ring-cyan-500" :value="old('valor_pago', $matricula->valor_pago)" required />
                        <x-input-error :messages="$errors->get('valor_pago')" class="mt-2 text-red-400" />
                    </div>

                    {{-- Data de Início --}}
                    <div>
                        <x-input-label for="data_inicio" :value="__('Data de Início')" class="text-zinc-300" />
                        <x-text-input id="data_inicio" name="data_inicio" type="date" class="mt-1 block w-full bg-zinc-800 border-zinc-700 text-zinc-100 focus:border-cyan-500 focus:ring-cyan-500" :value="old('data_inicio', optional($matricula->data_inicio)->format('Y-m-d') ?? $matricula->data_inicio)" />
                        <x-input-error :messages="$errors->get('data_inicio')" class="mt-2 text-red-400" />
                    </div>

                    {{-- Data de Fim --}}
                    <div>
                        <x-input-label for="data_fim" :value="__('Data de Término')" class="text-zinc-300" />
                        <x-text-input id="data_fim" name="data_fim" type="date" class="mt-1 block w-full bg-zinc-800 border-zinc-700 text-zinc-100 focus:border-cyan-500 focus:ring-cyan-500" :value="old('data_fim', optional($matricula->data_fim)->format('Y-m-d') ?? $matricula->data_fim)" />
                        <x-input-error :messages="$errors->get('data_fim')" class="mt-2 text-red-400" />
                    </div>

                    {{-- Data de Pagamento --}}
                    <div>
                        <x-input-label for="data_pagamento" :value="__('Data do Pagamento')" class="text-zinc-300" />
                        <x-text-input id="data_pagamento" name="data_pagamento" type="date" class="mt-1 block w-full bg-zinc-800 border-zinc-700 text-zinc-100 focus:border-cyan-500 focus:ring-cyan-500" :value="old('data_pagamento', optional($matricula->data_pagamento)->format('Y-m-d') ?? $matricula->data_pagamento)" />
                        <x-input-error :messages="$errors->get('data_pagamento')" class="mt-2 text-red-400" />
                    </div>

                    {{-- Status --}}
                    <div>
                        <x-input-label for="status" :value="__('Status da Matrícula')" class="text-zinc-300" />
                        <select id="status" name="status" class="mt-1 block w-full rounded-md bg-zinc-800 border-zinc-700 text-zinc-100 shadow-sm focus:border-cyan-500 focus:ring-cyan-500" required>
                            <option value="ativa" {{ old('status', $matricula->status) == 'ativa' ? 'selected' : '' }}>{{ __('Ativa') }}</option>
                            <option value="pendente" {{ old('status', $matricula->status) == 'pendente' ? 'selected' : '' }}>{{ __('Pendente') }}</option>
                            <option value="vencida" {{ old('status', $matricula->status) == 'vencida' ? 'selected' : '' }}>{{ __('Vencida') }}</option>
                            <option value="cancelada" {{ old('status', $matricula->status) == 'cancelada' ? 'selected' : '' }}>{{ __('Cancelada') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2 text-red-400" />
                    </div>

                    {{-- Observações (Ocupa largura total) --}}
                    <div class="md:col-span-2">
                        <x-input-label for="observacoes" :value="__('Observações (Opcional)')" class="text-zinc-300" />
                        <textarea id="observacoes" name="observacoes" rows="3" class="mt-1 block w-full rounded-md bg-zinc-800 border-zinc-700 text-zinc-100 shadow-sm focus:border-cyan-500 focus:ring-cyan-500">{{ old('observacoes', $matricula->observacoes) }}</textarea>
                        <x-input-error :messages="$errors->get('observacoes')" class="mt-2 text-red-400" />
                    </div>

                </div>

                {{-- Botões de Ação --}}
                <div class="flex items-center justify-end gap-4 border-t border-zinc-800 pt-6">
                    <a href="{{ route('matriculas.index') }}" class="text-sm text-zinc-400 hover:text-zinc-100 underline transition">
                        {{ __('Cancelar') }}
                    </a>
                    <button type="submit" class="px-5 py-2.5 bg-cyan-600 hover:bg-cyan-500 text-white rounded-lg font-semibold transition shadow-[0_0_15px_rgba(6,182,212,0.5)]">
                        {{ __('Atualizar Matrícula') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>