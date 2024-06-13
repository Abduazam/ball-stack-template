@php
    $target = 'modal-create-language';
@endphp

<x-actions.modal-block>
    <x-forms.buttons.open-modal class="btn-primary" :target="$target">
        {{ trans('fields.actions.buttons.create', ['model' => trans('fields.columns.language.language')]) }}
    </x-forms.buttons.open-modal>

    <x-forms.modal action="create" :target="$target">
        <x-forms.modals.header :title="trans('fields.columns.language.language')" />

        <x-forms.modals.body>
            <div class="row">
                <x-forms.input wire:model.blur="form.slug" class="form-control-sm" label="{{ trans('fields.columns.language.slug') }}" name="form.slug" />

                <x-forms.input wire:model.blur="form.title" class="form-control-sm" label="{{ trans('fields.columns.language.title') }}" name="form.title" />
            </div>
        </x-forms.modals.body>

        <x-forms.modals.footer>
            <x-forms.buttons.submit class="btn-sm btn-alt-success">{{ trans('fields.buttons.create') }}</x-forms.buttons.submit>
        </x-forms.modals.footer>
    </x-forms.modal>
</x-actions.modal-block>
