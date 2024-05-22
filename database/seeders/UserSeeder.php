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
                'username' => 'admin1',
                'password' => Hash::make('Admin123'),
                'level' => 'admin'
            ], [
                'username' => 'ketua1',
                'password' => Hash::make('Ketua123'),
                'level' => 'ketua'
            ], [
                'username' => 'kader1',
                'password' => Hash::make('Kader123'),
                'level' => 'kader'
            ], [
                'username' => 'kader2',
                'password' => Hash::make('Kader234'),
                'level' => 'kader'
            ], [
                'username' => 'kader3',
                'password' => Hash::make('Kader345'),
                'level' => 'kader'
            ], [
                'username' => 'kader4',
                'password' => Hash::make('Kader456'),
                'level' => 'kader'
            ], [
                'username' => 'kader5',
                'password' => Hash::make('Kader567'),
                'level' => 'kader'
            ], [
                'username' => 'admin2',
                'password' => Hash::make('Admin234'),
                'level' => 'admin'
            ], [
                'username' => 'admin3',
                'password' => Hash::make('Admin345'),
                'level' => 'admin'
            ], [
                'username' => 'admin4',
                'password' => Hash::make('Admin456'),
                'level' => 'admin'
            ], [
                'username' => 'admin5',
                'password' => Hash::make('Admin567'),
                'level' => 'admin'
            ],
        ];

        DB::table('users')->insert($data);
    }
}
