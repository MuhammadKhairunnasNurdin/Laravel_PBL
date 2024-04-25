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
            ],[
                'pemeriksaan_id'=> 4,
                'lingkar_perut' => 11.3,
                'gula_darah' => 145,
                'kolesterol' => 160,
                'tensi_darah' => 132,
                'asam_urat' => 3.2
            ],[
                'pemeriksaan_id'=> 5,
                'lingkar_perut' => 11.3,
                'gula_darah' => 145,
                'kolesterol' => 160,
                'tensi_darah' => 132,
                'asam_urat' => 3.2
            ],
        ];

        DB::table('pemeriksaan_lansias')->insert($data);
    }
}
