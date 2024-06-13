@php
    use Modules\Information\Repositories\Language\LanguageRepository;

    $languages = (new LanguageRepository())->all();

    $currentLanguage = $languages->first(function ($language) {
        return $language->slug === app()->getLocale();
    });

    if ($languages->count() > 1) {
        $languages = $languages->reject(function ($language) use ($currentLanguage) {
            return $language->slug === $currentLanguage->slug;
        });
    }
@endphp

<div class="dropdown d-inline-block">
    <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-user-dropdown" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        <i class="si si-globe d-sm-none"></i>
        <span class="d-none d-sm-inline-block fw-semibold">{{ $currentLanguage->title }}</span>
        <i class="si si-arrow-down opacity-50 ms-1"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-start" aria-labelledby="page-header-user-dropdown">
        @foreach($languages as $language)
            <a class="dropdown-item d-flex align-items-center justify-content-between"
               href="{{ route('dashboard.settings.locale', $language->slug) }}">
                <span>{{ $language->title }}</span>
            </a>
        @endforeach
    </div>
</div>
