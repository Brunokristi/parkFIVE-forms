@charset('utf-8')
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'parkFIVE') — Online check-in</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white border-b border-slate-200">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 py-5 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-slate-900 text-white font-semibold tracking-tight">p5</span>
                    <span class="text-lg font-semibold tracking-tight text-slate-900">parkFIVE</span>
                </div>
                <span class="text-sm text-slate-500">@yield('header-sub', 'Online check-in')</span>
            </div>
        </header>

        <main class="flex-1">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 py-8 sm:py-12">
                @yield('content')
            </div>
        </main>

        <footer class="border-t border-slate-200 bg-white">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 py-6 text-center text-sm text-slate-400">
                &copy; {{ date('Y') }} parkFIVE — Online self check-in
            </div>
        </footer>
    </div>

    @yield('scripts')
</body>
</html>