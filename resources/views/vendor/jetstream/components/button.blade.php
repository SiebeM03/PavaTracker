<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-default inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
