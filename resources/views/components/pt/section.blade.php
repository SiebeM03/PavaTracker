<section {{ $attributes->merge(['class' => "border-2 border-card-border bg-card text-card-gray-200 rounded-lg overflow-auto"]) }} >
    @php
        echo isset($title) ?
        '<div class="text-lg text-card-title font-bold border-b-2 border-card-title-border text-center">' .
            $title .
        '</div>' : '';
    @endphp
    {{ $slot }}
</section>