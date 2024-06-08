<?php


namespace App\Charts;

use App\Models\Pemeriksaan;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\AuditBulananBayi;

class SelisihChart
{
    protected LarapexChart $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(string $id): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $Kriteria = AuditBulananBayi::
        join('pemeriksaans', 'audit_bulanan_bayis.bulan_id', '=', 'pemeriksaans.pemeriksaan_id')
        ->select('audit_bulanan_bayis.*', 'pemeriksaans.tgl_pemeriksaan', 'pemeriksaans.golongan')
        ->where('audit_bulanan_bayis.penduduk_id',$id)
        ->get();

        $databulan = [];
        $datatotalKriteria = [];

        foreach ($Kriteria as $data) {
            $datatotalKriteria[] = [
                'Berat Badan' => $data->berat_badan,
                'Tinggi Badan' => $data->tinggi_badan,
                'Lingkar Lengan' => $data->lingkar_lengan,
                'Lingkar Kepala' => $data->lingkar_kepala,
            ];
            $tgl_pemeriksaan = \Carbon\Carbon::parse($data->tgl_pemeriksaan);
            $databulan[] = $tgl_pemeriksaan->format('M Y');
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
