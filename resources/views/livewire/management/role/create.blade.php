<x-sections.block title="{{ trans('fields.blocks.titles.role_information') }}" icon="fa fa-role-circle">
    <x-forms.form action="create">
        <div class="row items-push">
            <div class="col-lg-3">
                <p class="text-muted">
                    {{ trans('fields.blocks.descriptions.role_information') }}
                </p>
            </div>
            <div class="col-lg-7 offset-lg-1">
                <x-pages.management.role.role-form />

                <div>
                    <x-forms.buttons.link route="{{ route('dashboard.management.roles.index') }}" :small="false" class="btn-alt-secondary">{{ trans('fields.buttons.back') }}</x-forms.buttons.link>
                    <x-forms.buttons.submit class="btn-alt-success">{{ trans('fields.buttons.create') }}</x-forms.buttons.submit>
                </div>
            </div>
            <x-pages.management.role.permission-form :permissions="$permissions" />
        </div>
    </x-forms.form>
</x-sections.block>
