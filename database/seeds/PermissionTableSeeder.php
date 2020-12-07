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
            'book-club-delete',
            'cart-list',
            'cart-create',
            'cart-edit',
            'cart-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'ad-list',
            'ad-create',
            'ad-edit',
            'ad-delete',
            'language-list',
            'language-create',
            'language-edit',
            'language-delete',
            'country-list',
            'country-create',
            'country-edit',
            'country-delete',
            'currency-list',
            'currency-create',
            'currency-edit',
            'currency-delete',
            'site-setting-list',
            'site-setting-create',
            'site-setting-edit',
            'site-setting-delete',
            'banner-list',
            'banner-create',
            'banner-edit',
            'banner-delete',
            'user-request-list',
            'user-request-create',
            'user-request-edit',
            'user-request-delete',
            'genre-list',
            'genre-create',
            'genre-edit',
            'genre-delete',
            'contact-list',
            'contact-create',
            'contact-edit',
            'contact-delete',
            'address-list',
            'address-create',
            'address-edit',
            'address-delete',
            'join-us-list',
            'join-us-create',
            'join-us-edit',
            'join-us-delete',
            'publisher-list',
            'publisher-create',
            'publisher-edit',
            'publisher-delete',


            ];
        foreach ($permissions as $permission) {
        Permission::create(['name' => $permission]);
        }
    }
}
