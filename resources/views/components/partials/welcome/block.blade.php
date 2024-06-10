@props([
    'icon' => null,
    'url' => null
])

<div class="col-6 col-md-4 col-xl-2">
    <a class="block block-rounded text-center" href="{{ $url }}">
        <div class="block-content px-2">
            <p class="mt-1 mb-3">
                <i class="{{ $icon }} text-gray fa-2x"></i>
            </p>
            <p class="fw-semibold fs-sm text-uppercase">{{ $slot }}</p>
        </div>
    </a>
</div>
