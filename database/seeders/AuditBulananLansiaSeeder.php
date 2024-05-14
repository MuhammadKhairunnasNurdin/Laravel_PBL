<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuditBulananLansiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penduduk_id' => 10,
                'berat_badan' => 2.9,
                'tinggi_badan' => 0.3,
                'lingkar_perut' => 2.2,
                'gula_darah' => -5,
                'kolesterol' => 3,
                'tensi_darah' => 3,
                'asam_urat' => 1.5,
            ]
        ];

        DB::table('audit_bulanan_lansias')->insert($data);
    }
}
