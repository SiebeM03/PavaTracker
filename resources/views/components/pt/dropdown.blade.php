@props([
    'name',
    'text',
    'width' => 44,
    'align' => 'bottom'
])

@php
    $name = $name . '_open';
    
    // TODO fix all cases but default
    switch ($align) {
        case 'left':
            $alignmentClasses = 'fixed origin-top-left left-0';
            break;
        case 'top':
            $alignmentClasses = 'fixed origin-top';
            break;
        case 'right':
            $alignmentClasses = 'fixed origin-top-right right-8 mt-1 top-14';
            break;
        default:
            $alignmentClasses = 'fixed origin-bottom mt-1 top-14';
            break;
    }
@endphp

<div class="ml-5 flex justify-center" x-data="{ {{ $name }}: false }">
    <button class="btn-default w-9 sm:w-{{ $width }} h-9 font-medium rounded-full sm:rounded-full text-sm overflow-hidden"
            @click="{{ $name }} = !{{ $name }}" @click.outside="{{ $name }} = false"
            @keydown.escape="{{ $name }} = false">
        {{ $text }}
    </button>
    
    <!-- Users dropdown menu -->
    <div
            x-show="{{ $name}}"
            x-cloak
            {{ $attributes->merge(['class' => "z-50 text-sm text-card-gray-200 bg-card-border border-2 border-card-title-border rounded-lg w-44 " .  $alignmentClasses ]) }}>
        {{ $slot }}
    </div>
</div>