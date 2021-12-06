<img
    @if(isset($attributes))
    {{ $attributes->merge(['class' => "w-auto h-14"]) }}
    @endif
    src="{{ $siteConfiguration->logoUrl }}"
    title="{{ $siteConfiguration->name }}"
    alt="{{ $siteConfiguration->name }}"
/>
