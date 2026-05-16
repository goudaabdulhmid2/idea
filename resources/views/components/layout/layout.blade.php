<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>{{ $title ?? '' }} - Idea</title>
</head>

<body class="bg-background text-foreground">

    <x-layout.nav />

    @if (session('success'))
        <div id="flash-message" class="max-w-7xl mx-auto px-6 mt-6 transition-opacity duration-500">
            <div class="p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-600 dark:text-green-400 text-sm font-medium flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4 12 14.01l-3-3"/></svg>
                {{ session('success') }}
            </div>
        </div>
        <script>
            setTimeout(() => {
                const flashMessage = document.getElementById('flash-message');
                if (flashMessage) {
                    flashMessage.style.opacity = '0';
                    setTimeout(() => flashMessage.remove(), 500);
                }
            }, 3000);
        </script>
    @endif

    <main class="max-w-7xl mx-auto px-6 py-10">
        {{ $slot }}
    </main>
</body>

</html>