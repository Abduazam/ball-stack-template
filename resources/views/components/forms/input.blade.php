@props(['label', 'name'])

@php
    $defaults = [
        'type' => 'text',
        'id' => $name,
        'name' => $name,
        'class' => 'form-control',
        'value' => old($name)
    ];
@endphp

<x-forms.field :$label :$name>
    @if($attributes->get('type') && $attributes->get('type') === 'file')
        <x-forms.inputs.file {{ $attributes->merge($defaults) }} />
    @else
        <input {{ $attributes($defaults) }}>
    @endif
</x-forms.field>
