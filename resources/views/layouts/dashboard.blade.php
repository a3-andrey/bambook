<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-head>

    </x-head>
    <x-style/>
    <body>
    <x-dashboard.sidebar/>

     {{ $slot }}

    <x-footer>

    </x-footer>
    </body>
</html>
