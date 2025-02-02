<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Alvion' }}</title>
        <!-- Dynamic Theme CSS -->
        <x-style />
    </head>
    <body class="boxed-size bg-white">
        <x-preloader/>
        <div class="container">
			<div class="main-content d-flex flex-column p-0">
                {{ $slot }}
                <x-footer/>
            </div>
        </div>
        <x-themeSettings/>
        <!-- Dynamic Theme JS -->
        <x-js/>
    </body>
</html>
