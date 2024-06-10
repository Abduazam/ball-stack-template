@props(['livewire', 'props' => [], 'key' => null])

<div {{ $attributes->merge(['class' => "content"]) }}>
    @if($key)
        @livewire($livewire, $props, key($key))
    @else
        @livewire($livewire, $props)
    @endif
</div>
