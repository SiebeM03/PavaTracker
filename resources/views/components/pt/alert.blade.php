@props([
    'type' => 'success',
    'dismissible' => true,
    'closeSelf' => 0
])

@php
    $dismissible = filter_var($dismissible, FILTER_VALIDATE_BOOLEAN);
    $options = [
        'success' => 'text-alert-success-900 bg-alert-success-100 border-alert-success-300',
        'danger' => 'text-alert-danger-900 bg-alert-danger-100 border-alert-danger-300',
        'info' => 'text-alert-sky-900 bg-alert-sky-100 border-alert-sky-300',
        'warning' => 'text-alert-warning-900 bg-orange-100 border-alert-warning-300'
    ];
    $style = $options[$type] ?? $options['success']
@endphp

<div
        wire:key="{{ rand() }}"
        {{ $attributes->merge(['class' => "$style flex gap-4 p-4 my-4 rounded border"]) }}
        x-data="{open: true}"
        x-show="open"
        x-transition.duration.300ms
        @if($closeSelf > 0)
            x-init="setTimeout(() => open = false, {{ $closeSelf }})"
        @endif
>
    <div class="flex-1">
        {{ $slot  }}
    </div>
    @if($dismissible)
        <div class="w-6 h-6 flex-none cursor-pointer {{ $style }}" @click="open = false">
            <x-heroicon-s-x-circle/>
        </div>
    @endif
</div>
