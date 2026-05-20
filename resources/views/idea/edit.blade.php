<x-layout title="Edit Idea: {{ $idea->title }}">
    <div class="max-w-2xl mx-auto py-8">
        <div class="mb-8">
            <a href="{{ route('idea.show', $idea) }}" class="inline-flex items-center gap-2 text-sm font-medium text-muted-foreground hover:text-foreground transition-colors group">
                <span class="p-1.5 rounded-full bg-muted/50 group-hover:bg-muted transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                </span>
                Back to Idea
            </a>
        </div>

        <x-form.form title="Edit Idea" description="Update the details and status of your idea.">
            <form method="POST" action="{{ route('idea.update', $idea) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <x-form.field name="title" type="text" label="Title" :value="old('title', $idea->title)" required autofocus />

                <div class="space-y-1.5">
                    <label for="description" class="label">Description</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        class="textarea w-full resize-y"
                    >{{ old('description', $idea->description) }}</textarea>
                    <x-form.error name="description" />
                </div>

                <div class="space-y-1.5">
                    <label for="status" class="label">Status</label>
                    <select id="status" name="status" class="input w-full">
                        @foreach(\App\Enums\IdeaStatus::cases() as $status)
                            <option value="{{ $status->value }}" @selected(old('status', $idea->status->value) === $status->value)>
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                    <x-form.error name="status" />
                </div>

                <div class="pt-4 flex items-center justify-end gap-3">
                    <a href="{{ route('idea.show', $idea) }}" class="btn btn-ghost text-muted-foreground hover:text-foreground">
                        Cancel
                    </a>
                    <button type="submit" class="btn">
                        Save Changes
                    </button>
                </div>
            </form>
        </x-form.form>
    </div>
</x-layout>
