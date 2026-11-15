<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cadastrar Nova Pessoa') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto w-full max-w-3xl rounded-xl border border-zinc-800 bg-zinc-900 p-5 shadow-sm sm:p-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('pessoas.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="flex mt-4 justify-end">
                        <label for="eh_instrutor" class="inline-flex items-center">
                            <input id="eh_instrutor" type="checkbox" value="1" class="rounded border-gray-300 text-rose-600 shadow-sm focus:ring-rose-500" name="eh_instrutor">
                            <span class="ms-2 text-sm text-zinc-400">{{ __('É instrutor?') }}</span>
                        </label>
                    </div>

                   
                    <div>
                        <x-input-label for="name" :value="__('Nome da Pessoa')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')"  autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" :value="old('email')"  />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        

                   

                   
                    <div class="flex items-center justify-end gap-4 border-t border-zinc-800 pt-5">
                        <a href="{{ route('pessoas.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline">
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