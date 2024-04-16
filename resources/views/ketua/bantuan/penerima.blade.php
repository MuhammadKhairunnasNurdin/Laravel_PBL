@extends('ketua.layouts.template')

@section('content')
    <div class="flex flex-col bg-white mx-5 mt-5 shadow-[0_-4px_0_0_rgba(29,78,216,1)] rounded-md">
        <div class="flex justify-between items-center w-full py-2 border-b">
            <p class="text-lg ml-10">Pilih Bayi Untuk Alternatif Penerima Bantuan Pangan</p>
            {{-- <a href="{{ url('kader/balita/tambah') }}" class="bg-blue-700 text-sm text-white font-bold py-1 px-4 mr-10 rounded">Tambah</a> --}}
        </div>
        <div class="flex mt-[30px] mx-10 gap-[30px]">
            <div class="flex w-fit h-full items-center align-middle">
                <p class="text-base text-neutral-950 text-center pr-[10px]">Filter:</p>
                <select name="filter" id="filter" class="w-100 border border-stone-400 text-sm font-normal pl-[10px] pr-28 py-[10px] rounded-[5px] focus:outline-none">
                    <option value="" class="">Semua</option>
                </select>
            </div>
            <div class="flex w-full h-full items-center align-middle">
                <p class="text-base text-neutral-950 text-center pr-[10px]">Cari:</p>
                <div class="relative flex">
                    <input type="text" class="w-100 border border-stone-400 text-sm font-normal pl-[10px] pr-28 py-[10px] rounded-[5px] focus:outline-none placeholder:text-neutral-950" id="search" name="search" placeholder="Cari di sini">           
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>                      
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-10 my-[30px]">
            <table class="border-collapse w-full rounded-t-[10px] overflow-hidden">
                <thead class="bg-gray-200 border-b text-left py-5">
                    <tr class=" text-stone-400">
                        <th class="font-normal text-sm">Nama Balita</th>
                        <th class="font-normal text-sm">Berat Badan</th>
                        <th class="font-normal text-sm">Tinggi Badan</th>
                        <th class="font-normal text-sm">Pendidikan Orang Tua</th>
                        <th class="font-normal text-sm">Pekerjaan Orang Tua</th>
                        <th class="font-normal text-sm">Penghasilan Orang Tua</th>
                        <th class="font-normal text-sm">Pilih</th>
                    </tr>
                </thead>
                <tbody class="">
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Alvino Hermawan</td>
                        <td class="font-normal text-sm">2 kg</td>
                        <td class="font-normal text-sm">75 cm</td>
                        <td class="font-normal text-sm">Sarjana</td>
                        <td class="font-normal text-sm">Pegawai Swasta</td>
                        <td class="font-normal text-sm">Rp 2.000.000,00/bulan</td>
                        <td class="font-normal text-sm">
                            <input type="checkbox" name="" id="">
                        </td>
                    </tr>
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Alvino Hermawan</td>
                        <td class="font-normal text-sm">2 kg</td>
                        <td class="font-normal text-sm">75 cm</td>
                        <td class="font-normal text-sm">Sarjana</td>
                        <td class="font-normal text-sm">Pegawai Swasta</td>
                        <td class="font-normal text-sm">Rp 2.000.000,00/bulan</td>
                        <td class="font-normal text-sm">
                            <input type="checkbox" name="" id="">
                        </td>
                    </tr>
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Alvino Hermawan</td>
                        <td class="font-normal text-sm">2 kg</td>
                        <td class="font-normal text-sm">75 cm</td>
                        <td class="font-normal text-sm">Sarjana</td>
                        <td class="font-normal text-sm">Pegawai Swasta</td>
                        <td class="font-normal text-sm">Rp 2.000.000,00/bulan</td>
                        <td class="font-normal text-sm">
                            <input type="checkbox" name="" id="">
                        </td>
                    </tr>
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Alvino Hermawan</td>
                        <td class="font-normal text-sm">2 kg</td>
                        <td class="font-normal text-sm">75 cm</td>
                        <td class="font-normal text-sm">Sarjana</td>
                        <td class="font-normal text-sm">Pegawai Swasta</td>
                        <td class="font-normal text-sm">Rp 2.000.000,00/bulan</td>
                        <td class="font-normal text-sm">
                            <input type="checkbox" name="" id="">
                        </td>
                    </tr>
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Alvino Hermawan</td>
                        <td class="font-normal text-sm">2 kg</td>
                        <td class="font-normal text-sm">75 cm</td>
                        <td class="font-normal text-sm">Sarjana</td>
                        <td class="font-normal text-sm">Pegawai Swasta</td>
                        <td class="font-normal text-sm">Rp 2.000.000,00/bulan</td>
                        <td class="font-normal text-sm">
                            <input type="checkbox" name="" id="">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('css')
<style>
    th, td {
        padding-inline: 20px;
        padding-block: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
</style>
@endpush