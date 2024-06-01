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
                'level' => 'admin',
                'foto_profil' => '16NtVyPHhGoEKybdPEjKHv76kuaL8W1MhWs9vaMu.jpg'
            ], [
                'username' => 'ketua1',
                'password' => Hash::make('Ketua123'),
                'level' => 'ketua',
                'foto_profil' => '16NtVyPHhGoEKybdPEjKHv76kuaL8W1MhWs9vaMu.jpg'
            ], [
                'username' => 'kader1',
                'password' => Hash::make('Kader123'),
                'level' => 'kader',
                'foto_profil' => '16NtVyPHhGoEKybdPEjKHv76kuaL8W1MhWs9vaMu.jpg'

            ], [
                'username' => 'kader2',
                'password' => Hash::make('Kader234'),
                'level' => 'kader',
                'foto_profil' => '16NtVyPHhGoEKybdPEjKHv76kuaL8W1MhWs9vaMu.jpg'
            ], [
                'username' => 'kader3',
                'password' => Hash::make('Kader345'),
                'level' => 'kader',
                'foto_profil' => '16NtVyPHhGoEKybdPEjKHv76kuaL8W1MhWs9vaMu.jpg'
            ], [
                'username' => 'kader4',
                'password' => Hash::make('Kader456'),
                'level' => 'kader',
                'foto_profil' => '16NtVyPHhGoEKybdPEjKHv76kuaL8W1MhWs9vaMu.jpg'
            ], [
                'username' => 'kader5',
                'password' => Hash::make('Kader567'),
                'level' => 'kader',
                'foto_profil' => '16NtVyPHhGoEKybdPEjKHv76kuaL8W1MhWs9vaMu.jpg'
            ], [
                'username' => 'admin2',
                'password' => Hash::make('Admin234'),
                'level' => 'admin',
                'foto_profil' => '16NtVyPHhGoEKybdPEjKHv76kuaL8W1MhWs9vaMu.jpg'
            ],
        ];

        DB::table('users')->insert($data);
    }
}
