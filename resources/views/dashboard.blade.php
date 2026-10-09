<x-app-layout>
    <x-slot name="header">
        <header class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <nav>
                <ul>
                    <li>
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-zinc-300 bg-zinc-800 hover:text-white hover:bg-zinc-700 focus:outline-none transition ease-in-out duration-150">
                                    <span>Ultimo Dia</span>
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <div>
                                <ul>
                                    <li class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Ultimo Dia</li>
                                    <li class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Ultima Semana</li>
                                    <li class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Ultimo Mês</li>
                                    <li class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Desde Sempre</li>
                                </ul>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </li>
                </ul>
            </nav>
        </header>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Você está logado!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-items-center justify-center gap-20 h-28 ">
            <div class="info-blocks">
                <span>Total Alunos</span>
                <span>150</span>
            </div>
            <div class="info-blocks">
                <span>Total Funcionarios</span>
                <span>30</span>
            </div>
            <div class="info-blocks">
                <span>Rendimento</span>
                <span>R$ 1500</span>
            </div>
            <div class="info-blocks">
                <span>Custos</span>
                <span>R$ 500</span>
            </div>
            <div class="info-blocks">
                <span>Per Valoração</span>
                <span>%100</span>
            </div>
        </div> 


    <!--
        <div class="grid grid-cols-5 auto-cols-max md:auto-cols-min justify-items-center h-20">
            <div class="block w-40 px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out shadow-sm sm:rounded-lg"><span>Total Alunos</span><span>150</span></div>
            <div class="block w-40 px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out shadow-sm sm:rounded-lg"><span>Total Funcionarios</span></div>
            <div class="block w-40 px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out shadow-sm sm:rounded-lg"><span>Rendimento</span></div>
            <div class="block w-40 px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out shadow-sm sm:rounded-lg"><span>Custos</span></div>
            <div class="block w-40 px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out shadow-sm sm:rounded-lg"><span>Per Evolução</span></div>
        </div> -->
</x-app-layout>
