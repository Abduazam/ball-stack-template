<x-forms.selects.filter-select wire:model.live="perPage" class="form-select-sm">
    <x-forms.selects.option value="10">10</x-forms.selects.option>
    <x-forms.selects.option value="20">20</x-forms.selects.option>
    <x-forms.selects.option value="50">50</x-forms.selects.option>
    <x-forms.selects.option value="0">{{ trans('fields.filters.all') }}</x-forms.selects.option>
</x-forms.selects.filter-select>
