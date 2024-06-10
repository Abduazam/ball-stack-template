@php use App\Contracts\Enums\Route\RoutePathEnum; @endphp

<x-sections.block
        title="{{ trans('fields.blocks.titles.permissions') }}"
        export="{{ RoutePathEnum::PERMISSION->value . 'export' }}"
>
    <div class="filter-table pb-4">
        <div class="row w-100 h-100 m-0 p-0 row-gap-sm-0 row-gap-2">
            <div class="col-12 pe-0 ps-md-2 ps-0">
                <div class="row justify-content-end row-gap-sm-0 row-gap-2">
                    <div class="col-md-2 col-12">
                        <x-components.per-page/>
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
                <x-forms.tables.th>{{ trans('fields.columns.permission.name') }}</x-forms.tables.th>
                <x-forms.tables.th>{{ trans('fields.columns.permission.role_count') }}</x-forms.tables.th>
                <x-forms.tables.th>{{ trans('fields.columns.permission.description') }}</x-forms.tables.th>
                <x-forms.tables.th>{{ trans('fields.columns.permission.is_default') }}</x-forms.tables.th>
                <x-forms.tables.th>{{ trans('fields.columns.general.created_at') }}</x-forms.tables.th>
            </x-forms.tables.tr>
        </x-forms.tables.head>

        <x-forms.tables.body>
            @foreach($permissions as $permission)
                <x-forms.tables.tr wire:key="permission-row-{{ $permission->id }}">
                    <x-forms.tables.td>
                        @can('show', $permission)
                            <x-forms.buttons.link
                                    route="{{ route('dashboard.management.permissions.show', $permission) }}"
                                    class="btn-secondary">
                                <x-actions.icons.show/>
                            </x-forms.buttons.link>
                        @endcan

                        @can('update', $permission)
                            <livewire:management.permission.update wire:key="{{ 'update-role-id' . $permission->id }}"
                                                                   :$permission/>
                        @endcan
                    </x-forms.tables.td>
                    <x-forms.tables.td>{{ $loop->iteration }}</x-forms.tables.td>
                    <x-forms.tables.td>{{ str_replace('.', ' > ', $permission->name) }}</x-forms.tables.td>
                    <x-forms.tables.td>{{ $permission->roles_count }}</x-forms.tables.td>
                    <x-forms.tables.td>{{ translation($permission->description) }}</x-forms.tables.td>
                    <x-forms.tables.td>{!! $permission->default() !!}</x-forms.tables.td>
                    <x-forms.tables.td>{{ $permission->created_at }}</x-forms.tables.td>
                </x-forms.tables.tr>
            @endforeach
        </x-forms.tables.body>
    </x-forms.table>

    <x-partials.pagination :data="$permissions"/>
</x-sections.block>
