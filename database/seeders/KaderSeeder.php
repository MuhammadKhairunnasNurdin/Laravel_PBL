<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id'=> 2,
                'penduduk_id' => 1,
            ],
            [
                'user_id'=> 3,
                'penduduk_id' => 4,
            ],
        ];

        DB::table('kaders')->insert($data);
    }
}
