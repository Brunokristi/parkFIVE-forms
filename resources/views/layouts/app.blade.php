<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'parkFIVE') — Online check-in</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-slate-800 antialiased">
    <div class="min-h-screen flex flex-col">
        <header class="items-center flex justify-center ">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 py-2 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('logo.svg') }}" alt="parkFIVE logo" class="h-10 ">
                    <span class="font-lato text-park-gray">parkFIVE</span>
                </div>
            </div>
        </header>

        <main class="flex-1">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 py-8 sm:py-12">
                @yield('content')
            </div>
        </main>

        <footer class="bg-park-green">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 py-6 text-center text-sm text-white">
                &copy; {{ date('Y') }} parkFIVE — Online self check-in
            </div>
        </footer>
    </div>

    @yield('scripts')
</body>
</html>