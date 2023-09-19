@props([
    'name',
    'text',
])

@php
    $name = $name . '_open';
@endphp

<div class="ml-auto mr-5 flex justify-center" x-data="{ {{ $name }}: false }">
    <button class="btn-default sm:w-44 sm:h-9 font-medium rounded-full sm:rounded-lg text-sm p-2.5 sm:px-5 text-center mx-auto inline-flex items-center place-content-between"
            @click="{{ $name }} = !{{ $name }}" @click.outside="{{ $name }} = false"
            @keydown.escape="{{ $name }} = false">
        <span class="hidden sm:block whitespace-nowrap overflow-x-hidden text-ellipsis">{{ $text }}</span>
        <svg :class="{'-rotate-180': {{ $name }} }" class="w-3 h-3 sm:ml-2.5" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4"/>
        </svg>
    </button>
    
    <!-- Users dropdown menu -->
    <div  x-show="{{ $name}}" x-cloak {{ $attributes->merge(['class' => "absolute z-50 text-sm text-card-gray-200 bg-card-border border-2 border-card-title-border rounded-lg w-44 mt-10"]) }}>
        {{ $slot }}
    </div>
</div>