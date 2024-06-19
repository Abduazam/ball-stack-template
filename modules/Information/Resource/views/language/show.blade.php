<x-layouts.app>
    <div class="content">
        <x-sections.block title="{{ trans('fields.blocks.titles.language_information') }}" icon="si si-globe">
            <div class="row items-push">
                <div class="col-lg-3">
                    <p class="text-muted">
                        {{ trans('fields.blocks.descriptions.language_information') }}
                    </p>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <x-forms.input value="{{ $language->slug }}" label="{{ trans('fields.columns.language.slug') }}" name="form.slug" readonly />

                    <x-forms.input value="{{ $language->title }}" label="{{ trans('fields.columns.language.title') }}" name="form.title" readonly />

                    <div class="mb-4">
                        {!! $language->status() !!}
                    </div>

                    <div>
                        <x-forms.buttons.link route="{{ route('dashboard.information.languages.index') }}" :small="false" class="btn-alt-secondary">{{ trans('fields.buttons.back') }}</x-forms.buttons.link>
                    </div>
                </div>
            </div>
        </x-sections.block>
    </div>
</x-layouts.app>
