<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Gerenciar Aulas') }}
            </h2>
            <a href="{{ route('aulas.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                + Nova Aula
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Mensagem de Sucesso --}}
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($aulas->isEmpty())
                    <p class="text-gray-500 dark:text-gray-400 text-center py-4">Nenhuma aula cadastrada até o momento.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nome</th>
                                    <th scope="col" class="px-6 py-3">Instrutor</th>
                                    <th scope="col" class="px-6 py-3">Horário</th>
                                    <th scope="col" class="px-6 py-3">Capacidade</th>
                                    <th scope="col" class="px-6 py-3 text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($aulas as $aula)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ $aula->nome }}
                                        </td>
                                        <td class="px-6 py-4">{{ $aula->instrutor_id }}</td>
                                        <td class="px-6 py-4">{{ $aula->horario }}</td>
                                        <td class="px-6 py-4">{{ $aula->capacidade_maxima }} alunos</td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end space-x-3">
                                            <a href="{{ route('aulas.edit', $aula) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline font-medium">
                                                <x-lucide-pencil class="w-5 h-5" />
                                            </a>
                                            <form action="{{ route('aulas.destroy', $aula) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta aula?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 transition-colors" title="Excluir Aula">
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