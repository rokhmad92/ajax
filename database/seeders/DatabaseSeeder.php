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
            'email' => 'rokhmad92@gmail.com',
            'username' => 'rokhmad',
            'password' => bcrypt('123456'),
            'gender' => 'Laki-Laki',
            'kartu' => '3'
        ]);
        User::create([
            'email' => 'gamingaan92@gmail.com',
            'username' => 'yulian',
            'password' => bcrypt('123456'),
            'gender' => 'Laki-Laki',
            'kartu' => 'im3'
        ]);
        User::create([
            'email' => 'rukiati@gmail.com',
            'username' => 'rukiati',
            'password' => bcrypt('123456'),
            'gender' => 'Perempuan',
            'kartu' => '3'
        ]);
    }
}
