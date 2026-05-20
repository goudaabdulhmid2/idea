<x-layout title="My Ideas">
    <div class="space-y-6">
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan.</p>

            <x-card
                x-data
                @click="$dispatch('open-modal', 'create-idea')"
                is="button"
                type="button"
                data-test="create-idea-button"
                class="mt-10 cursor-pointer h-32 w-full text-left hover:border-primary/50 transition-colors"
            >
                <p class="text-muted-foreground font-medium">What's the idea?</p>
            </x-card>
        </header>

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

    <!-- Modal -->
    <x-modal name="create-idea" title="New idea">
        <form x-data="{ status: '{{ old('status', 'pending') }}' }" method="POST" action="{{ route('idea.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <x-form.field name="title" type="text" label="Title" :value="old('title')" required autofocus placeholder="What's your idea?" />

            <div class="space-y-1.5">
                <label for="description" class="label">Description <span class="text-muted-foreground font-normal">(Optional)</span></label>
                <textarea
                    id="description"
                    name="description"
                    class="textarea w-full resize-y"
                    placeholder="Add more details about your idea..."
                >{{ old('description') }}</textarea>
                <x-form.error name="description" />
            </div>

            <div class="space-y-2">
                <label for="status" class="label">Status</label>
                <div class="flex gap-x-3">
                    @foreach(\App\Enums\IdeaStatus::cases() as $status)
                        <button
                            type="button"
                            @click="status = @js($status->value)"
                            data-test="status-{{ $status->value }}-button"
                            class="btn flex-1 h-10"
                            :class="{'btn-outlined': status !== @js($status->value)}"
                        >
                            {{ $status->label() }}
                        </button>
                    @endforeach

                    <input type="hidden" name="status" :value="status" class="input">
                </div>
                <x-form.error name="status" />
            </div>

            {{-- <div class="space-y-1.5">
                <label for="image" class="label">Cover Image <span class="text-muted-foreground font-normal">(Optional)</span></label>
                <input id="image" type="file" name="image" accept="image/*" class="input w-full file:mr-3 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20 cursor-pointer pt-1.5 pb-1">
                <x-form.error name="image" />
            </div>

            <div class="space-y-1.5">
                <label for="links" class="label">Resources & Links <span class="text-muted-foreground font-normal">(Optional)</span></label>
                <textarea
                    id="links"
                    name="links"
                    class="textarea w-full resize-y text-sm h-24"
                    placeholder="https://example.com&#10;https://github.com/..."
                >{{ old('links') }}</textarea>
                <p class="text-xs text-muted-foreground mt-1">Enter one URL per line.</p>
                <x-form.error name="links" />
            </div> --}}

            <div class="flex items-center justify-end gap-3 pt-5 border-t border-border mt-2">
                <button type="button" @click="show = false" class="btn btn-ghost text-muted-foreground hover:text-foreground">
                    Cancel
                </button>
                <button type="submit" class="btn" data-test="create-idea-submit-button">
                    Create Idea
                </button>
            </div>
        </form>
    </x-modal>
</x-layout>
