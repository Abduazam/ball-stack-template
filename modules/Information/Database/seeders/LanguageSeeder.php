<?php

namespace Modules\Information\Database\seeders;

use Illuminate\Database\Seeder;
use Modules\Information\App\Models\Language\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            'en' => "English",
             'ru' => "Русский",
        ];

        foreach ($languages as $slug => $title) {
            Language::create([
                'slug' => $slug,
                'title' => $title,
            ]);
        }
    }
}
