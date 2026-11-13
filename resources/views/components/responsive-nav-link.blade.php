@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav-link-mobile nav-link-mobile-active'
            : 'nav-link-mobile';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
