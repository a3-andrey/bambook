<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-head>

    </x-head>
    <body class="nome">
    <x-dashboard.header/>
    {{ $slot }}

    <footer class="footer"></footer>	<!-- jQuery -->

    </body>
</html>

