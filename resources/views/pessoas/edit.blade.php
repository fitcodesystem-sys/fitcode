<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Pessoa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($errors->any())
    <div class="text-red-500">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
                
                <form action="{{ route('pessoas.update', ['pessoa' => $pessoa->id]) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- checkbox instrutor -->
                    <div class="flex mt-4 justify-end">
                        <label for="eh_instrutor" class="inline-flex items-center">
                            <input id="eh_instrutor" type="checkbox" value = "1" class="rounded border-gray-300 text-rose-600 shadow-sm focus:ring-rose-500" name="eh_instrutor">
                            <span class="ms-2 text-sm text-zinc-400">{{ __('É instrutor?') }}</span>
                        </label>
                    </div>

                    <!-- Nome da Pessoa -->
                    <div>
                        <x-input-label for="name" :value="__('Nome da Pessoa')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('nome', $pessoa->name)"  autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" :value="old('email', $pessoa->email)"  />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                       

                

                    <!-- Botões -->
                    <div class="flex items-center justify-end space-x-4">
                        <a href="{{ route('pessoas.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline">
                            {{ __('Cancelar') }}
                        </a>
                        <x-primary-button>
                            {{ __('Atualizar Pessoa') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>