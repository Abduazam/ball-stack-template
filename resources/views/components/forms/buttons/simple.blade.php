@props([
    'small' => true
])

@php
    $class = 'btn ';
    if ($small) $class .= 'btn-sm';
@endphp

<button type="button" {{ $attributes->merge(['class' => $class]) }} data-bs-dismiss="modal">{{ $slot }}</button>
