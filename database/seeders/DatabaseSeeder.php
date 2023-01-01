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
            'password' => bcrypt('password')
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password')
        ]);

        User::create([
            'name' => 'produksi',
            'email' => 'produksi@gmail.com',
            'password' => bcrypt('password')
        ]);

        User::create([
            'name' => 'distribusi',
            'email' => 'distribusi@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}
