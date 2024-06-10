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
            Management\RoleSeeder::class,
            Management\PermissionSeeder::class,
            Management\UserSeeder::class,

            // App seeders
            Information\LanguageSeeder::class,
        ]);
    }
}
