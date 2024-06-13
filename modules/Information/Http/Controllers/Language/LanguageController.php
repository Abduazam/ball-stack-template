<?php

namespace Modules\Information\Http\Controllers\Language;

use App\Contracts\Enums\Folder\FolderPathEnum;
use App\Http\Controllers\Controller;
use App\Models\Information\Language;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;

class LanguageController extends Controller
{
    protected string $path = FolderPathEnum::LANGUAGE->value;

    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize('index', Language::class);

        return view($this->path . 'index');
    }

    /**
     * Display the specified resource.
     * @throws AuthorizationException
     */
    public function show(Language $language): View
    {
        $this->authorize('show', $language);

        return view($this->path . 'show', [
            'language' => $language
        ]);
    }
}
