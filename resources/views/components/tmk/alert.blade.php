@props([
    'type' => 'success',
    'dismissible' => true,
    'closeSelf' => 0
])

@php
    $dismissible = filter_var($dismissible, FILTER_VALIDATE_BOOLEAN); // Converts $dismissible into a boolean value
    $options = [
        'success' => 'text-emerald-900 bg-emerald-100 border-emerald-300',
        'danger' => 'text-red-900 bg-red-100 border-red-300',
        'info' => 'text-sky-900 bg-sky-100 border-sky-300',
        'warning' => 'text-orange-900 bg-orange-100 border-orange-300'
    ];
    $style = $options[$type] ?? $options['success']
@endphp

<div
    {{-- make it LiveWire compatible --}}
    wire:key="{{ rand() }}"
    {{ $attributes->merge(['class' => "$style flex gap-4 p-4 my-4 rounded border"]) }}
    {{-- declare a new Alpine component with a default property open set to true --}}
    x-data="{open: true}"
    {{-- defines if the Alpine component is visible or hidden, visible if open=true, hidden if open=false --}}
    x-show="open"
    {{-- transitions the Alpine component in and out using CSS transitions with a duration of 300ms --}}
    x-transition.duration.300ms

    {{-- closeSelf functionality --}}
    @if($closeSelf > 0)
        {{-- initializes a setTimeout function that will close the alert after closeSelf milliseconds --}}
        x-init="setTimeout(() => open = false, {{ $closeSelf }})"
    @endif
>
    <div class="flex-1">
        {{ $slot  }}
    </div>
    @if($dismissible)
        {{-- @click (a shorthand for x-on:click) will set the open property to false and close the Alpine component--}}
        <div class="w-6 h-6 flex-none cursor-pointer {{ $style }}" @click="open = false">
            <x-heroicon-s-x-circle/>
        </div>
    @endif
</div>
