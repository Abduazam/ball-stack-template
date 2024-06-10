<ul class="nav-main">
    <x-partials.nav.link icon="si si-home" url="dashboard.welcome" :active="request()->is('dashboard')">
        {{ trans('fields.nav.overview') }}
    </x-partials.nav.link>

    <x-partials.nav.heading>{{ trans('fields.nav.headings.management') }}</x-partials.nav.heading>
    <x-partials.nav.link icon="si si-users" url="dashboard.management.users.index" :active="request()->is('dashboard/management/users*')">
        {{ trans('fields.nav.users') }}
    </x-partials.nav.link>

    <x-partials.nav.link icon="si si-shield" url="dashboard.management.roles.index" :active="request()->is('dashboard/management/roles*')">
        {{ trans('fields.nav.roles') }}
    </x-partials.nav.link>

    <x-partials.nav.link icon="si si-key" url="dashboard.management.permissions.index" :active="request()->is('dashboard/management/permissions*')">
        {{ trans('fields.nav.permissions') }}
    </x-partials.nav.link>

    <x-partials.nav.heading>{{ trans('fields.nav.headings.settings') }}</x-partials.nav.heading>
    <x-partials.nav.link icon="si si-pencil" url="dashboard.settings.profile" :active="request()->is('dashboard/settings/profile')">
        {{ trans('fields.nav.profile') }}
    </x-partials.nav.link>
    <x-partials.nav.link icon="si si-cloud-upload" url="dashboard.settings.import" :active="request()->is('dashboard/settings/import')">
        {{ trans('fields.nav.import') }}
    </x-partials.nav.link>
</ul>
