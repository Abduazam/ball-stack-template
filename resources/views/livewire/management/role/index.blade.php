@php use App\Contracts\Enums\Route\RoutePathEnum; @endphp

<x-sections.block
        title="{{ trans('fields.blocks.titles.roles') }}"
        export="{{ RoutePathEnum::ROLE->value . 'export' }}"
>
    <div class="filter-table pb-4">
        <div class="row w-100 h-100 m-0 p-0 row-gap-sm-0 row-gap-2">
            <div class="col-md-2 col-12 ps-0 pe-md-2 pe-0">
                @can('create', \Modules\Management\App\Models\Role\Role::class)
                    <x-forms.buttons.link route="{{ route('dashboard.management.roles.create') }}" class="btn-primary">
                        {{ trans('fields.actions.buttons.create', ['model' => trans('fields.columns.role.role')]) }}
                    </x-forms.buttons.link>
                @endcan
            </div>
            <div class="col-md-10 col-12 pe-0 ps-md-2 ps-0">
                <div class="row justify-content-end row-gap-sm-0 row-gap-2">
                    <div class="col-md-2 col-6">
                        <x-components.per-page/>
                    </div>
                    <div class="col-md-2 col-6">
                        <x-components.trashed/>
                    </div>
                    <div class="col-md-6 col-12">
                        <x-forms.inputs.search class="form-control-sm"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-forms.table>
        <x-forms.tables.head>
            <x-forms.tables.tr>
                <x-forms.tables.th>{{ trans('fields.columns.general.action') }}</x-forms.tables.th>
                <x-forms.tables.th>{{ trans('fields.columns.general.id') }}</x-forms.tables.th>
                <x-forms.tables.th>{{ trans('fields.columns.role.name') }}</x-forms.tables.th>
                <x-forms.tables.th>{{ trans('fields.columns.role.user_count') }}</x-forms.tables.th>
                <x-forms.tables.th>{{ trans('fields.columns.role.permission_count') }}</x-forms.tables.th>
                <x-forms.tables.th>{{ trans('fields.columns.general.status') }}</x-forms.tables.th>
                <x-forms.tables.th>{{ trans('fields.columns.general.created_at') }}</x-forms.tables.th>
            </x-forms.tables.tr>
        </x-forms.tables.head>

        <x-forms.tables.body>
            @foreach($roles as $role)
                <x-forms.tables.tr wire:key="role-row-{{ $role->id }}">
                    <x-forms.tables.td>
                        @can('show', $role)
                            <x-forms.buttons.link route="{{ route('dashboard.management.roles.show', $role) }}"
                                                  class="btn-secondary">
                                <x-actions.icons.show/>
                            </x-forms.buttons.link>
                        @endcan

                        @can('update', $role)
                            <x-forms.buttons.link route="{{ route('dashboard.management.roles.edit', $role) }}"
                                                  class="btn-primary">
                                <x-actions.icons.update/>
                            </x-forms.buttons.link>
                        @endcan

                        @can('delete', $role)
                            <livewire:management.role.delete wire:key="{{ 'delete-role-id' . $role->id }}" :$role/>
                        @endcan

                        @can('restore', $role)
                            <livewire:management.role.restore wire:key="{{ 'restore-role-id' . $role->id }}" :$role/>
                        @endcan

                        @can('destroy', $role)
                            <livewire:management.role.destroy wire:key="{{ 'destroy-role-id' . $role->id }}" :$role/>
                        @endcan
                    </x-forms.tables.td>
                    <x-forms.tables.td>{{ $loop->iteration }}</x-forms.tables.td>
                    <x-forms.tables.td>{{ $role->name }}</x-forms.tables.td>
                    <x-forms.tables.td>{{ $role->users_count }}</x-forms.tables.td>
                    <x-forms.tables.td>{{ $role->permissions_count }}</x-forms.tables.td>
                    <x-forms.tables.td>{!! $role->status() !!}</x-forms.tables.td>
                    <x-forms.tables.td>{{ $role->created_at }}</x-forms.tables.td>
                </x-forms.tables.tr>
            @endforeach
        </x-forms.tables.body>
    </x-forms.table>

    <x-partials.pagination :data="$roles"/>
</x-sections.block>
