@extends('admin.layouts.template')

@section('content')
<div class="grid mx-5 mt-5 md:mb-5 gap-5 md:grid-cols-3">
    @php
        $golongan = ['Lansia', 'Bayi'];
    @endphp
    @for($i = 0; $i < 1; $i++)
    {{-- Card Total Penduduk --}}
        <div class="flex flex-col bg-white rounded-2xl pr-6 pl-7 gap-9">
            <div class="flex w-full justify-between pt-5">
                <p class="font-medium text-sm lg:text-base">Total Penduduk</p>
            </div>
            <h1 class="text-5xl font-medium">{{ $data['penduduk_all'][$i]->total ?? 0}}</h1>
            <p class="text-xs text-stone-400 pb-4">Seluruhnya</p>
        </div>
    {{-- End Card Total --}}

    {{-- Card Jumlah Laki-Laki --}}
        <div class="flex flex-col bg-white rounded-2xl pr-6 pl-7 gap-9">
            <div class="flex w-full justify-between pt-5">
                <p class="font-medium text-sm lg:text-base">Jumlah Penduduk Laki-Laki</p>
            </div>
            <h1 class="text-5xl font-medium">{{ $data['penduduk_laki'][$i]->total ?? 0}}</h1>
            <p class="text-xs text-stone-400 pb-4">Seluruhnya</p>
        </div>
    {{-- End Card Laki-Laki --}}

    {{-- Card Jumlah Perempuan --}}
        <div class="flex flex-col bg-white rounded-2xl pr-6 pl-7 gap-9">
            <div class="flex w-full justify-between pt-5">
                <p class="font-medium text-sm lg:text-base">Jumlah Penduduk Perempuan</p>
            </div>
            {{-- {{ !empty($data['status'][$i]) ? $data['status'][$i]->total : 0}} --}}
            {{-- this bellow code same above code--}}
            <h1 class="text-5xl font-medium">{{ $data['penduduk_perempuan'][$i]->total ?? 0}}</h1>
            <p class="text-xs text-stone-400 pb-4">Seluruhnya</p>
        </div>
    {{-- End Card Perempuan --}}
    @endfor
</div>
<div class="grid grid-cols-3 mx-5 mt-5 mb-10 gap-5">

    {{-- Card Kunjungan Anggota --}}
    <div class="flex flex-col col-span-3 md:col-span-1 w-full bg-white rounded-2xl pr-6 pl-7 md:mb-10 gap-9">
        <div class="flex w-full justify-between pt-5">
            <p class="font-medium text-sm lg:text-base">Kunjungan Anggota</p>
        </div>
        <div class="z-10">
            {!! $chart->container() !!}
        </div>
    </div>

    {{-- Card Agenda Posyandu --}}
    <div class="flex flex-col col-span-3 md:col-span-2 w-full bg-white rounded-2xl pr-6 pl-7 pb-9 gap-5 overflow-x-scroll">
        <div class="flex w-full justify-between pt-6 align-middle">
            <p class="font-medium md:text-xl">Agenda Posyandu</p>
            <div class="flex gap-4">
                <div class="relative flex">
                    <input type="text" class="text-xs md:pl-5 md:pr-4 md:py-2 border rounded-3xl focus:outline-none" id="search" name="search" placeholder="Cari Kegiatan">
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <table class="border-collapse w-full rounded-t-[10px] overflow-hidden">
            <thead class="bg-gray-200 border-b text-left py-5">
                <tr class=" text-stone-400">
                    <th class="font-normal text-xs md:text-sm">Nama Kegiatan</th>
                    <th class="font-normal text-xs md:text-sm">Tanggal</th>
                    <th class="font-normal text-xs md:text-sm">Pukul</th>
                    <th class="font-normal text-xs md:text-sm">Tempat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['kegiatan'] as $item)
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-xs md:text-sm">{{ $item->nama }}</td>
                        <td class="font-normal text-xs md:text-sm">{{ date('d-M-Y', strtotime($item->tgl_kegiatan)) }}</td>
                        <td class="font-normal text-xs md:text-sm">{{ date('H:i', strtotime($item->jam_mulai)) }} - Selesai</td>
                        <td class="font-normal text-xs md:text-sm">{{ $item->tempat }}</td>
                    </tr>
                @endforeach
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

@push('js')
<script src="{{ $chart->cdn() }}"></script>
{{$chart->script() }}

@endpush
