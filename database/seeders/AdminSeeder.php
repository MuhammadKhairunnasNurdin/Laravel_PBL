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
            ],
            [
                'user_id'=> 8,
                'nama' => 'Wawan',
                'no_telp' => '+6282247329283'
            ],
            [
                'user_id'=> 9,
                'nama' => 'Farhan',
                'no_telp' => '+6282247173283'
            ],
            [
                'user_id'=> 10,
                'nama' => 'Nurdin',
                'no_telp' => '+6282228475283'
            ],
            [
                'user_id'=> 11,
                'nama' => 'Jaya',
                'no_telp' => '+6282285675283'
            ],
        ];

        DB::table('admins')->insert($data);
    }
}
