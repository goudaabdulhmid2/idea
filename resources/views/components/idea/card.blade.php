@props(['idea'])

<div class="group relative flex flex-col gap-4 rounded-xl border border-border bg-card p-6 shadow-sm transition-all hover:shadow-md">
    <div class="flex items-start justify-between gap-4">
        <div class="space-y-1.5">
            <h3 class="font-semibold tracking-tight text-lg">{{ $idea->title }}</h3>
            <p class="text-sm text-muted-foreground line-clamp-2">{{ $idea->description ?: 'No description provided.' }}</p>
        </div>
        <x-idea.status-badge :status="$idea->status" />
    </div>

    <div class="mt-auto flex items-center justify-between pt-4 border-t border-border/50">
        <span class="text-xs text-muted-foreground">
            {{ $idea->created_at ? 'Created ' . $idea->created_at->diffForHumans() : 'Unknown creation date' }}
        </span>
        <a href="{{ route('idea.show', $idea->id) }}" class="text-sm font-medium text-primary hover:underline underline-offset-4">
            View Details &rarr;
        </a>
    </div>
</div>
