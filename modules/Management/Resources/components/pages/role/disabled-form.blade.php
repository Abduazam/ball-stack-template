<x-forms.modals.header :title="trans('fields.columns.role.role')" />

<x-forms.modals.body>
    <div class="row">
        <div class="col-12">
            <x-forms.input class="form-control-sm" label="{{ trans('fields.columns.role.name') }}" name="name" value="{{ $this->role->name }}" disabled />
        </div>
    </div>
</x-forms.modals.body>
