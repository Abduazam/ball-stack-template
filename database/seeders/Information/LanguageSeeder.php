<?php

namespace Database\Seeders\Information;

use App\Models\Information\Language;
use Illuminate\Database\Seeder;

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
