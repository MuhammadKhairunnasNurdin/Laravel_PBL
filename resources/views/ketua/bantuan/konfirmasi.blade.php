@extends('ketua.layouts.template')

@section('content')
    <div class="flex flex-col bg-white mx-5 mt-5 shadow-[0_-4px_0_0_rgba(29,78,216,1)] rounded-md">
        <div class="flex justify-between items-center w-full py-2 border-b">
            <p class="text-lg ml-10">Konfirmasi Penerima</p>
        </div>
        <div class="mx-10 my-[30px]">
            <table class="border-collapse w-full rounded-t-[10px] overflow-hidden">
                <thead class="bg-gray-200 border-b text-left py-5">
                    <th class="font-normal text-sm">Nama Balita</th>
                    <th class="font-normal text-sm">Berat Badan</th>
                    <th class="font-normal text-sm">Tinggi Badan</th>
                    <th class="font-normal text-sm">Lingkar Kepala</th>
                    <th class="font-normal text-sm">Lingkar Lengan</th>
                    <th class="font-normal text-sm">Penghasilan Orang Tua</th>
                </tr>
            </thead>
            <tbody class="">
                @for ($i = 0; $i < count($values); $i++)
                <tr class="text-neutral-950 text-left">
                    <td class="font-normal text-sm">
                        @foreach ($bayis as $bayi)
                            @if ($bayi->penduduk_id == $countBayi[$i])
                                {{$bayi->nama}}
                                @continue
                            @endif    
                        @endforeach    
                    </td>
                    
                    @for ($j = 0; $j < count($values[$i]); $j++)
                    <td class="font-normal text-sm">{{$values[$i][$j]}}</td>
                    @endfor
                </tr>    
                @endfor
            </tbody>
        </table>
    </div>
    <div class="flex justify-between items-center w-full py-2 border-b">
        <p class="text-lg ml-10">Hasil Perhitungan SAW</p>
    </div>
    <div class="mx-10 my-[30px]">
            <table class="border-collapse w-full rounded-t-[10px] overflow-hidden">
                <thead class="bg-gray-200 border-b text-left py-5">
                    <th class="font-normal text-sm">Nama Balita</th>
                    <th class="font-normal text-sm">Hasil Perhitungan</th>
                    </tr>
                </thead>
                <tbody class="">
                    @for ($i = 0; $i < count($bayiSAW); $i++)
                        <tr class="text-neutral-950 text-left">
                            <td class="font-normal text-sm">
                                @foreach ($bayis as $bayi)
                                    @if ($bayi->penduduk_id == $countBayi[$i])
                                        {{$bayi->nama}}
                                        @continue
                                    @endif    
                                @endforeach
                            </td>
                            <td class="font-normal text-sm">{{number_format($bayiSAW[$i], 3)}}</td>
                        </tr>    
                    @endfor
                    </tbody>
            </table>
        </div>
    <div class="flex justify-between items-center w-full py-2 border-b">
        <p class="text-lg ml-10">Hasil Perhitungan Mabac</p>
    </div>
    <div class="mx-10 my-[30px]">
            <table class="border-collapse w-full rounded-t-[10px] overflow-hidden">
                <thead class="bg-gray-200 border-b text-left py-5">
                    <th class="font-normal text-sm">Nama Balita</th>
                    <th class="font-normal text-sm">Hasil Perhitungan</th>
                    </tr>
                </thead>
                <tbody class="">
                    @for ($i = 0; $i < count($bayiMabac); $i++)
                        <tr class="text-neutral-950 text-left">
                            <td class="font-normal text-sm">
                                @foreach ($bayis as $bayi)
                                    @if ($bayi->penduduk_id == $countBayi[$i])
                                        {{$bayi->nama}}
                                        @continue
                                    @endif    
                                @endforeach
                            </td>
                            <td class="font-normal text-sm">{{number_format($bayiMabac[$i], 3)}}</td>
                        </tr>    
                    @endfor
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
