@props(['value'])

<label {{ $attributes->merge(['class' => ' block text-sm font-medium text-zinc-200']) }}>
    {{ $value ?? $slot }}
</label>
