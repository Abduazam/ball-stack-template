@php
    $target = 'modal-restore-user-id' . $this->user->id;
@endphp

<x-actions.modal-block>
    <x-forms.buttons.open-modal class="btn-info" :target="$target">
        <x-actions.icons.restore />
    </x-forms.buttons.open-modal>

    <x-forms.modal action="restore" :target="$target">
        <x-management::pages.user.disabled-form />

        <x-forms.modals.footer>
            <x-forms.buttons.submit class="btn-sm btn-alt-info">{{ trans('fields.buttons.restore') }}</x-forms.buttons.submit>
        </x-forms.modals.footer>
    </x-forms.modal>
</x-actions.modal-block>
