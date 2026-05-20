@props(['is' => 'div'])

<{{ $is }} {{ $attributes->merge(['class' => 'rounded-xl border border-border bg-card text-card-foreground shadow-sm p-6']) }}>
    {{ $slot }}
</{{ $is }}>
