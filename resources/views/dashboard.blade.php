<script>
    // serve para pegar os dados enviados do controller e jogar para variaveis que irão alimentar os gráficos
    window.dadosAulas = {
        labels:
        @json($aulas->pluck('nome')),
       
        dados:
        @json($aulas->pluck('users_count'))
    }
    window.translations = {
        students: @json(__('Alunos')),
        revenue: @json(__('Receita')),
        classes: @json(__('Aulas realizadas')),
        attendance: @json(__('Taxa de presença')),
    };
</script>
<x-dash>
    <x-slot name="header">
        <header class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <nav>
                <ul>
                    <li>
                        <x-dropdown align="right" width="48">
                            <x-slot  name="trigger">
                                <button class="button border border-zinc-700 bg-zinc-900 normal-case tracking-normal text-zinc-200 hover:bg-zinc-800 focus:ring-rose-500">
                                    <span x-text="period.label"></span>
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <!-- geração do selecionador de periodo -->
                                <template x-for="(period, key) in periods" :key="key">
                                    <button
                                        @click="selectedPeriod = key"
                                        :class="selectedPeriod === key"
                                        class="dropdown-item"
                                    >
                                        <span x-text="period.label"></span>
                                    </button>
                                </template>
                            </x-slot>
                        </x-dropdown>
                    </li>
                </ul>
            </nav>
        </header>
    </x-slot>
    <div class="text-zinc-200 font-medium justify-items-start">
        <p>
            {{ __("Olá Administrador!") }}
        </p>
    </div>

    <!-- geração dos cartões -->
    <!-- section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <template x-for="(metric, key) in metrics" :key="key">
            <div class="info-blocks p-5 box-border">
                <span x-text="metric.label"></span>
                <span x-text="metric.value" class="mt-4 text-2xl font-bold tracking-tight text-foreground"></span>
            </div>
        </template>
    </section -->

    {{-- Grid de Indicadores (5 Cards Lado a Lado) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-4">
    
        {{-- Total de Alunos --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl flex flex-col justify-between">
            <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">{{ __('Total de Alunos') }}</span>
            <p class="text-3xl font-extrabold text-white mt-4">{{ $totalAlunos }}</p>
        </div>

        {{-- Instrutores --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl flex flex-col justify-between">
            <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">{{ __('Instrutores') }}</span>
            <p class="text-3xl font-extrabold text-cyan-400 mt-4">{{ $totalInstrutores }}</p>
        </div>

        {{-- Receita Total --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl flex flex-col justify-between">
            <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">{{ __('Receita Total') }}</span>
            <p class="text-xl sm:text-2xl font-extrabold text-emerald-400 mt-4">R$ {{ number_format($totalReceitas, 2, ',', '.') }}</p>
        </div>

        {{-- Matrículas Ativas --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl flex flex-col justify-between">
            <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">{{ __('Matrículas Ativas') }}</span>
            <p class="text-3xl font-extrabold text-emerald-400 mt-4">{{ $matriculasAtivas }}</p>
        </div>

        {{-- Matrículas Vencidas --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl flex flex-col justify-between">
            <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">{{ __('Matrículas Vencidas') }}</span>
            <p class="text-3xl font-extrabold text-red-400 mt-4">{{ $matriculasVencidas }}</p>
        </div>

    </div>



    <!-- charts -->
        <div x-data="aulasChart" class="grid gap-6 xl:grid-cols-1 sm:grid-cols-1">
            <div class="relative h-80 rounded-xl border border-zinc-800 bg-zinc-900 p-5 shadow-sm">
                <canvas x-ref="canvas"></canvas>
            </div>
        </div>
    </section>

</x-dash>
