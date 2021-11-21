<div
    {{ $attributes->merge([
        'class' => "mt-2 border-l-4 p-4 mb-2 " . $attributes->get('colourClass')
    ]) }}
    role="alert"
>
    <p class="font-bold">{{ $attributes->get('title') }}</p>
    {{ $slot }}
</div>
