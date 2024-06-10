<x-layouts.app>
    <div class="bg-body-dark">
        <div class="content">
            <div class="row flex-row-reverse">
                <x-partials.welcome.block icon="si si-pencil" url="{{ route('dashboard.settings.profile') }}">
                    {{ trans('fields.nav.profile') }}
                </x-partials.welcome.block>
            </div>
        </div>
    </div>
</x-layouts.app>
