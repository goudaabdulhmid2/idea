<x-layout title="My Ideas">
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight">My Ideas</h1>
                <p class="text-muted-foreground">Manage and track your project ideas.</p>
            </div>
            <button class="btn">Create Idea</button>
        </div>

        <!-- Filter Tabs -->
        <div class="flex items-center gap-2 overflow-x-auto pb-2 border-b border-border/50">
            <a href="{{ route('ideas') }}"
                class="flex items-center gap-1.5 px-4 py-1.5 rounded-full text-sm font-medium transition-colors {{ !request('status') ? 'bg-primary text-primary-foreground' : 'bg-muted/50 text-muted-foreground hover:bg-muted' }}">
                All
                <span class="rounded-full px-2 py-0.5 text-xs {{ !request('status') ? 'bg-primary-foreground/20 text-primary-foreground' : 'bg-muted-foreground/20 text-muted-foreground' }}">
                    {{ $statusCounts['all'] ?? 0 }}
                </span>
            </a>
            @foreach(\App\Enums\IdeaStatus::cases() as $status)
                <a href="{{ route('ideas', ['status' => $status->value]) }}"
                    class="flex items-center gap-1.5 px-4 py-1.5 rounded-full text-sm font-medium transition-colors {{ request('status') === $status->value ? 'bg-primary text-primary-foreground' : 'bg-muted/50 text-muted-foreground hover:bg-muted' }}">
                    {{ $status->label() }}
                    <span class="rounded-full px-2 py-0.5 text-xs {{ request('status') === $status->value ? 'bg-primary-foreground/20 text-primary-foreground' : 'bg-muted-foreground/20 text-muted-foreground' }}">
                        {{ $statusCounts[$status->value] ?? 0 }}
                    </span>
                </a>
            @endforeach
        </div>

        @if($ideas->isEmpty())
            <div
                class="flex flex-col items-center justify-center rounded-xl border border-dashed border-border py-12 text-center bg-card/50">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                    class="text-muted-foreground/50 mb-4">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M12 8v4" />
                    <path d="M12 16h.01" />
                </svg>

                @if(request('status'))
                    <h3 class="text-lg font-semibold">No ideas found</h3>
                    <p class="mb-4 mt-2 text-sm text-muted-foreground">You don't have any ideas matching the
                        "{{ str_replace('_', ' ', request('status')) }}" status.</p>
                    <a href="{{ route('ideas') }}" class="btn btn-outlined">Clear Filter</a>
                @else
                    <h3 class="text-lg font-semibold">No ideas yet</h3>
                    <p class="mb-4 mt-2 text-sm text-muted-foreground">Get started by creating your first idea.</p>
                    <button class="btn">Create Idea</button>
                @endif
            </div>
        @else
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($ideas as $idea)
                    <x-idea.card :idea="$idea" />
                @endforeach
            </div>

            <!-- Pagination Links -->
            @if($ideas->hasPages())
                <div class="pt-6">
                    {{ $ideas->withQueryString()->links() }}
                </div>
            @endif
        @endif
    </div>
</x-layout>