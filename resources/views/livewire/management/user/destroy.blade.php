@php
    $target = 'modal-destroy-user-id' . $this->user->id;
@endphp

<x-actions.modal-block>
    <x-forms.buttons.open-modal class="btn-danger" :target="$target">
        <x-actions.icons.delete />
    </x-forms.buttons.open-modal>

    <x-forms.modal action="destroy" :target="$target">
        <x-forms.modals.header :title="trans('fields.columns.user.user')" />

        <x-forms.modals.body>
            <div class="row">
                <div class="col-md-6 col-12">
                    <x-forms.input class="form-control-sm" label="{{ trans('fields.columns.user.name') }}" name="form.name" value="{{ $this->user->name }}" disabled />
                </div>
                <div class="col-md-6 col-12">
                    <x-forms.input class="form-control-sm" label="{{ trans('fields.columns.user.email') }}" name="form.email" value="{{ $this->user->email }}" disabled />
                </div>
                <div class="col-md-6 col-12">
                    <x-forms.input class="form-control-sm" label="{{ trans('fields.columns.user.role') }}" name="form.role" value="{{ $this->user->roles?->first()?->name }}" disabled />
                </div>
            </div>
        </x-forms.modals.body>

        <x-forms.modals.footer>
            <x-forms.buttons.submit class="btn-sm btn-alt-danger">{{ trans('fields.buttons.destroy') }}</x-forms.buttons.submit>
        </x-forms.modals.footer>
    </x-forms.modal>
</x-actions.modal-block>
