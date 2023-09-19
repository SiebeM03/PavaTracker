@props(['id' => null, 'maxWidth' => null])

@php
    $id = $id ?? md5($attributes->wire('model'));
    
    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ][$maxWidth ?? '2xl'];
@endphp

<div x-data="{ show: @entangle($attributes->wire('model')).defer }"
        x-on:close.stop="show = false"
        x-on:keydown.escape.window="show = false"
        x-show="show"
        id="{{ $id }}"
        class="jetstream-modal fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50 h-screen flex flex-nowrap items-center"
        style="display: none;">
    <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-main opacity-80"></div>
    </div>
    
    <div x-show="show"
            class="px-3 sm:px-6 mb-6 bg-card rounded-lg overflow-hidden border-2 border-card-border text-card-gray-200 transform transition-all w-full {{ $maxWidth }} sm:mx-auto"
            x-trap.inert.noscroll="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        
        <div class="pt-4 pb-2">
            <div class="text-lg text-card-title pb-2 mb-6 border-b-2 border-card-title-border flex justify-between">
                <p>{{ $title }}</p>
                <button type="button" class="w-8 h-8 relative right-0"
                        @click="show = false">
                    <x-phosphor-x/>
                </button>
            </div>
            
            <div class="space-y-6 sm:px-6">
                {{ $content }}
            </div>
        </div>
        
        <div class="flex flex-row py-4 mt-4 text-right border-t-2 border-card-title-border">
            {{ $footer }}
        </div>
    </div>
</div>

