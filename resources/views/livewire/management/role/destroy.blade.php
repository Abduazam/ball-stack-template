@php
    $target = 'modal-destroy-role-id' . $this->role->id;
@endphp

<x-actions.modal-block>
    <x-forms.buttons.open-modal class="btn-danger" :target="$target">
        <x-actions.icons.delete />
    </x-forms.buttons.open-modal>

    <x-forms.modal action="destroy" :target="$target">
        <x-pages.management.role.disabled-form />

        <x-forms.modals.footer>
            <x-forms.buttons.submit class="btn-sm btn-alt-danger">{{ trans('fields.buttons.destroy') }}</x-forms.buttons.submit>
        </x-forms.modals.footer>
    </x-forms.modal>
</x-actions.modal-block>
