<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RekamMedisIbuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'ibu_id' => 6,
                'anak_id' => 7,
                'data_kb' => 'PIL',
            ],
            [
                'ibu_id' => 6,
                'anak_id' => 8,
                'data_kb' => 'Kondom',
            ],
            [
                'ibu_id' => 12,
                'anak_id' => 13,
                'data_kb' => 'Suntik',
            ],
            [
                'ibu_id' => 14,
                'anak_id' => 15,
                'data_kb' => 'Suplemen',
            ],
        ];

        DB::table('rekam_medis_ibus')->insert($data);
    }
}
