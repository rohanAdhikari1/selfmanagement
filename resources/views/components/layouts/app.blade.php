<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Self Managent System' }}</title>
    <tallstackui:script />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    {{ $slot }}
    <x-ts-dialog />
</body>
@php
    $token = request()->bearerToken();
@endphp
<script>
    document.addEventListener('livewire:init', () => {
        const token = "{{ $token }}";
        if (window.FlutterChannel) {
            Livewire.hook('request', ({
                options
            }) => {
                options.headers['Authorization'] = `Bearer ${token}`;
            });
        }
    });
</script>

</html>
