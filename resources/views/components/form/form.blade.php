@props(['title' => '', 'description' => ''])

<div class="flex min-h-[calc(100vh-8rem)] items-center justify-center">
    <div class="w-full max-w-md p-8 bg-card rounded-2xl shadow-sm border border-border">
        @if ($title)
            <h1 class="text-2xl font-bold mb-2">{{ $title }}</h1>
        @endif
        
        @if ($description)
            <p class="text-muted-foreground mb-8 text-sm">{{ $description }}</p>
        @endif

        {{ $slot }}
    </div>
</div>
