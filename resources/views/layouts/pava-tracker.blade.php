<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description ?? 'Welcome to Pava Tracker' }}">
    <title>Pava Tracker: {{ $title ?? '' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-main">
<!-- Sidebar -->
<x-layout.sidebar/>

<!-- Right/main side of screen -->
<div class="sm:ml-64 sm:max-h-screen flex flex-col">
    <!-- Navbar -->
    @livewire('layout.header')
    
    <!-- Main content -->
    <main class="mt-6 mx-8 mb-8 flex flex-col flex-grow overflow-hidden">
        {{ $slot }}
    </main>
</div>

@stack('script')
@livewireScripts
</body>

</html>
