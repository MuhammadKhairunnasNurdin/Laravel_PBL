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
                'kader_id' => 2,
                'penduduk_id' => 7,
                'tgl_pemeriksaan' => '2024-04-15',
                'golongan' => 'bayi',
                'berat_badan' => 13.2,
                'tinggi_badan' => 68.0,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 7,
                'tgl_pemeriksaan' => '2024-05-15',
                'golongan' => 'bayi',
                'berat_badan' => 15.5,
                'tinggi_badan' => 69.3,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 8,
                'tgl_pemeriksaan' => '2024-04-15',
                'golongan' => 'bayi',
                'berat_badan' => 9.5,
                'tinggi_badan' => 42.2,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 8,
                'tgl_pemeriksaan' => '2024-05-15',
                'golongan' => 'bayi',
                'berat_badan' => 10.7,
                'tinggi_badan' => 42.7,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 13,
                'tgl_pemeriksaan' => '2024-04-15',
                'golongan' => 'bayi',
                'berat_badan' => 13.7,
                'tinggi_badan' => 66.0,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 13,
                'tgl_pemeriksaan' => '2024-05-15',
                'golongan' => 'bayi',
                'berat_badan' => 14.4,
                'tinggi_badan' => 66.8,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 15,
                'tgl_pemeriksaan' => '2024-04-15',
                'golongan' => 'bayi',
                'berat_badan' => 27.4,
                'tinggi_badan' => 73.0,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 15,
                'tgl_pemeriksaan' => '2024-05-15',
                'golongan' => 'bayi',
                'berat_badan' => 28.1,
                'tinggi_badan' => 74.5,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 18,
                'tgl_pemeriksaan' => '2024-04-15',
                'golongan' => 'bayi',
                'berat_badan' => 25.4,
                'tinggi_badan' => 68.5,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 18,
                'tgl_pemeriksaan' => '2024-05-15',
                'golongan' => 'bayi',
                'berat_badan' => 26.0,
                'tinggi_badan' => 69.2,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 19,
                'tgl_pemeriksaan' => '2024-03-15',
                'golongan' => 'bayi',
                'berat_badan' => 13.4,
                'tinggi_badan' => 68.5,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 19,
                'tgl_pemeriksaan' => '2024-04-15',
                'golongan' => 'bayi',
                'berat_badan' => 14.1,
                'tinggi_badan' => 69.2,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 19,
                'tgl_pemeriksaan' => '2024-05-15',
                'golongan' => 'bayi',
                'berat_badan' => 15.8,
                'tinggi_badan' => 70.5,
                'status' => 'sehat',
            ], [ // lansia
                'kader_id' => 2,
                'penduduk_id' => 9,
                'tgl_pemeriksaan' => '2024-04-15',
                'golongan' => 'lansia',
                'berat_badan' => 65.8,
                'tinggi_badan' => 166.5,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 9,
                'tgl_pemeriksaan' => '2024-05-15',
                'golongan' => 'lansia',
                'berat_badan' => 68.1,
                'tinggi_badan' => 166.8,
                'status' => 'sehat',
            ], [ 
                'kader_id' => 2,
                'penduduk_id' => 10,
                'tgl_pemeriksaan' => '2024-04-15',
                'golongan' => 'lansia',
                'berat_badan' => 59.5,
                'tinggi_badan' => 165.2,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 10,
                'tgl_pemeriksaan' => '2024-05-15',
                'golongan' => 'lansia',
                'berat_badan' => 60.1,
                'tinggi_badan' => 165.8,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 20,
                'tgl_pemeriksaan' => '2024-04-15',
                'golongan' => 'lansia',
                'berat_badan' => 61.1,
                'tinggi_badan' => 162.2,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 20,
                'tgl_pemeriksaan' => '2024-05-15',
                'golongan' => 'lansia',
                'berat_badan' => 62.4,
                'tinggi_badan' => 162.8,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 21,
                'tgl_pemeriksaan' => '2024-04-15',
                'golongan' => 'lansia',
                'berat_badan' => 57.1,
                'tinggi_badan' => 160.2,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 21,
                'tgl_pemeriksaan' => '2024-05-15',
                'golongan' => 'lansia',
                'berat_badan' => 58.4,
                'tinggi_badan' => 160.5,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 22,
                'tgl_pemeriksaan' => '2024-03-15',
                'golongan' => 'lansia',
                'berat_badan' => 61.7,
                'tinggi_badan' => 160.7,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 22,
                'tgl_pemeriksaan' => '2024-04-15',
                'golongan' => 'lansia',
                'berat_badan' => 62.4,
                'tinggi_badan' => 161.1,
                'status' => 'sehat',
            ], [
                'kader_id' => 2,
                'penduduk_id' => 22,
                'tgl_pemeriksaan' => '2024-05-15',
                'golongan' => 'lansia',
                'berat_badan' => 62.6,
                'tinggi_badan' => 161.4,
                'status' => 'sehat',
            ], 
        ];

        DB::table('pemeriksaans')->insert($data);
    }
}
