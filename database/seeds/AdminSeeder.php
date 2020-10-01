<?php

use Illuminate\Database\Seeder;
use App\Role;
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
        DB::table('users')->insert([
            [
                'first_name'     => 'admin',
                'last_name'     => 'admin',
                'email'    => 'admin@admin.com',
                'password' => bcrypt('click123'),
                'phone'     => 4301229292921,
                'status'   => true,
                'role_id'   => Role::ROLES['ADMIN']
            ],
            [
                'first_name'     => 'admin',
                'last_name'     => 'admin',
                'email' => 'user@user.com',
                'password' => bcrypt('click123'),
                'phone'     => 4301229292921,
                'status'   => true,
                'role_id'   => Role::ROLES['USER']
            ]
        ]);
    }
}
