<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id'   =>   1,
                'name' => 'superadmin'
            ],
            [
                'id'   =>   3,
                'name' => 'user'
            ],
            [
                'id'   =>   2,
                'name' => 'sub_admin'
            ]
        ]);
    }
}
