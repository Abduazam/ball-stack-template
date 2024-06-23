<x-forms.modals.header :title="trans('fields.columns.language.language')" />

<x-forms.modals.body>
    <div class="row">
        <div class="col-12">
            <x-forms.input class="form-control-sm" label="{{ trans('fields.columns.language.slug') }}" name="form.slug" value="{{ $this->language->slug }}" disabled />

            <x-forms.input class="form-control-sm" label="{{ trans('fields.columns.language.title') }}" name="form.title" value="{{ $this->language->title }}" disabled />
        </div>
    </div>
</x-forms.modals.body>
