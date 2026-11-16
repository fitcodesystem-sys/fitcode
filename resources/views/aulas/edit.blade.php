<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-100 leading-tight">
            {{ __('Editar Aula') }}: {{ $aula->nome }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto w-full max-w-4xl rounded-2xl border border-zinc-800 bg-zinc-900 p-6 sm:p-8 shadow-2xl">
            
            <form action="{{ route('aulas.update', $aula) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Nome da Aula --}}
                    <div class="md:col-span-2">
                        <x-input-label for="nome" :value="__('Nome da Aula')" class="text-zinc-300" />
                        <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full bg-zinc-800 border-zinc-700 text-zinc-100 focus:border-cyan-500 focus:ring-cyan-500" :value="old('nome', $aula->nome)" required autofocus />
                        <x-input-error :messages="$errors->get('nome')" class="mt-2 text-red-400" />
                    </div>

                    {{-- Instrutor --}}
                    <div class="md:col-span-2">
                        <x-input-label for="instrutor_id" :value="__('Instrutor')" class="text-zinc-300" />
                        <select id="instrutor_id" name="instrutor_id" class="mt-1 block w-full rounded-md bg-zinc-800 border-zinc-700 text-zinc-100 shadow-sm focus:border-cyan-500 focus:ring-cyan-500" required>
                            <option value="">{{ __('Selecione um instrutor...') }}</option>
                            @foreach ($instrutores as $instrutor)
                                <option value="{{ $instrutor->id }}" {{ old('instrutor_id', $aula->instrutor_id) == $instrutor->id ? 'selected' : '' }}>
                                    {{ $instrutor->nome }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('instrutor_id')" class="mt-2 text-red-400" />
                    </div>

                    {{-- Horário --}}
                    <div>
                        <x-input-label for="horario" :value="__('Horário (ex: Seg/Qua 19:00)')" class="text-zinc-300" />
                        <x-text-input id="horario" name="horario" type="text" class="mt-1 block w-full bg-zinc-800 border-zinc-700 text-zinc-100 focus:border-cyan-500 focus:ring-cyan-500" :value="old('horario', $aula->horario)" required />
                        <x-input-error :messages="$errors->get('horario')" class="mt-2 text-red-400" />
                    </div>

                    {{-- Capacidade Máxima --}}
                    <div>
                        <x-input-label for="capacidade_maxima" :value="__('Capacidade Máxima')" class="text-zinc-300" />
                        <x-text-input id="capacidade_maxima" name="capacidade_maxima" type="number" class="mt-1 block w-full bg-zinc-800 border-zinc-700 text-zinc-100 focus:border-cyan-500 focus:ring-cyan-500" min="1" :value="old('capacidade_maxima', $aula->capacidade_maxima)" required />
                        <x-input-error :messages="$errors->get('capacidade_maxima')" class="mt-2 text-red-400" />
                    </div>

                    {{-- Descrição --}}
                    <div class="md:col-span-2">
                        <x-input-label for="descricao" :value="__('Descrição (Opcional)')" class="text-zinc-300" />
                        <textarea id="descricao" name="descricao" rows="3" class="mt-1 block w-full rounded-md bg-zinc-800 border-zinc-700 text-zinc-100 shadow-sm focus:border-cyan-500 focus:ring-cyan-500">{{ old('descricao', $aula->descricao) }}</textarea>
                        <x-input-error :messages="$errors->get('descricao')" class="mt-2 text-red-400" />
                    </div>

                </div>

                {{-- Botões de Ação --}}
                <div class="flex items-center justify-end gap-4 border-t border-zinc-800 pt-6">
                    <a href="{{ route('aulas.index') }}" class="text-sm text-zinc-400 hover:text-zinc-100 underline transition">
                        {{ __('Cancelar') }}
                    </a>
                    <button type="submit" class="px-5 py-2.5 bg-cyan-600 hover:bg-cyan-500 text-white rounded-lg font-semibold transition shadow-[0_0_15px_rgba(6,182,212,0.5)]">
                        {{ __('Atualizar Aula') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>