<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-head/>
<body class="nome">
    <x-header/>
    {{ $slot }}
    <x-footer/>
    <x-scripts/>
</body>
</html>

