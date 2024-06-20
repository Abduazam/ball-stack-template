<?php

namespace Modules\Management\Database\seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::findByName('admin');

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);
        $admin->assignRole($adminRole);

        $azam = User::factory()->create([
            'name' => 'Azam',
            'email' => 'azam@example.com',
            'password' => 1234,
        ]);
        $azam->assignRole($adminRole);

        //$this->managers();
    }

    private function managers(): void
    {
        $managerRole = Role::findByName('manager');
        $doctorRole = Role::findByName('doctor');

        $managers = User::factory(100)->create();
        $roleUserData = $managers->map(function ($manager) use ($managerRole, $doctorRole) {
            $role = rand(0, 1) ? $managerRole : $doctorRole;

            return [
                'role_id' => $role->id,
                'model_type' => User::class,
                'model_id' => $manager->id,
            ];
        })->toArray();

        DB::table('model_has_roles')->insert($roleUserData);
    }
}
