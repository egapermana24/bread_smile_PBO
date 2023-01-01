<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::create([
            'name' => 'gudang',
            'email' => 'gudang@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'gudang'
        ]);

        User::create([
            'name' => 'backoffice',
            'email' => 'backoffice@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'backoffice'
        ]);

        User::create([
            'name' => 'produksi',
            'email' => 'produksi@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'produksi'
        ]);

        User::create([
            'name' => 'distribusi',
            'email' => 'distribusi@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'distribusi'
        ]);
    }
}
