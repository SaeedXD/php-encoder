<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PHP Encoder</title>
        <link rel="stylesheet" href="/assets/fonts/autoLoad.php">

        {{-- @vite('resources/css/app.css') --}}
        {{-- @vite('resources/js/app.js') --}}

        <link rel="stylesheet" href="/build/assets/app.d12883f2.css">
        <script src='/assets/scripts/awesome.min.js' crossorigin='anonymous'></script>
    </head>
    <body >
        <div id="app" class="w-screen h-screen overflow-y-auto flex items-center flex-col gap-7 py-7 text-white/90">
            <App />
        </div>
        <script src='/build/assets/app.2f96d1a9.js'></script>
    </body>
</html>