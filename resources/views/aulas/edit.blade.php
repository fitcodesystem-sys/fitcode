<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Aula') }}: {{ $aula->nome }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('aulas.update', $aula) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nome da Aula -->
                    <div>
                        <x-input-label for="nome" :value="__('Nome da Aula')" />
                        <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full" :value="old('nome', $aula->nome)" required autofocus />
                        <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                    </div>

                    <!-- Instrutor -->
                    <div>
                        <x-input-label for="instrutor" :value="__('Instrutor')" />
                        <x-text-input id="instrutor" name="instrutor" type="text" class="mt-1 block w-full" :value="old('instrutor', $aula->instrutor)" required />
                        <x-input-error :messages="$errors->get('instrutor')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Horário -->
                        <div>
                            <x-input-label for="horario" :value="__('Horário (ex: Seg/Qua 19:00)')" />
                            <x-text-input id="horario" name="horario" type="text" class="mt-1 block w-full" :value="old('horario', $aula->horario)" required />
                            <x-input-error :messages="$errors->get('horario')" class="mt-2" />
                        </div>

                        <!-- Capacidade Máxima -->
                        <div>
                            <x-input-label for="capacidade_maxima" :value="__('Capacidade Máxima')" />
                            <x-text-input id="capacidade_maxima" name="capacidade_maxima" type="number" class="mt-1 block w-full" min="1" :value="old('capacidade_maxima', $aula->capacidade_maxima)" required />
                            <x-input-error :messages="$errors->get('capacidade_maxima')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Descrição -->
                    <div>
                        <x-input-label for="descricao" :value="__('Descrição (Opcional)')" />
                        <textarea id="descricao" name="descricao" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('descricao', $aula->descricao) }}</textarea>
                        <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
                    </div>

                    <!-- Botões -->
                    <div class="flex items-center justify-end space-x-4">
                        <a href="{{ route('aulas.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline">
                            Cancelar
                        </a>
                        <x-primary-button>
                            {{ __('Atualizar Aula') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>