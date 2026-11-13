<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-100 leading-tight">
            {{ __('Nova Matrícula') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl">
                
                <form action="{{ route('matriculas.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Seleção de Aluno / Pessoa --}}
                    <div>
                        <label for="pessoa_id" class="block text-sm font-medium text-zinc-300 mb-2">{{ __('Aluno') }}</label>
                        <select name="pessoa_id" id="pessoa_id" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-4 py-2.5 text-zinc-100 focus:outline-none focus:border-cyan-500">
                            <option value="">{{ __('Selecione um aluno...') }}</option>
                            @foreach($alunos as $aluno)
                                <option value="{{ $aluno->id }}" {{ old('pessoa_id') == $aluno->id ? 'selected' : '' }}>
                                    {{ $aluno->name ?? $aluno->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('pessoa_id')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Plano --}}
                    <div>
                        <label for="plano_id" class="block text-sm font-medium text-zinc-300 mb-2">{{ __('Plano / Modalidade') }}</label>
                        <input type="text" name="plano_id" id="plano_id" value="{{ old('plano_id') }}" placeholder="Ex: Musculação Mensal" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-4 py-2.5 text-zinc-100 focus:outline-none focus:border-cyan-500">
                        @error('plano_id')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Datas --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="data_inicio" class="block text-sm font-medium text-zinc-300 mb-2">{{ __('Data de Início') }}</label>
                            <input type="date" name="data_inicio" id="data_inicio" value="{{ old('data_inicio') }}" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-4 py-2.5 text-zinc-100 focus:outline-none focus:border-cyan-500">
                            @error('data_inicio')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="data_fim" class="block text-sm font-medium text-zinc-300 mb-2">{{ __('Data de Término') }}</label>
                            <input type="date" name="data_fim" id="data_fim" value="{{ old('data_fim') }}" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-4 py-2.5 text-zinc-100 focus:outline-none focus:border-cyan-500">
                            @error('data_fim')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="status" class="block text-sm font-medium text-zinc-300 mb-2">{{ __('Status') }}</label>
                        <select name="status" id="status" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-4 py-2.5 text-zinc-100 focus:outline-none focus:border-cyan-500">
                            <option value="ativa" {{ old('status') == 'ativa' ? 'selected' : '' }}>{{ __('Ativa') }}</option>
                            <option value="vencida" {{ old('status') == 'vencida' ? 'selected' : '' }}>{{ __('Vencida') }}</option>
                        </select>
                        @error('status')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Botões de Ação --}}
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-800">
                        <a href="{{ route('matriculas.index') }}" class="px-5 py-2.5 bg-zinc-800 text-zinc-300 rounded-lg font-medium hover:bg-zinc-700 transition">
                            {{ __('Cancelar') }}
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-cyan-600 text-white rounded-lg font-semibold hover:bg-cyan-500 transition shadow-[0_0_15px_rgba(6,182,212,0.5)]">
                            {{ __('Salvar Matrícula') }}
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>