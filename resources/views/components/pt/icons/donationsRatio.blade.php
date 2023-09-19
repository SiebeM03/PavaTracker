@props([
    'size' => 10,
    'positive'
])

@php
    $positive = filter_var($positive, FILTER_VALIDATE_BOOLEAN);
    $color = ($positive)
        ? 'text-alert-success-400'
        : 'text-alert-danger-400';
    $path = ($positive)
        ? 'm7 10 2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'
        : 'M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z';
@endphp

<svg {!! $attributes->merge(['class' => "w-$size h-$size $color"]) !!} aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg"
        fill="none" viewBox="0 0 20 20">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2" d="{{ $path }}"/>
</svg>
