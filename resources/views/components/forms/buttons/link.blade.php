@props([
    'route',
    'small' => true
])

@php
    $class = 'btn ';
    if ($small) $class .= 'btn-sm';
@endphp

<a href="{{ $route }}" {{ $attributes->merge(['class' => $class]) }}>{{ $slot }}</a>
