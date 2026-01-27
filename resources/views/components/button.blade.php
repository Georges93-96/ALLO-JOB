@php
    $base = 'inline-flex items-center justify-center rounded-xl px-5 py-3 font-semibold transition focus:outline-none focus:ring-2 focus:ring-offset-2';

    $styles = match($type ?? 'primary') {
        'secondary' => 'border bg-white text-gray-900 hover:bg-gray-50 focus:ring-gray-300',
        'ai' => 'bg-brand-orange text-white hover:opacity-90 focus:ring-brand-orange',
        default => 'bg-brand-green text-white hover:opacity-90 focus:ring-brand-green',
    };
@endphp

@if($attributes->has('href'))
    <a {{ $attributes->merge(['class' => "$base $styles"]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => "$base $styles"]) }}>
        {{ $slot }}
    </button>
@endif
