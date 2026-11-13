<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cadastrar Nova Pessoa') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto w-full max-w-3xl rounded-xl border border-zinc-800 bg-zinc-900 p-5 shadow-sm sm:p-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('aulas.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="flex mt-4 justify-end">
                        <label for="eh_instrutor" class="inline-flex items-center">
                            <input id="eh_instrutor" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="eh_instrutor">
                            <span class="ms-2 text-sm text-zinc-400">{{ __('É instrutor?') }}</span>
                        </label>
                    </div>

                    <!-- Nome da Pessoa -->
                    <div>
                        <x-input-label for="nome" :value="__('Nome da Pessoa')" />
                        <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full" :value="old('nome')"  autofocus />
                        <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="instrutor_id" :value="__('Email')" />
                        <x-text-input id="instrutor_id" name="instrutor_id" type="text" class="mt-1 block w-full" :value="old('instrutor_id')"  />
                        <x-input-error :messages="$errors->get('instrutor_id')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Aula Cadastrada -->
                        <div>
                            <x-input-label for="horario" :value="__('Aula Cadastrada')" />
                            <x-text-input id="horario" name="horario" type="text" class="mt-1 block w-full" :value="old('horario')"  />
                            <x-input-error :messages="$errors->get('horario')" class="mt-2" />
                        </div>

                    <!-- Descrição -->
                    <div>
                        <x-input-label for="descricao" :value="__('Descrição (Opcional)')" />
                        <textarea id="descricao" name="descricao" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('descricao') }}</textarea>
                        <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
                    </div>

                    <!-- Botões -->
                    <div class="flex items-center justify-end gap-4 border-t border-zinc-800 pt-5">
                        <a href="{{ route('aulas.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline">
                            {{ __('Cancelar') }}
                        </a>
                        <x-primary-button>
                            {{ __('Registrar Pessoa') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>