<script>
    window.traducao = {{ Illuminate\Support\Js::from([
        'excluirPessoa' => __('Tem certeza que deseja excluir esta pessoa?'),
    ]) }};
</script>
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-white">
                {{ __('Gerenciar Pessoas') }}
            </h2>
            <a href="{{ route('aulas.create') }}" class="button button-primary">
                {{ __('+ Adicionar Pessoa') }}
            </a>
        </div>
    </x-slot>

    <div class="py-4 sm:px-2">
        <div class="mx-auto max-w-7xl">
            {{-- Mensagem de Sucesso --}}
            @if (session('success'))
                <div class="mb-4 alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($aulas->isEmpty())
                    <p class="py-10 text-center text-zinc-400">{{ __('Nenhuma Pessoa cadastrada até o momento.') }}</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">{{ __('Nome') }}</th>
                                    <th scope="col" class="px-6 py-3">{{ __('Email') }}</th>
                                    <th scope="col" class="px-6 py-3">{{ __('Aula Cadastrada') }}</th>
                                    <th scope="col" class="px-6 py-3 text-right">{{ __('Ações') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($aulas as $aula)
                                    <tr class="bg-white border-b bg-zinc-800/60 border-zinc-800 hover:bg-zinc-800/40">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ $aula->nome }}
                                        </td>
                                        <td class="px-6 py-4">{{ $aula->instrutor_id }}</td>
                                        <td class="px-6 py-4">{{ $aula->horario }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-3 justify-items-center">
                                            <a href="{{ route('aulas.edit', $aula) }}" class="text-indigo-400 transition hover:text-indigo-300">
                                                <x-lucide-pencil class="w-5 h-5" />
                                            </a>
                                            <form action="{{ route('aulas.destroy', $aula) }}" method="POST" onsubmit="return confirm(window.traducao.excluirPessoa);" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 transition-colors">
                                                    <x-lucide-trash-2 class="w-5 h-5" />
                                                </button>
                                            </form>
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>