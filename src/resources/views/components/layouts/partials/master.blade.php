<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        {{-- <title>{{ $title ?? 'Alvion' }}</title> --}}
        <x-title/>
        <x-favicon/>
        <!-- Dynamic Theme CSS -->
        <x-style />
    </head>
    <body class="boxed-size">
        <x-preloader/>
        <x-sidebar/>
        <div class="container-fluid">
			<div class="main-content d-flex flex-column">
                <x-header/>
                {{ $slot }}
                <x-footer/>
            </div>
        </div>
        <x-themeSettings/>
        <!-- Dynamic Theme JS -->
        <x-js/>
    </body>
</html>
