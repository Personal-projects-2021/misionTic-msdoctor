<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $role1 = Role::create(['name' => 'admin',]);

        // Permission::create(['name' => 'admin.doctors.index'])->syncRoles(['admin']);
        // Permission::create(['name' => 'admin.doctors.create'])->syncRoles(['admin']);
        // Permission::create(['name' => 'admin.doctors.edit'])->syncRoles(['admin']);
        // Permission::create(['name' => 'admin.doctors.destroy'])->syncRoles(['admin']);
    }
}
