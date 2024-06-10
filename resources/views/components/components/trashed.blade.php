<x-forms.selects.filter-select wire:model.live="trashed" class="form-select-sm">
    <x-forms.selects.option value="0">{{ trans('fields.filters.active') }}</x-forms.selects.option>
    <x-forms.selects.option value="1">{{ trans('fields.filters.inactive') }}</x-forms.selects.option>
</x-forms.selects.filter-select>
