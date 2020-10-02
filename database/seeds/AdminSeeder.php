<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'first_name'     => 'Admin',
            'last_name'     => 'here',
            'email' => 'admin@admin.com',
            'password' => bcrypt('click123'),
            'phone'     => 4301229292921,
            'status'   => true,
            ]);
            $role = Role::create(['name' => 'Admin']);
            $permissions = Permission::pluck('id','id')->all();
            $role->syncPermissions($permissions);
            $admin->assignRole([$role->id]);

            $user = User::create([
            'first_name'     => 'user',
            'last_name'     => 'here',
            'email' => 'user@user.com',
            'password' => bcrypt('click123'),
            'phone'     => 4301229292921,
            'status'   => true,
            ]);
            $role = Role::create(['name' => 'User']);
            $permissions = Permission::pluck('id','id')->all();
            $role->syncPermissions($permissions);
            $user->assignRole([$role->id]);
    }
}
