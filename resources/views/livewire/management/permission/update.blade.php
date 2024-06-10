@php
    $target = 'modal-update-permission-id' . $this->permission->id;
@endphp

<x-actions.modal-block>
    <x-forms.buttons.open-modal class="btn-primary" :target="$target">
        <x-actions.icons.update />
    </x-forms.buttons.open-modal>

    <x-forms.modal action="update" size="modal-lg" :target="$target">
        <x-forms.modals.header :title="trans('fields.columns.permission.permission')" />

        <x-forms.modals.body>
            <div class="row">
                <div class="col-10">
                    <x-forms.input class="form-control-sm" label="{{ trans('fields.columns.permission.name') }}" name="form.name" value="{{ $this->permission->name }}" disabled />
                </div>

                <div class="col-2">
                    <div class="mb-4">
                        <label class="form-label" for="form.is_default">{{ trans('fields.columns.permission.is_default') }}</label>
                        <div class="space-y-2">
                            <div class="form-check form-switch">
                                <input wire:model.live="form.is_default" class="form-check-input" type="checkbox" value="{{ true }}" id="is_default" name="is_default" @if($this->form->is_default) checked @endif>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    @foreach($this->form->description as $slug => $value)
                        <x-forms.input wire:model.blur="form.description.{{ $slug }}" class="form-control-sm" label="{{ trans('fields.columns.permission.description') }} ({{ $slug }})" name="form.description.{{ $slug }}" />
                    @endforeach
                </div>
            </div>
        </x-forms.modals.body>

        <x-forms.modals.footer>
            <x-forms.buttons.submit class="btn-sm btn-alt-primary">{{ trans('fields.buttons.update') }}</x-forms.buttons.submit>
        </x-forms.modals.footer>
    </x-forms.modal>
</x-actions.modal-block>
