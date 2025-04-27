@props(['size' => 'base'])

@php
$classes = 'bg-white/10 hover:bg-white/25  rounded-xl  transition-colors duration-300 font-bold';

    if ($size === 'base') {
        $classes .= ' px-5 py-2 text-[12px]';
    };

    if ($size === 'small') {
        $classes .= ' px-3 py-1 text-[10px]';
    }

@endphp

<a href="#" class="{{ $classes }}">
    {{ $slot }}
</a>
