<x-sections.block title="{{ trans('fields.blocks.titles.role_information') }}" icon="fa fa-role-circle">
    <x-forms.form action="create">
        <div class="row items-push">
            <div class="col-lg-3">
                <p class="text-muted">
                    {{ trans('fields.blocks.descriptions.role_information') }}
                </p>
            </div>
            <div class="col-lg-7 offset-lg-1">
                <x-forms.input wire:model.blur="form.name" label="{{ trans('fields.columns.role.name') }}" name="form.name" placeholder="{{ trans('fields.placeholders.role.name') }}" />

                <div class="mb-4">
                    <label class="form-label">{{ trans('fields.columns.role.permissions') }}</label>
                    <div class="space-y-2">
                        <div class="form-check">
                            <input wire:model.live="form.all" class="form-check-input" type="checkbox" value="{{ true }}" id="form.all" name="form.all" @if($this->form->all) checked @endif>
                            <label class="form-check-label" for="form.all">{{ trans('fields.filters.all') }}</label>
                        </div>
                    </div>
                </div>

                <div>
                    <x-forms.buttons.link route="{{ route('dashboard.management.roles.index') }}" :small="false" class="btn-alt-secondary">{{ trans('fields.buttons.back') }}</x-forms.buttons.link>
                    <x-forms.buttons.submit class="btn-alt-success">{{ trans('fields.buttons.create') }}</x-forms.buttons.submit>
                </div>
            </div>
            <div class="col-12 px-7">
                @foreach($permissions as $group => $collection)
                    <div class="col-12 pb-4">
                        <div class="d-flex align-items-center">
                            <label class="form-check-label fw-semibold me-2 fs-5" for="{{ $group }}">{{ ucfirst($group) }}</label>
                            <input wire:change="setGroupPermission('{{ $collection->pluck('id')->implode(',') }}')" class="form-check-input" type="checkbox" id="{{ $group }}" name="{{ $group }}" @if($collection->pluck('id')->intersect($this->form->permissions)->isNotEmpty()) checked @endif>
                        </div>
                        <hr class="my-2">
                        <div class="space-x-2 px-3">
                        @foreach($collection as $item)
                            <div class="form-check form-check-inline">
                                <input wire:change="setPermission({{ $item->id }})" class="form-check-input" type="checkbox" id="{{ $item->name }}" name="{{ $item->name }}" @if(in_array($item->id, $this->form->permissions)) checked @endif>
                                <label class="form-check-label" for="{{ $item->name }}">{{ collect(explode('.', $item->name))->last() }}</label>
                            </div>
                        @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-forms.form>
</x-sections.block>
