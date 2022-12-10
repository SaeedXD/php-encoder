<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PHP Encoder</title>
        <link rel="stylesheet" href="/assets/fonts/autoLoad.php">
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        <script src='/assets/scripts/awesome.min.js' crossorigin='anonymous'></script>
    </head>
    <body id="app" class="flex items-center flex-col gap-7 py-7 text-white/90">
        <downloadPage linkdata='@json($data)' />
    </body>
</html>