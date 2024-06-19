<x-sections.block title="{{ trans('fields.blocks.titles.role_information') }}">
    <x-forms.form action="update">
        <div class="row items-push">
            <div class="col-lg-3">
                <p class="text-muted">
                    {{ trans('fields.blocks.descriptions.role_information') }}
                </p>
            </div>
            <div class="col-lg-7 offset-lg-1">
                <x-management::pages.role.role-form />

                <div>
                    <x-forms.buttons.link route="{{ route('dashboard.management.roles.index') }}" :small="false" class="btn-alt-secondary">{{ trans('fields.buttons.back') }}</x-forms.buttons.link>
                    <x-forms.buttons.submit class="btn-alt-primary">{{ trans('fields.buttons.update') }}</x-forms.buttons.submit>
                </div>
            </div>
            <x-management::pages.role.permission-form :permissions="$permissions" />
        </div>
    </x-forms.form>
</x-sections.block>
