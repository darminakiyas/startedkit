<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Access_menu;
use App\Models\Menu;
use App\Models\Role;
use App\Models\Sub_menu;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Menu::create([
            'nama' => 'Konfigurasi',
            'slug' => 'konfigurasi',
            'icon' => 'fas fa-fire'
        ]);

        Menu::create([
            'nama' => 'Master',
            'slug' => 'master',
            'icon' => 'fas fa-database'
        ]);
        Menu::create([
            'nama' => 'Registrasi',
            'slug' => 'registrasi',
            'icon' => 'fas fa-clipboard-list'
        ]);
        Menu::create([
            'nama' => 'Siswa',
            'slug' => 'siswa',
            'icon' => 'fas fa-user-graduate'
        ]);

        Sub_menu::create([
            'menu_id' => 1,
            'nama' => 'User',
            'slug' => 'user',
            'url' => 'konfigurasi/user',
        ]);
        Sub_menu::create([
            'menu_id' => 1,
            'nama' => 'Role',
            'slug' => 'role',
            'url' => 'konfigurasi/role',
        ]);
        Sub_menu::create([
            'menu_id' => 1,
            'nama' => 'Menu',
            'slug' => 'menu',
            'url' => 'konfigurasi/menu',
        ]);
        Sub_menu::create([
            'menu_id' => 1,
            'nama' => 'Sub Menu',
            'slug' => 'sub_menu',
            'url' => 'konfigurasi/sub_menu',
        ]);
        Sub_menu::create([
            'menu_id' => 2,
            'nama' => 'Agama',
            'slug' => 'agama',
            'url' => 'master/agama',
        ]);

        Role::create([
            'nama' => 'Administrator',
            'slug' => 'administrator',
        ]);
        Role::create([
            'nama' => 'User',
            'slug' => 'user',
        ]);

        User::create([
            'nama' => 'Admin',
            'slug' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$C0XJ2DXisIGdoC5nQpufUexn.TepC70xKmL8vqaUSgKOLrSKinGZi',
            'role_id' => '1',
            'status_aktif' => '1'
        ]);
        User::create([
            'nama' => 'User',
            'slug' => 'user',
            'email' => 'user@gmail.com',
            'password' => '$2y$10$C0XJ2DXisIGdoC5nQpufUexn.TepC70xKmL8vqaUSgKOLrSKinGZi',
            'role_id' => '2',
            'status_aktif' => '1'
        ]);

        Access_menu::create([
            'role_id' => 1,
            'menu_id' => 1,
            'sub_menu_id' => 1,
        ]);
        Access_menu::create([
            'role_id' => 1,
            'menu_id' => 1,
            'sub_menu_id' => 2,
        ]);
        Access_menu::create([
            'role_id' => 1,
            'menu_id' => 1,
            'sub_menu_id' => 3,
        ]);
        Access_menu::create([
            'role_id' => 1,
            'menu_id' => 1,
            'sub_menu_id' => 4,
        ]);
        Access_menu::create([
            'role_id' => 1,
            'menu_id' => 2,
            'sub_menu_id' => 5,
        ]);
    }
}
