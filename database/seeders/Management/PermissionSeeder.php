<?php

namespace Database\Seeders\Management;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::findByName('super-admin');
        $admin = Role::findByName('admin');
        $manager = Role::findByName('manager');

        $routes = collect(Route::getRoutes());

        $routes->each(function ($route) use ($superAdmin, $admin, $manager) {
            $name = $route->getName();
            if ($name && Str::startsWith($name, 'dashboard.')) {
                $permission = Permission::create(['name' => $name]);

                $superAdmin->givePermissionTo($permission);
                $admin->givePermissionTo($permission);
            }
        });
    }
}
