<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'username'=> 'admin',
                'password' => Hash::make('Admin123'),
                'level' => 'admin'
            ],[
                'username'=> 'ketua1',
                'password' => Hash::make('Ketua123'),
                'level' => 'ketua'
            ],[
                'username'=> 'kader1',
                'password' => Hash::make('Kader123'),
                'level' => 'kader'
            ],
        ];

        DB::table('users')->insert($data);
    }
}
