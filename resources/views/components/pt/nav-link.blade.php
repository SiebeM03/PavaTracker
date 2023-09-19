@props([
    'active',
    'href' => '#',
    ])
@php
    $classes = ($active ?? false)
            ? 'list text-accent bg-main rounded-l-3xl relative border-y-2 border-l-2 border-accent'
            : 'list border-2 border-transparent';
    $b_classes = ($active ?? false)
            ? "block absolute bg-main right-0 w-5 h-5 before:content-[''] before:absolute before:bg-side before:top-0 before:left-0 before:w-full before:h-full before:border-r-2 before:border-accent"
            : "none";
    $a_classes = ($active ?? false)
            ? ''
            : 'hover:bg-accent hover:text-side hover:transition hover:duration-75';
@endphp
<li {{ $attributes->merge(['class' => $classes]) }}>
    <b class="{{ $b_classes }} -top-5 before:rounded-br-3xl before:border-b-2"></b>
    <b class="{{ $b_classes }} -bottom-5 before:rounded-tr-3xl before:border-t-2"></b>
    <a href="{{ $href }}" class="{{ $a_classes }} flex items-center pl-3 p-2 mr-5 group rounded-3xl transition-none">
        {{ $slot }}
    </a>
</li>