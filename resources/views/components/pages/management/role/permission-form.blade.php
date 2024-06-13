<div class="col-12 px-sm-7 px-2">
    @foreach($permissions as $group => $collection)
        <div class="col-12 pb-4">
            <div class="d-flex align-items-center">
                <label class="form-check-label fw-semibold me-2 fs-5" for="{{ $group }}">{{ trans('fields.nav.' . $group) }}</label>
                <x-forms.checkbox wire:change="setGroupPermission('{{ $collection->pluck('id')->implode(',') }}')" :name="$group" :checked="$collection->pluck('id')->intersect($this->form->permissions)->isNotEmpty()" />
            </div>
            <hr class="my-2">
            <div class="space-x-2 space-y-1 px-3">
                @foreach($collection as $item)
                    <x-forms.checkbox wire:change="setPermission({{ $item->id }})" :name="$item->name" :label="trans('fields.buttons.' . collect(explode('.', $item->name))->last())" :checked="in_array($item->id, $this->form->permissions)" :inline="true" />
                @endforeach
            </div>
        </div>
    @endforeach
</div>
