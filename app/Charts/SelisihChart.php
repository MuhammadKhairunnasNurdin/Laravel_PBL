<?php


namespace App\Charts;

use App\Models\Pemeriksaan;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use ArielMejiaDev\LarapexCharts\LineChart;
use Carbon\Carbon;

class SelisihChart
{
    public function __construct(
        protected LarapexChart $chart
    )
    {
    }

    public function build(string $id): LineChart
    {
        $Kriteria = Pemeriksaan::with('pemeriksaan_bayi')
        ->where('penduduk_id',$id)
        ->get();

        $databulan = [];
        $datatotalKriteria = [];

        foreach ($Kriteria as $data) {
            $datatotalKriteria[] = [
                'Berat Badan' => $data->berat_badan,
                'Tinggi Badan' => $data->tinggi_badan,
                'Lingkar Lengan' => $data->pemeriksaan_bayi->lingkar_lengan,
                'Lingkar Kepala' => $data->pemeriksaan_bayi->lingkar_kepala,
            ];
            $tgl_pemeriksaan = Carbon::parse($data->tgl_pemeriksaan);
            $databulan[] = $tgl_pemeriksaan->locale('id')->translatedFormat('F Y');
        }

        return $this->chart->lineChart()
        ->setTitle('Kontrol Data Perkembangan Bayi')
        ->addData('Berat Badan', array_column($datatotalKriteria, 'Berat Badan'))
        ->addData('Tinggi Badan', array_column($datatotalKriteria, 'Tinggi Badan'))
        ->addData('Lingkar Lengan', array_column($datatotalKriteria, 'Lingkar Lengan'))
        ->addData('Lingkar Kepala', array_column($datatotalKriteria, 'Lingkar Kepala'))
        ->setXAxis($databulan);
    }

}
