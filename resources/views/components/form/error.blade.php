@props(['name'])

@error($name)
    <p {{ $attributes->merge(['class' => 'error']) }}>{{ $message }}</p>
@enderror
