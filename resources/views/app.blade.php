<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Pb-Cle') }}</title>

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#8d3ec5">
        <meta name="msapplication-TileColor" content="#1f212a">
        <meta name="theme-color" content="#ffffff">

        <!-- Open Graph -->
        <meta property="og:url" content="https://pb-cle.org">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="Pb-Cle">
        <meta property="og:title" content="Pb-Cle">
        <meta property="og:description" content="Welcome to the new Pb-Cle.org electronic dance music site where you'll be able to post your music and photos and look up local events. More to come soon.">
        <meta property="og:image" content="https://pb-cle.org/site-thumbnail.png">

        <!-- Twitter Meta -->
        <meta name="twitter:card" content="summary_large_image">
        <meta property="twitter:domain" content="pb-cle.org">
        <meta property="twitter:url" content="https://pb-cle.org">
        <meta name ="twitter:title" content="Pb-Cle">
        <meta name="twitter:description" content="Welcome to the new Pb-Cle.org electronic dance music site where you'll be able to post your music and photos and look up local events. More to come soon.">
        <meta name="twitter:image" content="https://pb-cle.org/site-thumbnail.png">
        <meta data-rh="true" name="twitter:alt" content="Pb-Cle Preview">
        <meta data-rh="true" name="twitter:image:width" content="">
        <meta data-rh="true" name="twitter:image:height" content="">
        <meta name="twitter:site" content="">
        <meta name="twitter:creator" content="">
        <meta name="twitter:creator:id" content="">

        <!-- Fonts -->

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <!-- Stylesheets -->
        <?php $phpVersion = '?v=1.0.14'; ?>
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
