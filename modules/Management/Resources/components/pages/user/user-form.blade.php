@props(['roles', 'branches'])

<x-forms.input wire:model.blur="form.name" label="{{ trans('fields.columns.user.name') }}" name="form.name" placeholder="{{ trans('fields.placeholders.user.name') }}" />

<x-forms.input wire:model.blur="form.email" label="{{ trans('fields.columns.user.email') }}" name="form.email" placeholder="{{ trans('fields.placeholders.user.email') }}" />

<x-forms.inputs.password label="{{ trans('fields.columns.user.password') }}" modal="form.password" placeholder="{{ trans('fields.placeholders.user.password') }}" />

<x-forms.select wire:model.blur="form.role" label="{{ trans('fields.columns.user.role') }}" name="form.role">
    <option value="null" selected disabled>{{ trans('fields.filters.choose') }}</option>
    @foreach($roles as $role)
        <option value="{{ $role->id }}">{{ $role->name }}</option>
    @endforeach
</x-forms.select>

<div class="row mb-2">
    <div class="col-md-10 co™l-xl-6">
        <div class="push position-relative">
            @if ($this->form->image && method_exists($this->form->image, 'temporaryUrl'))
                <img class="img-avatar" src="{{ $this->form->image->temporaryUrl() }}" alt="{{ $this->form->name }}">
            @elseif($this->form->image)
                <img class="img-avatar" src="/{{ $this->form->image }}" alt="{{ $this->form->name }}">
            @else
                <x-partials.avatar-image />
            @endif

            @if($this->form->image)
                <x-forms.buttons.remove wire:click="removeImage" class="top-0 start-0 px-1 py-0" />
            @endif
        </div>

        <x-forms.input wire:model.live="form.image" type="file" label="{{ trans('fields.columns.user.image') }}" name="form.image" />
    </div>
</div>
