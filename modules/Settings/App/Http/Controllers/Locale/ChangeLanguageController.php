<?php

namespace Modules\Settings\App\Http\Controllers\Locale;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Modules\Information\App\Repositories\Language\LanguageRepository;

class ChangeLanguageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $slug, LanguageRepository $repository): RedirectResponse
    {
        $language = $repository->findBySlug($slug);

        if ($language && $language->slug != app()->getLocale()) {
            App::setLocale($language->slug);

            session()->put('locale', $language->slug);

            return redirect()->back();
        }

        abort(404);
    }
}
