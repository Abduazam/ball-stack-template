@php use App\Contracts\Enums\Route\RoutePathEnum; @endphp

<x-sections.block
        title="{{ trans('fields.blocks.titles.users') }}"
        export="{{ RoutePathEnum::USER->value . 'export' }}"
>
    <div class="filter-table pb-4">
        <div class="row w-100 h-100 m-0 p-0 row-gap-sm-0 row-gap-2">
            <div class="col-md-2 col-12 ps-0 pe-md-2 pe-0">
                @can('create', \App\Models\Management\User::class)
                    <x-forms.buttons.link route="{{ route('dashboard.management.users.create') }}" class="btn-primary">
                        {{ trans('fields.actions.buttons.create', ['model' => trans('fields.columns.user.user')]) }}
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
                <x-forms.tables.th>{{ trans('fields.columns.user.name') }}</x-forms.tables.th>
                <x-forms.tables.th>{{ trans('fields.columns.user.email') }}</x-forms.tables.th>
                <x-forms.tables.th>{{ trans('fields.columns.user.role') }}</x-forms.tables.th>
                <x-forms.tables.th>{{ trans('fields.columns.general.status') }}</x-forms.tables.th>
                <x-forms.tables.th>{{ trans('fields.columns.general.created_at') }}</x-forms.tables.th>
            </x-forms.tables.tr>
        </x-forms.tables.head>

        <x-forms.tables.body>
            @foreach($users as $user)
                <x-forms.tables.tr wire:key="user-row-{{ $user->id }}">
                    <x-forms.tables.td>
                        @can('show', $user)
                            <x-forms.buttons.link route="{{ route('dashboard.management.users.show', $user) }}"
                                                  class="btn-secondary">
                                <x-actions.icons.show/>
                            </x-forms.buttons.link>
                        @endcan

                        @can('update', $user)
                            <x-forms.buttons.link route="{{ route('dashboard.management.users.edit', $user) }}"
                                                  class="btn-primary">
                                <x-actions.icons.update/>
                            </x-forms.buttons.link>
                        @endcan

                        @can('delete', $user)
                            <livewire:management.user.delete wire:key="{{ 'delete-user-id' . $user->id }}" :$user/>
                        @endcan

                        @can('restore', $user)
                            <livewire:management.user.restore wire:key="{{ 'restore-user-id' . $user->id }}" :$user/>
                        @endcan

                        @can('destroy', $user)
                            <livewire:management.user.destroy wire:key="{{ 'destroy-user-id' . $user->id }}" :$user/>
                        @endcan
                    </x-forms.tables.td>
                    <x-forms.tables.td>{{ $user->id }}</x-forms.tables.td>
                    <x-forms.tables.td>{{ $user->name }}</x-forms.tables.td>
                    <x-forms.tables.td>{{ $user->email }}</x-forms.tables.td>
                    <x-forms.tables.td>{{ $user->roles->first()?->name }}</x-forms.tables.td>
                    <x-forms.tables.td>{!! $user->status() !!}</x-forms.tables.td>
                    <x-forms.tables.td>{{ $user->created_at }}</x-forms.tables.td>
                </x-forms.tables.tr>
            @endforeach
        </x-forms.tables.body>
    </x-forms.table>
    <x-partials.pagination :data="$users"/>
</x-sections.block>
