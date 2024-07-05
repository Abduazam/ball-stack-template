<x-forms.modals.header :title="trans('fields.columns.user.user')" />

<x-forms.modals.body>
    <div class="row">
        <div class="col-md-6 col-12">
            <x-forms.input class="form-control-sm" label="{{ trans('fields.columns.user.name') }}" name="name" value="{{ $this->user->name }}" disabled />
        </div>
        <div class="col-md-6 col-12">
            <x-forms.input class="form-control-sm" label="{{ trans('fields.columns.user.email') }}" name="email" value="{{ $this->user->email }}" disabled />
        </div>
        <div class="col-md-6 col-12">
            <x-forms.input class="form-control-sm" label="{{ trans('fields.columns.user.role') }}" name="role" value="{{ $this->user->roles?->first()?->name }}" disabled />
        </div>
    </div>
</x-forms.modals.body>
