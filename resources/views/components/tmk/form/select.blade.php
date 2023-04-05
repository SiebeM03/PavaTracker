@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}>
    {{ $slot }}
</select>
{{-- copied from /resources/views/vendor/jetstream/components/input.blade.php, changed <input> to <select> and added $slot --}}
