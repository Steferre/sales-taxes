<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Sales Taxes</title>

        <!-- Scripts -->
        <!-- @stack('head') -->
        <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
        @yield('scripts')

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        @yield('styles')
        <!-- Styles -->
        <!-- Styles -->
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
        <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
        <!-- <script>
            window.addEventListener('load', (event) => {
                console.log('pagina caricata');
                
                const category = document.getElementById('category');
                const imported = document.getElementById('imported');
                const description = document.getElementById('description');
                const btnAdd = document.getElementById('btnAdd');
                const sommario = document.getElementById('sommario');
                btnAdd.addEventListener('click', (event) => {
                    event.preventDefault();
                    console.log('valore input text');
                    console.log(description.value);
                    console.log('ho cliccato il pulsante');

                    sommario.innerHTML = description.value;
                });
            });
        </script> -->
    </head>
    <body class="antialiased">
        <main class="py-4">
            <div class="container">
                @yield('headers')

                @yield('filters')
                
                @yield('content')
            </div>
        </main>
    </body>
</html>

