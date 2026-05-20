<x-layout title="{{ $idea->title }}">
    <div class="max-w-6xl mx-auto space-y-8">
        
        <!-- Breadcrumbs / Top Actions -->
        <div class="flex items-center justify-between">
            <a href="{{ route('ideas') }}" class="inline-flex items-center gap-2 text-sm font-medium text-muted-foreground hover:text-foreground transition-colors group">
                <span class="p-1.5 rounded-full bg-muted/50 group-hover:bg-muted transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                </span>
                Back to Ideas
            </a>
            @if(Auth::id() === $idea->user_id)
                <div class="flex items-center gap-2">
                    <a href="{{ route('idea.edit', $idea) }}" class="btn btn-ghost text-muted-foreground hover:text-foreground">
                        Edit
                    </a>
                    <form method="POST" action="{{ route('idea.destroy', $idea) }}" onsubmit="return confirm('Are you sure you want to delete this idea? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-ghost text-red-500 hover:text-red-600 hover:bg-red-500/10">
                            Delete
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <!-- Glassmorphic Hero/Title Section -->
        <div class="relative overflow-hidden rounded-3xl border border-border/50 bg-card/30 backdrop-blur-xl p-8 sm:p-10 shadow-sm">
            <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent pointer-events-none"></div>
            
            <div class="relative z-10 space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                    <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-foreground leading-tight">{{ $idea->title }}</h1>
                    <div class="shrink-0 mt-2">
                        <x-idea.status-badge :status="$idea->status" />
                    </div>
                </div>
                
                <div class="flex items-center gap-6 text-sm text-muted-foreground">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                        @if($idea->created_at)
                            Created {{ $idea->created_at->format('M j, Y') }}
                        @else
                            Unknown Date
                        @endif
                    </div>
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        @if($idea->created_at)
                            {{ $idea->created_at->diffForHumans() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <!-- Left Column: Main Content -->
            <div class="lg:col-span-2 space-y-8">
                
                @if($idea->image_path)
                    <div class="rounded-3xl border border-border/50 overflow-hidden shadow-sm bg-muted/20">
                        <img src="{{ asset($idea->image_path) }}" alt="{{ $idea->title }}" class="w-full h-auto object-cover max-h-[500px]" />
                    </div>
                @endif

                <div class="rounded-3xl border border-border/50 bg-card p-6 sm:p-10 shadow-sm">
                    <h3 class="text-xl font-semibold mb-6 flex items-center gap-3">
                        <span class="p-2 rounded-xl bg-primary/10 text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                        </span>
                        Description
                    </h3>
                    <div class="prose prose-base dark:prose-invert max-w-none text-muted-foreground leading-relaxed">
                        {!! nl2br(e($idea->description ?: 'No description provided.')) !!}
                    </div>
                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="space-y-6 lg:sticky lg:top-8">
                
                <!-- Stats / Info Card -->
                <div class="rounded-3xl border border-border/50 bg-card p-6 shadow-sm flex flex-col gap-4">
                     <div class="flex justify-between items-center">
                         <span class="text-sm font-medium text-muted-foreground">Current Status</span>
                         <x-idea.status-badge :status="$idea->status" />
                     </div>
                     <div class="h-px w-full bg-border/50"></div>
                     <div class="flex justify-between items-center">
                         <span class="text-sm font-medium text-muted-foreground">Created At</span>
                         <span class="text-sm font-medium">{{ $idea->created_at ? $idea->created_at->format('M j, Y') : 'N/A' }}</span>
                     </div>
                </div>

                <!-- Resources Card -->
                <div class="rounded-3xl border border-border/50 bg-card p-6 shadow-sm">
                    <h3 class="text-lg font-semibold mb-5 flex items-center gap-3">
                        <span class="p-1.5 rounded-lg bg-primary/10 text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                        </span>
                        Resources
                    </h3>
                    
                    @if($idea->links && count($idea->links) > 0)
                        <div class="space-y-3">
                            @foreach($idea->links as $link)
                                <a href="{{ $link }}" target="_blank" rel="noopener noreferrer" 
                                   class="group flex items-center justify-between p-4 rounded-2xl border border-border/50 bg-muted/20 hover:bg-primary/5 hover:border-primary/30 transition-all">
                                    <span class="text-sm font-medium text-foreground truncate mr-4" title="{{ $link }}">
                                        {{ str_replace(['http://', 'https://'], '', $link) }}
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-muted-foreground group-hover:text-primary transition-colors shrink-0"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-sm text-muted-foreground text-center py-8 border border-dashed border-border/50 rounded-2xl bg-muted/10">
                            No resources linked yet.
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-layout>
