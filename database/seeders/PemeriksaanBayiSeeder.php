<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PemeriksaanBayiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'pemeriksaan_id'=> 2,
                'lingkar_kepala' => 13.3,
                'lingkar_lengan' => 5.1,
                'asi' => 'iya',
                'kenaikan' => 'iya',
            ], [
                'pemeriksaan_id'=> 3,
                'lingkar_kepala' => 16.3,
                'lingkar_lengan' => 6.5,
                'asi' => 'iya',
                'kenaikan' => 'iya',
            ],[
                'pemeriksaan_id'=> 5,
                'lingkar_kepala' => 17.3,
                'lingkar_lengan' => 7.3,
                'asi' => 'tidak',
                'kenaikan' => 'tidak',
            ],[
                'pemeriksaan_id'=> 6,
                'lingkar_kepala' => 20.3,
                'lingkar_lengan' => 9.3,
                'asi' => 'tidak',
                'kenaikan' => 'tidak',
            ],
        ];

        DB::table('pemeriksaan_bayis')->insert($data);
    }
}
