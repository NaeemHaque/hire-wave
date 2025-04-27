@php
    $classes = 'p-4 bg-white/5 rounded-xl flex border border-transparent hover:border-blue-800 transition-colors duration-300 cursor-pointer'
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
