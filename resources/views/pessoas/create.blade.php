<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-100 leading-tight">
            {{ __('Cadastrar Nova Pessoa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto w-full max-w-4xl rounded-2xl border border-zinc-800 bg-zinc-900 p-6 sm:p-8 shadow-2xl">
            
            <form action="{{ route('pessoas.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Checkbox Instrutor --}}
                <div class="flex justify-end">
                    <label for="eh_instrutor" class="inline-flex items-center cursor-pointer">
                        <input id="eh_instrutor" type="checkbox" value="1" {{ old('eh_instrutor') ? 'checked' : '' }} class="rounded border-zinc-700 bg-zinc-800 text-cyan-600 shadow-sm focus:ring-cyan-500" name="eh_instrutor">
                        <span class="ms-2 text-sm text-zinc-300 font-medium">{{ __('É instrutor?') }}</span>
                    </label>
                </div>

                <div class="border-t border-zinc-800 pt-6">
                    <h3 class="text-lg font-medium text-zinc-200 mb-4">{{ __('Informações Pessoais') }}</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nome --}}
                        <div class="md:col-span-2">
                            <x-input-label for="nome" :value="__('Nome Completo')" class="text-zinc-300" />
                            <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full bg-zinc-800 border-zinc-700 text-zinc-100 focus:border-cyan-500 focus:ring-cyan-500" :value="old('nome')" required autofocus />
                            <x-input-error :messages="$errors->get('nome')" class="mt-2 text-red-400" />
                        </div>

                        {{-- Email --}}
                        <div>
                            <x-input-label for="email" :value="__('E-mail')" class="text-zinc-300" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-zinc-800 border-zinc-700 text-zinc-100 focus:border-cyan-500 focus:ring-cyan-500" :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                        </div>

                        {{-- Profissão --}}
                        <div>
                            <x-input-label for="profissao" :value="__('Profissão')" class="text-zinc-300" />
                            <x-text-input id="profissao" name="profissao" type="text" class="mt-1 block w-full bg-zinc-800 border-zinc-700 text-zinc-100 focus:border-cyan-500 focus:ring-cyan-500" :value="old('profissao')" required />
                            <x-input-error :messages="$errors->get('profissao')" class="mt-2 text-red-400" />
                        </div>

                        {{-- CPF --}}
                        <div>
                            <x-input-label for="cpf" :value="__('CPF')" class="text-zinc-300" />
                            <x-text-input id="cpf" name="cpf" type="text" maxlength="11" placeholder="Somente números" class="mt-1 block w-full bg-zinc-800 border-zinc-700 text-zinc-100 focus:border-cyan-500 focus:ring-cyan-500" :value="old('cpf')" required />
                            <x-input-error :messages="$errors->get('cpf')" class="mt-2 text-red-400" />
                        </div>

                        {{-- RG --}}
                        <div>
                            <x-input-label for="rg" :value="__('RG')" class="text-zinc-300" />
                            <x-text-input id="rg" name="rg" type="text" maxlength="9" class="mt-1 block w-full bg-zinc-800 border-zinc-700 text-zinc-100 focus:border-cyan-500 focus:ring-cyan-500" :value="old('rg')" required />
                            <x-input-error :messages="$errors->get('rg')" class="mt-2 text-red-400" />
                        </div>

                        {{-- Gênero --}}
                        <div>
                            <x-input-label for="genero" :value="__('Gênero')" class="text-zinc-300" />
                            <select id="genero" name="genero" class="mt-1 block w-full rounded-md bg-zinc-800 border-zinc-700 text-zinc-100 shadow-sm focus:border-cyan-500 focus:ring-cyan-500">
                                <option value="">{{ __('Selecione...') }}</option>
                                <option value="masculino" {{ old('genero') == 'masculino' ? 'selected' : '' }}>{{ __('Masculino') }}</option>
                                <option value="feminino" {{ old('genero') == 'feminino' ? 'selected' : '' }}>{{ __('Feminino') }}</option>
                                <option value="outro" {{ old('genero') == 'outro' ? 'selected' : '' }}>{{ __('Outro') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('genero')" class="mt-2 text-red-400" />
                        </div>

                        {{-- Data de Nascimento --}}
                        <div>
                            <x-input-label for="nascimento" :value="__('Data de Nascimento')" class="text-zinc-300" />
                            <x-text-input id="nascimento" name="nascimento" type="date" class="mt-1 block w-full bg-zinc-800 border-zinc-700 text-zinc-100 focus:border-cyan-500 focus:ring-cyan-500" :value="old('nascimento')" required />
                            <x-input-error :messages="$errors->get('nascimento')" class="mt-2 text-red-400" />
                        </div>
                    </div>
                </div>

                {{-- Seção: Contato de Emergência e Saúde --}}
                <div class="border-t border-zinc-800 pt-6">
                    <h3 class="text-lg font-medium text-zinc-200 mb-4">{{ __('Emergência e Saúde') }}</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Contato de Emergência --}}
                        <div>
                            <x-input-label for="contato_emergencia" :value="__('Contato de Emergência')" class="text-zinc-300" />
                            <x-text-input id="contato_emergencia" name="contato_emergencia" type="text" class="mt-1 block w-full bg-zinc-800 border-zinc-700 text-zinc-100 focus:border-cyan-500 focus:ring-cyan-500" :value="old('contato_emergencia')" required />
                            <x-input-error :messages="$errors->get('contato_emergencia')" class="mt-2 text-red-400" />
                        </div>

                        {{-- Informações de Saúde --}}
                        <div>
                            <x-input-label for="saude" :value="__('Restrições / Observações de Saúde')" class="text-zinc-300" />
                            <x-text-input id="saude" name="saude" type="text" class="mt-1 block w-full bg-zinc-800 border-zinc-700 text-zinc-100 focus:border-cyan-500 focus:ring-cyan-500" :value="old('saude')" required />
                            <x-input-error :messages="$errors->get('saude')" class="mt-2 text-red-400" />
                        </div>
                    </div>
                </div>

                {{-- Seção: Responsável (Caso menor de idade) --}}
                <div class="border-t border-zinc-800 pt-6">
                    <h3 class="text-lg font-medium text-zinc-200 mb-4">{{ __('Dados do Responsável (Se aplicável)') }}</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="responsavel_nome" :value="__('Nome do Responsável')" class="text-zinc-300" />
                            <x-text-input id="responsavel_nome" name="responsavel_nome" type="text" class="mt-1 block w-full bg-zinc-800 border-zinc-700 text-zinc-100 focus:border-cyan-500 focus:ring-cyan-500" :value="old('responsavel_nome')" />
                            <x-input-error :messages="$errors->get('responsavel_nome')" class="mt-2 text-red-400" />
                        </div>

                        <div>
                            <x-input-label for="responsavel_parentesco" :value="__('Parentesco')" class="text-zinc-300" />
                            <x-text-input id="responsavel_parentesco" name="responsavel_parentesco" type="text" class="mt-1 block w-full bg-zinc-800 border-zinc-700 text-zinc-100 focus:border-cyan-500 focus:ring-cyan-500" :value="old('responsavel_parentesco')" />
                            <x-input-error :messages="$errors->get('responsavel_parentesco')" class="mt-2 text-red-400" />
                        </div>

                        <div>
                            <x-input-label for="responsavel_contato" :value="__('Contato do Responsável')" class="text-zinc-300" />
                            <x-text-input id="responsavel_contato" name="responsavel_contato" type="text" class="mt-1 block w-full bg-zinc-800 border-zinc-700 text-zinc-100 focus:border-cyan-500 focus:ring-cyan-500" :value="old('responsavel_contato')" />
                            <x-input-error :messages="$errors->get('responsavel_contato')" class="mt-2 text-red-400" />
                        </div>

                        <div>
                            <x-input-label for="responsavel_documento" :value="__('Documento (CPF) do Responsável')" class="text-zinc-300" />
                            <x-text-input id="responsavel_documento" name="responsavel_documento" type="text" maxlength="11" class="mt-1 block w-full bg-zinc-800 border-zinc-700 text-zinc-100 focus:border-cyan-500 focus:ring-cyan-500" :value="old('responsavel_documento')" />
                            <x-input-error :messages="$errors->get('responsavel_documento')" class="mt-2 text-red-400" />
                        </div>
                    </div>
                </div>

                {{-- Botões de Ação --}}
                <div class="flex items-center justify-end gap-4 border-t border-zinc-800 pt-6">
                    <a href="{{ route('pessoas.index') }}" class="text-sm text-zinc-400 hover:text-zinc-100 underline transition">
                        {{ __('Cancelar') }}
                    </a>
                    <button type="submit" class="px-5 py-2.5 bg-cyan-600 hover:bg-cyan-500 text-white rounded-lg font-semibold transition shadow-[0_0_15px_rgba(6,182,212,0.5)]">
                        {{ __('Registrar Pessoa') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>