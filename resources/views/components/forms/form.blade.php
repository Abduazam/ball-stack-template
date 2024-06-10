@props(['action'])

<form wire:submit.prevent="{{ $action }}" method="POST" enctype="multipart/form-data" {{ $attributes }}>
    {{ $slot }}
</form>
