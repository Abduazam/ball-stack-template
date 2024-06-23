<x-layouts.app>
    <div class="content">
        <x-sections.block title="{{ trans('fields.blocks.titles.role_information') }}">
            <div class="row items-push">
                <div class="col-lg-3">
                    <p class="text-muted">
                        {{ trans('fields.blocks.descriptions.role_information') }}
                    </p>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <x-forms.input value="{{ $role->name }}" label="{{ trans('fields.columns.role.name') }}" name="form.name" readonly />

                    <div>
                        <x-forms.buttons.link route="{{ route('dashboard.management.roles.index') }}" :small="false" class="btn-alt-secondary">{{ trans('fields.buttons.back') }}</x-forms.buttons.link>
                        <x-forms.buttons.link route="{{ route('dashboard.management.roles.edit', $role) }}" :small="false" class="btn-alt-primary">{{ trans('fields.buttons.update') }}</x-forms.buttons.link>
                    </div>
                </div>
            </div>
        </x-sections.block>

        <div class="row">
            <div class="col-md-6">
                <x-layouts.load-livewire class="p-0" livewire="management.role.list.user" :props="['role' => $role]" />
            </div>

            <div class="col-md-6">
                <x-layouts.load-livewire class="p-0" livewire="management.role.list.permission" :props="['role' => $role]" />
            </div>
        </div>
    </div>
</x-layouts.app>
