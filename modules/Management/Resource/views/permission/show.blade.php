@php
    $descriptions = json_decode($permission->description, true);
@endphp

<x-layouts.app>
    <div class="content">
        <x-sections.block title="{{ trans('fields.blocks.titles.permission_information') }}">
            <div class="row items-push">
                <div class="col-lg-3">
                    <p class="text-muted">
                        {{ trans('fields.blocks.descriptions.permission_information') }}
                    </p>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <x-forms.input value="{{ $permission->name }}" label="{{ trans('fields.columns.permission.name') }}" name="permission.name" readonly />

                    <div class="mb-4">
                        <label class="form-label" for="permission.is_default">{{ trans('fields.columns.permission.is_default') }}</label>
                        <div class="space-y-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="permission.is_default" name="permission.is_default" @if($permission->is_default) checked @endif disabled>
                            </div>
                        </div>
                    </div>

                    @if($descriptions)
                        @foreach($descriptions as $key => $value)
                            <x-forms.input value="{{ $value }}" label="{{ trans('fields.columns.permission.description') }} ({{ $key }})" name="permission.description.{{ $key }}" readonly />
                        @endforeach
                    @endif

                    <div>
                        <x-forms.buttons.link route="{{ route('dashboard.management.permissions.index') }}" :small="false" class="btn-alt-secondary">{{ trans('fields.buttons.back') }}</x-forms.buttons.link>
                    </div>
                </div>
            </div>
        </x-sections.block>
    </div>
</x-layouts.app>
