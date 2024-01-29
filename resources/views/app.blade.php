<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'TROLLDEV') }}</title>

    <meta name="description" content="Developer's entertainment hub.">
    <meta name="keywords" content="troll, developer, trolldev, hurmor, programmer, coder, engineer">

    <meta name="robots" content="index, follow" />
    <meta charset="utf-8">
    <meta name="environment" content="production">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://trolldev.com/" />
    <meta property="og:title" content="TROLLDEV" />
    <meta property="og:description" content="Developer's entertainment hub." />
    <meta property="og:site_name" content="TROLLDEV" />
    <meta name="twitter:site" content="TROLLDEV">
    <meta name="twitter:creator" content="trolldev">
    <meta name="twitter:title" content="TROLLDEV">
    <meta name="twitter:description" content="Developer's entertainment hub.">
    <meta name="twitter:card" content="Developer's entertainment hub.">
    <meta name="twitter:widgets:new-embed-design" content="on">

    <meta name="apple-mobile-web-app-title" content="TROLLDEV">
    <meta name="application-name" content="TROLLDEV">
    <meta property="fb:pages" content="https://fb.com/trolldev" />
    <meta name="theme-color" content="#eeeeee" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#222222" media="(prefers-color-scheme: dark)" />

    @if(isset($page['props']['post']))
    <meta property="og:image" content="{{ (isset($page['props']['post']['data']['file'])) ? URL::asset($page['props']['post']['data']['file']) : URL::asset('/apple-touch-icon.png') }}" />
    <meta property="twitter:image:src" content="{{ (isset($page['props']['post']['data']['file'])) ? URL::asset($page['props']['post']['data']['file']) : URL::asset('/apple-touch-icon.png') }}" />
    @else
    <meta property="og:image" content="{{ URL::asset('/apple-touch-icon.png') }}" />
    <meta name="twitter:image:src" content="{{ URL::asset('/apple-touch-icon.png') }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="manifest" href="{{ asset('site.webmanifest') }}" />

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>