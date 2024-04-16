<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PemeriksaanLansiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'pemeriksaan_id'=> 1,
                'lingkar_perut' => 13.3,
                'gula_darah' => 140,
                'kolesterol' => 180,
                'tensi_darah' => 129,
                'asam_urat' => 4.2
            ],
        ];

        DB::table('pemeriksaan_lansias')->insert($data);
    }
}
