@props(['label', 'name'])

@php
    $defaults = [
        'id' => $name,
        'name' => $name,
        'class' => 'rounded-xl bg-white/10 border border-white/10 px-5 py-4 w-full',
        'rows' => '6'
    ];
    
    $value = $attributes->get('value') ?? old($name);
    if ($value) {
        $defaults['value'] = $value;
    }
@endphp

<x-forms.field :$label :$name>
    <textarea {{ $attributes->merge($defaults) }}>{{ $value ?? '' }}</textarea>
</x-forms.field>
