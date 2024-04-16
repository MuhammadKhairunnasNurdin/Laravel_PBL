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
                'NIK' => 351008251219950011,
            ],
            [
                'user_id'=> 3,
                'NIK' => 351001200819980752,
            ],
        ];

        DB::table('kaders')->insert($data);
    }
}
