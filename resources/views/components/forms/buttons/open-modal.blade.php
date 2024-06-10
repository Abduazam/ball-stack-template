@props([
    'target' => null,
    'small' => true,
])

@php
    $class = 'btn ';
    if ($small) $class .= 'btn-sm';
@endphp

<button type="button" {{ $attributes->merge(['class' => $class]) }} data-bs-toggle="modal" data-bs-target="#{{ $target }}">
    {{ $slot }}
</button>
