<x-sections.block title="{{ trans('fields.columns.role.permissions') }}">
    <x-forms.table>
        <x-forms.tables.head>
            <x-forms.tables.tr>
                <x-forms.tables.th>{{ trans('fields.columns.permission.name') }}</x-forms.tables.th>
                <x-forms.tables.th>{{ trans('fields.columns.permission.description') }}</x-forms.tables.th>
            </x-forms.tables.tr>
        </x-forms.tables.head>

        <x-forms.tables.body>
            @foreach($permissions as $permission)
                <x-forms.tables.tr>
                    <x-forms.tables.td>{{ str_replace('.', ' > ', $permission->name) }}</x-forms.tables.td>
                    <x-forms.tables.td>{{ translation($permission->description) }}</x-forms.tables.td>
                </x-forms.tables.tr>
            @endforeach
        </x-forms.tables.body>
    </x-forms.table>

    <x-partials.pagination :data="$permissions" />
</x-sections.block>
