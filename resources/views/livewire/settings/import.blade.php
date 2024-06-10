<x-forms.form action="import">
    @if($this->importing && !$this->importFinished)
        <div wire:poll="updateImportProgress">
            <div class="spinner-border text-dark mb-2" role="status">
                <span class="sr-only">Importing...</span>
            </div>
            <p>Importing the file... Please wait a minute!</p>
        </div>
    @else
        <div class="row mb-2">
            <x-forms.select wire:model.live="form.section" label="{{ trans('fields.columns.import.section') }}" name="form.section">
                <option value="null" selected disabled>{{ trans('fields.filters.choose') }}</option>
                @foreach($sections as $section)
                    @can($section->name)
                    <option value="{{ $section->name }}">{{ collect(explode('.', $section->name))->slice(2)->implode(' ') }}</option>
                    @endcan
                @endforeach
            </x-forms.select>

            <x-forms.input wire:model.live="form.file" type="file" label="{{ trans('fields.columns.import.file') }}" name="form.file" :disabled="is_null($this->form->section)" />
        </div>

        <div>
            <x-forms.buttons.submit class="btn-alt-primary" :disabled="is_null($this->form->file)">{{ trans('fields.buttons.import') }}</x-forms.buttons.submit>
        </div>
    @endif
</x-forms.form>



