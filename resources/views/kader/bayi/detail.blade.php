@extends('kader.layouts.template')

@section('content')
<div class="flex flex-col bg-white mx-5 my-5 shadow-[0_-4px_0_0_rgba(248,113,113,1)] rounded-md">
    <div class="flex justify-between items-center w-full py-2 border-b">
        <p class="text-lg ml-10">Detail Bayi</p>
    </div>
    <div class="flex flex-col gap-[15px] py-10 px-[30px]">
        <table class="w-fit">
            <tbody>
                <tr>
                    <td>Nama Bayi</td>
                    <td>:</td>
                    <td>Alvino Hendrawan</td>
                </tr>
                <tr>
                    <td>Usia</td>
                    <td>:</td>
                    <td>14 Bulan</td>
                </tr>
                <tr>
                    <td>Nama Ibu</td>
                    <td>:</td>
                    <td>Indah Bakti</td>
                </tr>
                <tr>
                    <td>Nama Ayah</td>
                    <td>:</td>
                    <td>Suryo Abdi</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>Jl. Kalimosodo 12 No.6</td>
                </tr>
                <tr>
                    <td>Data KB</td>
                    <td>:</td>
                    <td>Kondom</td>
                </tr>
                <tr>
                    <td>Tanggal Kunjungan</td>
                    <td>:</td>
                    <td>17 April 2024</td>
                </tr>
                <tr>
                    <td>Berat Badan</td>
                    <td>:</td>
                    <td>5 kg</td>
                </tr>
                <tr>
                    <td>Tinggi Badan</td>
                    <td>:</td>
                    <td>70 cm</td>
                </tr>
                <tr>
                    <td>Lingkar Lengan</td>
                    <td>:</td>
                    <td>5 cm</td>
                </tr>
                <tr>
                    <td>Apakah Ada Kenaikan?</td>
                    <td>:</td>
                    <td>Ya</td>
                </tr>
                <tr>
                    <td>ASI Eksklusif?</td>
                    <td>:</td>
                    <td>Ya</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td>Sehat</td>
                </tr>
            </tbody>
        </table>
        <div class="flex justify-end">
            <a href="{{ url('kader/bayi')}}" class="bg-gray-300 text-neutral-950 font-bold text-base py-[5px] px-[19px] rounded-[5px]">Kembali</a>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    td{
        padding-inline: 10px;
        padding-block: 8px;
    }
</style>
@endpush
