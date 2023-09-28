<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Pb-Cle') }}</title>

        <!-- Fonts -->

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <!-- Stylesheets -->
        <?php $phpVersion = '?v=1.0.0'; ?>
        <link rel="stylesheet" href="{{ asset('/assets/css/themify-icons.css') }}<?php echo $phpVersion; ?>">
        <link rel="stylesheet" href="{{ asset('/assets/css/feather.css') }}<?php echo $phpVersion; ?>">
        <link rel="stylesheet" href="{{ asset('/assets/css/emoji.css') }}<?php echo $phpVersion; ?>">
        <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}<?php echo $phpVersion; ?>">
        <link rel="stylesheet" href="{{ asset('/assets/css/main.css') }}<?php echo $phpVersion; ?>">  

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
