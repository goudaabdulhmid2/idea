@props(['name', 'label', 'type' => 'text', 'value' => ''])

<div class="space-y-1.5">
    <label for="{{ $name }}" class="label">{{ $label }}</label>
    <input 
        id="{{ $name }}" 
        type="{{ $type }}" 
        name="{{ $name }}" 
        value="{{ $value }}" 
        {{ $attributes->merge(['class' => 'input']) }}
    >
    @error($name)
        <p class="error mt-1">{{ $message }}</p>
    @enderror
</div>
