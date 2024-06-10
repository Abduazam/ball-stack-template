@props([
    'title' => null,
    'icon' => null,
    'export' => null,
])

<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">
            @if($icon)<i class="{{ $icon }} me-1 text-muted"></i>@endif {{ $title }}
        </h3>

        <div class="block-options">
            @if($export)
                @can($export)
                    <x-forms.buttons.link class="btn-primary" :route="route($export)">
                        <i class="si si-cloud-download me-1"></i>
                        {{ trans('fields.buttons.export') }}
                    </x-forms.buttons.link>
                @endcan
            @endif
        </div>
    </div>
    <div class="block-content">
        {{ $slot }}
    </div>
</div>
