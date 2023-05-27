<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kumpels - @yield('title')</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        {{-- datatables --}}
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/mobius1/vanilla-Datatables@latest/vanilla-dataTables.min.css">
        <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/mobius1/vanilla-Datatables@latest/vanilla-dataTables.min.js"></script>
        {{-- bootstrap icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
        <link rel="stylesheet" href="{{ asset('css/layouts/header.css')}}">
        <link rel="stylesheet" href="{{ asset('css/shared.css')}}">
        {{-- add custom styles --}}
        @yield('styles')

    </head>
    <body>
        {{-- partial header --}}
        @include('layouts.partials.header')
        <main>
            @yield('content')
        </main>
        <script>
            var datat=document.querySelector("#datat"); 
            var dataTable=new DataTable("#datat",{ 
            perPage:20,
            labels: {
                placeholder: "Busca por un campo...",
                perPage: "{select} registros por página",
                noRows: "No se encontraron registros",
                info: "Mostrando {start} a {end} de {rows} registros",
            }
            } ) ;
        </script>
    </body>

  
</html>
