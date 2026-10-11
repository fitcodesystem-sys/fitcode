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
    <div class="text-white justify-items-start">
        <p>
            {{ __("Olá Administrador!") }}
        </p>
    </div>

    <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="info-blocks p-5 box-border">
                <span class="text-sm font-medium text-muted-foreground">Alunos ativos</span>
                <span class="mt-4 text-2xl font-bold tracking-tight text-foreground">150</span>
            </div>
            <div class="info-blocks p-5 box-border">
                <span>Total de funcionarios</span>
                <span class="mt-4 text-2xl font-bold tracking-tight text-foreground">30</span>
            </div>
            <div class="info-blocks p-5 box-border">
                <span>Receita</span>
                <span class="mt-4 text-2xl font-bold tracking-tight text-foreground">R$ 1500</span>
            </div>
            <div class="info-blocks p-5 box-border">
                <span>Custos</span>
                <span class="mt-4 text-2xl font-bold tracking-tight text-foreground">R$ 500</span>
            </div>
    </section>

    <section class="grid gap-6 xl:grid-cols-3 sm:grid-cols-1">
        <div x-data="mensalidadeChart" class="w-full xl:col-span-2">
            <div class="relative h-80 rounded-xl border border-gray-700 p-5 box-border">
                <canvas x-ref="canvas"></canvas>
            </div>
        </div>
        <div x-data="aulasChart" class="w-full">
            <div class="relative h-80 rounded-xl border border-gray-700 p-5 box-border">
                <canvas x-ref="canvas"></canvas>
            </div>
        </div>
    </section>

</x-app-layout>
