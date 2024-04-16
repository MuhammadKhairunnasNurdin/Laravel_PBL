<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PemeriksaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kader_id'=> 2,
                'NIK' => 351001150819720011,
                'tgl_pemeriksaan' => '2024-04-15',
                'golongan' => 'lansia',
                'berat_badan' => 65.2,
                'tinggi_badan' => 168.0,
                'status' => 'sehat',
                'respon' => 'Posyandu Bagus'
            ], [
                'kader_id'=> 2,
                'NIK' => 351001150820240011,
                'tgl_pemeriksaan' => '2024-04-15',
                'golongan' => 'bayi',
                'berat_badan' => 3.5,
                'tinggi_badan' => 50.0,
                'status' => 'sehat',
                'respon' => 'Posyandu Bagus'
            ], [
                'kader_id'=> 2,
                'NIK' => 351001100220220011,
                'tgl_pemeriksaan' => '2024-04-15',
                'golongan' => 'bayi',
                'berat_badan' => 9.5,
                'tinggi_badan' => 10.2,
                'status' => 'sehat',
                'respon' => 'Posyandu Bagus'
            ],
        ];

        DB::table('pemeriksaans')->insert($data);
    }
}
