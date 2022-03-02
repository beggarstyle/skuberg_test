<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="/css/app.css" rel="stylesheet">
    </head>

    <body class="antialiased">
      <div class="w-full h-full min-h-screen bg-slate-200">
        <x-Layouts.Header />

        <div class="w-full h-full min-h-screen flex flex-row">
            <!-- Aside -->
            <x-Layouts.Aside />

            <div class="w-full p-4">
                {{ $slot }}
            </div>
        </div>
      </div>
    </body>
</html>
