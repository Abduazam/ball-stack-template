@props([
    'action' => null,
    'target' => null,
    'size' => null,
])

<div wire:ignore.self class="modal fade" id="{{ $target }}" tabindex="-1" role="dialog" aria-labelledby="{{ $target }}" aria-hidden="true">
    <div class="modal-dialog {{ $size }} modal-dialog-centered" role="document">
        <div class="modal-content fs-sm text-start">
            <x-forms.form action="{{ $action }}" class="form-border-radius">
                <div class="block block-rounded shadow-none mb-0">
                    {{ $slot }}
                </div>
            </x-forms.form>
        </div>
    </div>
</div>
