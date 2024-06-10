<x-sections.block title="{{ trans('fields.columns.role.users') }}">
    <x-forms.table>
        <x-forms.tables.head>
            <x-forms.tables.tr>
                <x-forms.tables.th>{{ trans('fields.columns.user.name') }}</x-forms.tables.th>
                <x-forms.tables.th>{{ trans('fields.columns.user.email') }}</x-forms.tables.th>
                <x-forms.tables.th>{{ trans('fields.columns.general.status') }}</x-forms.tables.th>
            </x-forms.tables.tr>
        </x-forms.tables.head>

        <x-forms.tables.body>
            @foreach($users as $user)
                <x-forms.tables.tr>
                    <x-forms.tables.td>{{ $user->name }}</x-forms.tables.td>
                    <x-forms.tables.td>{{ $user->email }}</x-forms.tables.td>
                    <x-forms.tables.td>{!! $user->status() !!}</x-forms.tables.td>
                </x-forms.tables.tr>
            @endforeach
        </x-forms.tables.body>
    </x-forms.table>

    <x-partials.pagination :data="$users" />
</x-sections.block>
