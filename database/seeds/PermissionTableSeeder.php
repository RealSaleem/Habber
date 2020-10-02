<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'book-list',
            'book-create',
            'book-edit',
            'book-delete',
            'bookmark-list',
            'bookmark-create',
            'bookmark-edit',
            'bookmark-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'order-list',
            'order-create',
            'order-edit',
            'order-delete',
            'book-club-list',
            'book-club-create',
            'book-club-edit',
            'book-club-delete'

            ];
        foreach ($permissions as $permission) {
        Permission::create(['name' => $permission]);
        }
    }
}
