<x-sections.block title="{{ trans('fields.blocks.titles.user_information') }}">
    <x-forms.form action="create">
        <div class="row items-push">
            <div class="col-lg-3">
                <p class="text-muted">
                    {{ trans('fields.blocks.descriptions.user_information') }}
                </p>
            </div>
            <div class="col-lg-7 offset-lg-1">
                <x-management::pages.user.user-form :roles="$roles" />

                <div>
                    <x-forms.buttons.link route="{{ route('dashboard.management.users.index') }}" :small="false" class="btn-alt-secondary">{{ trans('fields.buttons.back') }}</x-forms.buttons.link>
                    <x-forms.buttons.submit class="btn-alt-success">{{ trans('fields.buttons.create') }}</x-forms.buttons.submit>
                </div>
            </div>
        </div>
    </x-forms.form>
</x-sections.block>
