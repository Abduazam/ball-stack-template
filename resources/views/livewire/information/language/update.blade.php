@php
    $target = 'modal-update-language-id' . $this->language->id;
@endphp

<x-actions.modal-block>
    <x-forms.buttons.open-modal class="btn-primary" :target="$target">
        <x-actions.icons.update />
    </x-forms.buttons.open-modal>

    <x-forms.modal action="update" :target="$target">
        <x-forms.modals.header :title="trans('fields.columns.language.language')" />

        <x-forms.modals.body>
            <div class="row">
                <x-forms.input class="form-control-sm" label="{{ trans('fields.columns.language.slug') }}" name="form.slug" value="{{ $this->language->slug }}" disabled />

                <x-forms.input wire:model.blur="form.title" class="form-control-sm" label="{{ trans('fields.columns.language.title') }}" name="form.title" />
            </div>
        </x-forms.modals.body>

        <x-forms.modals.footer>
            <x-forms.buttons.submit class="btn-sm btn-alt-primary">{{ trans('fields.buttons.update') }}</x-forms.buttons.submit>
        </x-forms.modals.footer>
    </x-forms.modal>
</x-actions.modal-block>
