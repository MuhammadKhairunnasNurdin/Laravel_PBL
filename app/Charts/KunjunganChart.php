<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class KunjunganChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->addData('Pengunjung', [6, 3, 5, 5, 9, 7])
            ->setXAxis(['RT 01', 'RT 02', 'RT 03', 'RT 04', 'RT 05', 'RT 06'])
            ->setFontFamily('Plus Jakarta Sans')
            ->setHeight(200)
            ->setMarkers(['#F87171', '#3498DB'], 1, 2);
    //         ->setTitle('Sales during 2021.')
    // ->setSubtitle('Physical sales vs Digital sales.')
    // ->addData('Physical sales', [40, 93, 35, 42, 18, 82])
    // ->addData('Digital sales', [70, 29, 77, 28, 55, 45])
    // ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June'])
    // ->setGrid(false, '#3F51B5', 0.1)
    // ->setColors(['#FFC107', '#303F9F'])
    // ->setMarkers(['#FF5722', '#F87171'], 7, 10);
    }
}
