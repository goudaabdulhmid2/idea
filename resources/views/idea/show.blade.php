<x-layout title="{{ $idea->title }}">
    <div class="space-y-6 max-w-4xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div class="space-y-1">
                <div class="flex items-center gap-3">
                    <h1 class="text-3xl font-bold tracking-tight">{{ $idea->title }}</h1>
                    <x-idea.status-badge :status="$idea->status" />
                </div>
                <p class="text-sm text-muted-foreground">
                    @if($idea->created_at)
                        Created {{ $idea->created_at->format('M j, Y \a\t g:i A') }} 
                        ({{ $idea->created_at->diffForHumans() }})
                    @else
                        Unknown creation date
                    @endif
                </p>
            </div>
            <a href="{{ route('ideas') }}" class="btn btn-outlined flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                Back to Ideas
            </a>
        </div>

        <!-- Content -->
        <div class="rounded-xl border border-border bg-card shadow-sm overflow-hidden">
            @if($idea->image_path)
                <div class="w-full h-64 bg-muted/50 border-b border-border">
                    <img src="{{ asset($idea->image_path) }}" alt="{{ $idea->title }}" class="w-full h-full object-cover" />
                </div>
            @endif

            <div class="p-6 space-y-6">
                <!-- Description -->
                <div>
                    <h3 class="text-lg font-semibold mb-2">Description</h3>
                    <div class="prose prose-sm dark:prose-invert max-w-none text-muted-foreground leading-relaxed">
                        {!! nl2br(e($idea->description ?: 'No description provided.')) !!}
                    </div>
                </div>

                <!-- Links -->
                @if($idea->links && count($idea->links) > 0)
                    <div class="pt-6 border-t border-border/50">
                        <h3 class="text-lg font-semibold mb-3">Resources & Links</h3>
                        <ul class="space-y-2">
                            @foreach($idea->links as $link)
                                <li>
                                    <a href="{{ $link }}" target="_blank" rel="noopener noreferrer" class="text-primary hover:underline flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                                        {{ $link }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
