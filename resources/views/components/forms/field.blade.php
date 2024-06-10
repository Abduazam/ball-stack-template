@props(['label', 'name'])

<div class="mb-4">
    @if ($label)
        <x-forms.label :$name :$label />
    @endif

    {{ $slot }}

    <x-forms.errors.input-message :error="$name" />
</div>
