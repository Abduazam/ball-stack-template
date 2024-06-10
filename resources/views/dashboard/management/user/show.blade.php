<x-layouts.app>
    <div class="content">
        <x-sections.block title="{{ trans('fields.blocks.titles.user_information') }}" icon="fa fa-user-circle">
            <div class="row items-push">
                <div class="col-lg-3">
                    <p class="text-muted">
                        {{ trans('fields.blocks.descriptions.user_information') }}
                    </p>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <x-forms.input value="{{ $user->name }}" label="{{ trans('fields.columns.user.name') }}" name="form.name" readonly />

                    <x-forms.input value="{{ $user->email }}" label="{{ trans('fields.columns.user.email') }}" name="form.email" readonly />

                    <x-forms.input value="{{ $user->roles->first()?->name }}" label="{{ trans('fields.columns.user.role') }}" name="form.email" readonly />

                    <div class="row mb-2">
                        <div class="col-md-10 co™l-xl-6">
                            <div class="push position-relative">
                                @if($user->image)
                                    <img class="img-avatar" src="/{{ $user->image->path }}" alt="{{ $user->name }}">
                                @else
                                    <x-partials.avatar-image />
                                @endif
                            </div>
                        </div>
                    </div>

                    <div>
                        <x-forms.buttons.link route="{{ route('dashboard.management.users.index') }}" :small="false" class="btn-alt-secondary">{{ trans('fields.buttons.back') }}</x-forms.buttons.link>
                        <x-forms.buttons.link route="{{ route('dashboard.management.users.edit', $user) }}" :small="false" class="btn-alt-primary">{{ trans('fields.buttons.update') }}</x-forms.buttons.link>
                    </div>
                </div>
            </div>
        </x-sections.block>
    </div>
</x-layouts.app>
