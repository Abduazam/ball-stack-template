<x-layouts.app>
    <div class="content">
        <x-sections.block title="{{ trans('fields.blocks.titles.import') }}" icon="si si-cloud-upload">
            <div class="row items-push">
                <div class="col-lg-3">
                    <p class="text-muted">
                        {{ trans('fields.blocks.descriptions.import_information') }}
                    </p>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <livewire:settings.import />
                </div>
            </div>
        </x-sections.block>
    </div>
</x-layouts.app>
