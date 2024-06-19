<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Auth seeders
            \Modules\Management\Database\seeders\RoleSeeder::class,
            \Modules\Management\Database\seeders\PermissionSeeder::class,
            \Modules\Management\Database\seeders\UserSeeder::class,

            // App seeders
            \Modules\Information\Database\seeders\LanguageSeeder::class,
        ]);
    }
}
