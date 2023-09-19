@props([
    'disabled' => false,
    'required' => false,
    'name',
    'id',
    'text',
    'placeholder' => '',
])

{{--TODO fix placeholder not hiding when not selected--}}
{{--TODO use slots instead of 1 component--}}

<div class="relative group z-0 w-full mt-0">
    <input {{ $disabled ? 'disabled' : '' }} {{ $required ? 'required' : '' }} {{ $attributes->get('wire:model') ? 'wire:model.defer=' . $attributes->get('wire:model'): '' }} name="{{ $name }}"
            id="{{ $id }}"
            {!! $attributes->merge(['class' => 'block py-2.5 px-0 w-full text-sm text-card-gray-200 bg-transparent border-0 border-b-2 border-card-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-accent peer']) !!}
            placeholder="{{ $placeholder }}"/>
    
    <label for="{{ $id }}"
            class="peer-focus:font-medium absolute text-sm text-card-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 z-10 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 peer-focus:text-accent">
        {{ $text }}
    </label>
</div>
