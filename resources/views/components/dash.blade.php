<script>
    window.traducoes = {{ Illuminate\Support\Js::from([
        'alunosAtivos' => __('Alunos ativos'),
        'receita' => __('Receita no período'),
        'reMes' => __('Receita mensal'),
        'aulasRe' => __("Aulas realizadas"),
        'taxaP' => __("Taxa de presença"),
        'ulMes' => __("Último mês"),
        'hoje'=> __("Hoje"),
        'ulS' => __("Últimos 7 dias"),
        'ulA' => __("Último ano"),
        'mus' => __("Musculação"),
        "funcional" => __("Funcional"),
        'alunos' => __("Alunos")
    ]) }};
</script>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div x-data="dashboardLogic" class="flex min-h-screen flex-col bg-zinc-900">
            @include('layouts.navigation')

            @isset($header)
                <header class="border-b border-zinc-900 bg-zinc-950/80">
                    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="mx-auto flex w-full max-w-7xl flex-1 flex-col gap-6 p-4 md:p-6">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
