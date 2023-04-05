@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}>{{$slot}}</textarea>
{{-- copied from /resources/views/vendor/jetstream/components/input.blade.php, changed <input> to <textarea> and added $slot --}}
{{-- IMPORTANT: place the code on one line, otherwise the component contains a return as a default value and, if you set a placeholder attribute, it will not be displayed! --}}
