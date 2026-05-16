<nav class="sticky top-0 z-50 w-full border-b border-border bg-background/80 px-6 backdrop-blur-md">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between">
        <div class="flex items-center gap-8">
            <a href="/" class="flex items-center gap-2 transition-transform hover:scale-105">
                <img src="{{ asset('images/modern-logo.png') }}" alt="IdeaApp Logo"
                    class="h-8 w-auto rounded object-contain">
                <span class="text-lg font-bold tracking-tight">IdeaApp</span>
            </a>

            <div class="hidden items-center gap-6 text-sm font-medium md:flex">
                <a href="/" class="text-muted-foreground transition-colors hover:text-foreground">Home</a>
                <a href="#" class="text-muted-foreground transition-colors hover:text-foreground">Discover</a>
            </div>
        </div>

        <div class="flex items-center gap-4">
            @auth
                <a href="#"
                    class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground">Dashboard</a>
                <button class="btn">New Idea</button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground">
                        Log out
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground">Log
                    in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn">Register</a>
                @endif
            @endauth
        </div>
    </div>
</nav>