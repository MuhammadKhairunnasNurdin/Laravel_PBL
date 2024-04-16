@extends('ketua.layouts.template')

@section('content')
    <div class="flex flex-col bg-white mx-5 mt-5 shadow-[0_-4px_0_0_rgba(29,78,216,1)] rounded-md">
        <div class="flex justify-between items-center w-full py-2 border-b">
            <p class="text-lg ml-10">Daftar Penerima Bantuan Pangan</p>
            <a href="{{ url('kader/balita/tambah') }}" class="bg-blue-700 text-sm text-white font-bold py-1 px-4 mr-10 rounded">Tambah</a>
        </div>
        <div class="mx-10 my-[30px]">
            <table class="border-collapse w-full rounded-t-[10px] overflow-hidden">
                <thead class="bg-gray-200 border-b text-left py-5">
                    <tr class=" text-stone-400">
                        <th class="font-normal text-sm">Nama Balita</th>
                        <th class="font-normal text-sm">Nama Ibu</th>
                        <th class="font-normal text-sm">Nama Ayah</th>
                        <th class="font-normal text-sm">Periode Bantuan</th>
                        <th class="font-normal text-sm">Jenis Bantuan</th>
                        <th class="font-normal text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="">
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Alvino Hermawan</td>
                        <td class="font-normal text-sm">Indah Bakti</td>
                        <td class="font-normal text-sm">Suryo Abadi</td>
                        <td class="font-normal text-sm">1</td>
                        <td class="font-normal text-sm">Bantuan Pangan</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600">Detail</a>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Alvino Hermawan</td>
                        <td class="font-normal text-sm">Indah Bakti</td>
                        <td class="font-normal text-sm">Suryo Abadi</td>
                        <td class="font-normal text-sm">1</td>
                        <td class="font-normal text-sm">Bantuan Pangan</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600">Detail</a>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Alvino Hermawan</td>
                        <td class="font-normal text-sm">Indah Bakti</td>
                        <td class="font-normal text-sm">Suryo Abadi</td>
                        <td class="font-normal text-sm">1</td>
                        <td class="font-normal text-sm">Bantuan Pangan</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600">Detail</a>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Alvino Hermawan</td>
                        <td class="font-normal text-sm">Indah Bakti</td>
                        <td class="font-normal text-sm">Suryo Abadi</td>
                        <td class="font-normal text-sm">1</td>
                        <td class="font-normal text-sm">Bantuan Pangan</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600">Detail</a>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Alvino Hermawan</td>
                        <td class="font-normal text-sm">Indah Bakti</td>
                        <td class="font-normal text-sm">Suryo Abadi</td>
                        <td class="font-normal text-sm">1</td>
                        <td class="font-normal text-sm">Bantuan Pangan</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600">Detail</a>
                            </div>
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