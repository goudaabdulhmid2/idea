@props(['status'])

@php
    $colorClass = match ($status) {
        \App\Enums\IdeaStatus::PENDING => 'bg-yellow-500/10 text-yellow-600 dark:text-yellow-400 border-yellow-500/20',
        \App\Enums\IdeaStatus::IN_PROGRESS => 'bg-blue-500/10 text-blue-600 dark:text-blue-400 border-blue-500/20',
        \App\Enums\IdeaStatus::COMPLETED => 'bg-green-500/10 text-green-600 dark:text-green-400 border-green-500/20',
        default => 'bg-gray-500/10 text-gray-600 dark:text-gray-400 border-gray-500/20',
    };
@endphp

<span
    class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none {{ $colorClass }}">
    {{ $status->label() }}
</span>