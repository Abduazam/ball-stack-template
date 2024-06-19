@php use App\Contracts\Enums\Route\RoutePathEnum; @endphp

<x-sections.block
    title="{{ trans('fields.blocks.titles.languages') }}"
    export="{{ RoutePathEnum::LANGUAGE->value . 'export' }}"
>
    <div class="filter-table pb-4">
        <div class="row w-100 h-100 m-0 p-0 row-gap-sm-0 row-gap-2">
            <div class="col-md-2 col-12 ps-0 pe-md-2 pe-0">
                @can('create', \Modules\Information\App\Models\Language\Language::class)
                    <livewire:information.language.create/>
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
                <x-forms.tables.th>{{ trans('fields.columns.language.slug') }}</x-forms.tables.th>
                <x-forms.tables.th>{{ trans('fields.columns.language.title') }}</x-forms.tables.th>
                <x-forms.tables.th>{{ trans('fields.columns.general.status') }}</x-forms.tables.th>
                <x-forms.tables.th>{{ trans('fields.columns.general.created_at') }}</x-forms.tables.th>
            </x-forms.tables.tr>
        </x-forms.tables.head>

        <x-forms.tables.body>
            @foreach($languages as $language)
                <x-forms.tables.tr wire:key="language-row-{{ $language->id }}">
                    <x-forms.tables.td>
                        @can('show', $language)
                            <x-forms.buttons.link route="{{ route('dashboard.information.languages.show', $language) }}"
                                                  class="btn-secondary">
                                <x-actions.icons.show/>
                            </x-forms.buttons.link>
                        @endcan

                        @can('update', $language)
                            <livewire:information.language.update wire:key="{{ 'update-language-id' . $language->id }}"
                                                                  :$language/>
                        @endcan

                        @can('delete', $language)
                            <livewire:information.language.delete wire:key="{{ 'delete-language-id' . $language->id }}"
                                                                  :$language/>
                        @endcan

                        @can('restore', $language)
                            <livewire:information.language.restore
                                wire:key="{{ 'restore-language-id' . $language->id }}" :$language/>
                        @endcan

                        @can('destroy', $language)
                            <livewire:information.language.destroy
                                wire:key="{{ 'destroy-language-id' . $language->id }}" :$language/>
                        @endcan
                    </x-forms.tables.td>
                    <x-forms.tables.td>{{ $language->id }}</x-forms.tables.td>
                    <x-forms.tables.td>{{ $language->slug }}</x-forms.tables.td>
                    <x-forms.tables.td>{{ $language->title }}</x-forms.tables.td>
                    <x-forms.tables.td>{!! $language->status() !!}</x-forms.tables.td>
                    <x-forms.tables.td>{{ $language->created_at }}</x-forms.tables.td>
                </x-forms.tables.tr>
            @endforeach
        </x-forms.tables.body>
    </x-forms.table>
    <x-partials.pagination :data="$languages"/>
</x-sections.block>
