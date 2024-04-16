<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id'=> 1,
                'nama' => 'Fauzi',
                'no_telp' => '+6282247375283'
            ]
        ];

        DB::table('admins')->insert($data);
    }
}
