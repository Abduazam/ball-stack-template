<x-forms.input wire:model.blur="form.name" label="{{ trans('fields.columns.role.name') }}" name="form.name" placeholder="{{ trans('fields.placeholders.role.name') }}" />

<div class="mb-4">
    <label class="form-label">{{ trans('fields.columns.role.permissions') }}</label>
    <div class="space-y-2">
        <x-forms.checkbox wire:model.live="form.all" name="form.all" :label="trans('fields.filters.all')" :checked="$this->form->all"></x-forms.checkbox>
    </div>
</div>
