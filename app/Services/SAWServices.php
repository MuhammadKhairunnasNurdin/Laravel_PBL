<?php

namespace App\Services;

use App\Models\Penduduk;
use App\Models\RentangKriteria;

class SAWServices
{
    public function createValue($alternatif, $countBayi)
    {
        $ranges = RentangKriteria::all();
        $values = [];

        foreach ($countBayi as $index => $bayiId) {
            $alt = $alternatif->firstWhere('penduduk_id', $bayiId);

            if ($alt) {
                $parents = Penduduk::where('NKK', $alt->NKK)
                    ->where('hubungan_keluarga', '!=', 'Anak')
                    ->get();

                $incomeDad = $parents->where('hubungan_keluarga', 'Kepala Keluarga')
                    ->first()
                    ->pendapatan ?? 0;

                $incomeMom = $parents->where('hubungan_keluarga', 'Istri')
                    ->first()
                    ->pendapatan ?? 0;

                $incomeDad = (float) str_replace(['Rp', '.'], '', explode(' - ', $incomeDad)[0]);
                $incomeMom = (float) str_replace(['Rp', '.'], '', explode(' - ', $incomeMom)[0]);
                
                $sumIncome = $incomeDad + $incomeMom;

                $values[$index] = [
                    $this->getRangeValue($ranges, 'C1', $alt->berat_badan),
                    $this->getRangeValue($ranges, 'C2', $alt->tinggi_badan),
                    $this->getRangeValue($ranges, 'C3', $alt->lingkar_kepala),
                    $this->getRangeValue($ranges, 'C4', $alt->lingkar_lengan),
                    $this->getRangeValue($ranges, 'C5', $sumIncome),
                ];
            }
        }
        return $values;
    }
    private function getRangeValue($ranges, $code, $value)
    {
        $range = $ranges->first(function ($range) use ($code, $value) {
            return $range->kode === $code && $value >= $range->rentang_min && $value <= $range->rentang_max;
        });
        return $range ? $range->nilai : null;
    }
    public function maxMin($value, $kriteria)
    {
        $maxMin = [];
        for ($i = 0; $i < count($kriteria); $i++) {
            $arrayNilai = array_column($value, $i);
            $maxMin[$i][0] = max($arrayNilai);
            $maxMin[$i][1] = min($arrayNilai);
        }
        return $maxMin;
    }

    public function normalizedSaw($value, $maxMin, $kriteria)
    {
        $normalizedMatrix = [];
        for ($i = 0; $i < count($value); $i++) {
            for ($j = 0; $j < count($kriteria); $j++) {
                if ($kriteria[$j]['jenis'] === 'benefit') {
                    $normalizedMatrix[$i][$j] = round($value[$i][$j] / $maxMin[$j][0], 3);
                }
                if ($kriteria[$j]['jenis'] === 'cost') {
                    $normalizedMatrix[$i][$j] = round($maxMin[$j][1] / $value[$i][$j], 3);
                }
            }
        }
        return $normalizedMatrix;
    }
    public function optimalizedSaw($value, $normalizedMatrix, $kriteria)
    {
        $matriksR = [];
        for ($i = 0; $i < count($value); $i++) {
            for ($j = 0; $j < count($kriteria); $j++) {
                $matriksR[$i][$j] = round($normalizedMatrix[$i][$j] * $kriteria[$j]['bobot'], 3);
            }
        }
        return $matriksR;
    }
    public function rankSaw($value, $matriksR, $kriteria)
    {
        $rangking = [];
        $sum = 0;
        for ($i = 0; $i < count($value); $i++) {
            $sum = 0;
            for ($j = 0; $j < count($kriteria); $j++) {
                $sum += $matriksR[$i][$j];
            }
            $rangking[$i] = round($sum, 3);
        }
        return $rangking;
    }
}