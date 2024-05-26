@extends('admin.layouts.template')

@section('content')
    <div class="flex flex-col bg-white mx-5 mt-5 shadow-[0_-4px_0_0_rgba(29,78,216,1)] rounded-md">
        <form action="{{route('bantuan.saw')}}" method="post">
            @csrf
            <div class="flex justify-between items-center w-full py-2 border-b">
                @foreach ($countBayi as $bayi)
                    <input type="hidden" name="penduduk_id[]" value="{{$bayi}}">
                @endforeach
                <p class="text-lg ml-10">Perhitungan Dengan Metode Mabac</p>
                <button type="submit" class="bg-blue-700 text-sm text-white font-bold py-2 px-4 mr-5 md:mr-10 rounded">SAW</button>
            </div>
        </form>
        {{-- Matriks Keputusan Awal --}}
        <div class="mx-10 my-[30px]">
            <table class="border-collapse w-full rounded-t-[10px] overflow-hidden">
                <thead class="bg-gray-200 border-b text-left py-5">
                        <th class="font-normal text-sm">Alternatif</th>
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
                        <td class="font-normal text-sm">A{{$i+1}}</td>
                        @for ($j = 0; $j < count($values[$i]); $j++)
                            <td class="font-normal text-sm">{{$values[$i][$j]}}</td>
                        @endfor
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tabel Max Min --}}
    <div class="flex flex-col bg-white mx-5 mt-5 shadow-[0_-4px_0_0_rgba(29,78,216,1)] rounded-md">
        <div class="flex justify-between items-center w-full py-2 border-b">
            <p class="text-lg ml-10">Tabel Max Min</p>
        </div>
        <div class="mx-10 my-[30px]">
            <table class="border-collapse w-full rounded-t-[10px] overflow-hidden">
                <thead class="bg-gray-200 border-b text-left py-5">
                    <tr class=" text-stone-400">
                        <th class="font-normal text-sm">Kriteria</th>
                        <th class="font-normal text-sm">Max</th>
                        <th class="font-normal text-sm">Min</th>
                    </tr>
                </thead>
                <tbody class="">
                    @for ($i = 0; $i < count($maxMin); $i++)
                        <tr class="text-neutral-950 text-left">
                            <td class="font-normal text-sm">{{$kriteria[$i]['nama']}}</td>
                            @for ($j = 0; $j < count($maxMin[$i]); $j++)
                                <td class="font-normal text-sm">{{$maxMin[$i][$j]}}</td>
                            @endfor
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
    
    {{-- Matriks Normalisasi --}}
    <div class="flex flex-col bg-white mx-5 mt-5 shadow-[0_-4px_0_0_rgba(29,78,216,1)] rounded-md">
        <div class="flex justify-between items-center w-full py-2 border-b">
            <p class="text-lg ml-10">Matriks Normalisasi</p>
        </div>
        <div class="mx-10 my-[30px]">
            <table class="border-collapse w-full rounded-t-[10px] overflow-hidden">
                <thead class="bg-gray-200 border-b text-left py-5">
                    <tr class=" text-stone-400">
                        <th class="font-normal text-sm">Alternatif</th>
                        <th class="font-normal text-sm">Berat Badan</th>
                        <th class="font-normal text-sm">Tinggi Badan</th>
                        <th class="font-normal text-sm">Lingkar Kepala</th>
                        <th class="font-normal text-sm">Lingkar Lengan</th>
                        <th class="font-normal text-sm">Penghasilan Orang Tua</th>
                    </tr>
                </thead>
                <tbody class="">
                    @for ($i = 0; $i < count($normalize); $i++)
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">A{{$i+1}}</td>
                        @for ($j = 0; $j < count($normalize[$i]); $j++)
                            <td class="font-normal text-sm">{{number_format($normalize[$i][$j], 3)}}</td>
                        @endfor
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
    
    {{-- Matriks Tertimbang --}}
    <div class="flex flex-col bg-white mx-5 mt-5 shadow-[0_-4px_0_0_rgba(29,78,216,1)] rounded-md">
        <div class="flex justify-between items-center w-full py-2 border-b">
            <p class="text-lg ml-10">Matriks Optimalisasi</p>
        </div>
        <div class="mx-10 my-[30px]">
            <table class="border-collapse w-full rounded-t-[10px] overflow-hidden">
                <thead class="bg-gray-200 border-b text-left py-5">
                    <tr class=" text-stone-400">
                        <th class="font-normal text-sm">Alternatif</th>
                        <th class="font-normal text-sm">Berat Badan</th>
                        <th class="font-normal text-sm">Tinggi Badan</th>
                        <th class="font-normal text-sm">Lingkar Kepala</th>
                        <th class="font-normal text-sm">Lingkar Lengan</th>
                        <th class="font-normal text-sm">Penghasilan Orang Tua</th>
                    </tr>
                </thead>
                <tbody class="">
                    @for ($i = 0; $i < count($weighted); $i++)
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">A{{$i+1}}</td>
                            @for ($j = 0; $j < count($weighted[$i]); $j++)
                                <td class="font-normal text-sm">{{number_format($weighted[$i][$j], 3)}}</td>
                            @endfor
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>

    {{-- Matriks Area --}}
    <div class="flex flex-col bg-white mx-5 mt-5 shadow-[0_-4px_0_0_rgba(29,78,216,1)] rounded-md">
        <div class="flex justify-between items-center w-full py-2 border-b">
            <p class="text-lg ml-10">Matriks Area</p>
        </div>
        <div class="mx-10 my-[30px]">
            <table class="border-collapse w-full rounded-t-[10px] overflow-hidden">
                <thead class="bg-gray-200 border-b text-left py-5">
                    <tr class=" text-stone-400">
                        <th class="font-normal text-sm">Alternatif</th>
                        <th class="font-normal text-sm">Berat Badan</th>
                        <th class="font-normal text-sm">Tinggi Badan</th>
                        <th class="font-normal text-sm">Lingkar Kepala</th>
                        <th class="font-normal text-sm">Lingkar Lengan</th>
                        <th class="font-normal text-sm">Penghasilan Orang Tua</th>
                    </tr>
                </thead>
                <tbody class="">
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">G</td>
                        @foreach ($areas as $area)
                            <td class="font-normal text-sm">{{number_format($area, 3)}}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Matriks Jarak --}}
    <div class="flex flex-col bg-white mx-5 mt-5 shadow-[0_-4px_0_0_rgba(29,78,216,1)] rounded-md">
        <div class="flex justify-between items-center w-full py-2 border-b">
            <p class="text-lg ml-10">Matriks Jarak</p>
        </div>
        <div class="mx-10 my-[30px]">
            <table class="border-collapse w-full rounded-t-[10px] overflow-hidden">
                <thead class="bg-gray-200 border-b text-left py-5">
                    <tr class=" text-stone-400">
                        <th class="font-normal text-sm">Alternatif</th>
                        <th class="font-normal text-sm">Berat Badan</th>
                        <th class="font-normal text-sm">Tinggi Badan</th>
                        <th class="font-normal text-sm">Lingkar Kepala</th>
                        <th class="font-normal text-sm">Lingkar Lengan</th>
                        <th class="font-normal text-sm">Penghasilan Orang Tua</th>
                    </tr>
                </thead>
                <tbody class="">
                    @for ($i = 0; $i < count($distance); $i++)
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">A{{$i+1}}</td>
                            @for ($j = 0; $j < count($distance[$i]); $j++)
                                <td class="font-normal text-sm">{{number_format($distance[$i][$j], 3)}}</td>
                            @endfor
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
    
    {{-- Matriks Rangking --}}
    <div class="flex flex-col bg-white mx-5 mt-5 shadow-[0_-4px_0_0_rgba(29,78,216,1)] rounded-md">
        <div class="flex justify-between items-center w-full py-2 border-b">
            <p class="text-lg ml-10">Tabel Rangking</p>
        </div>
        <div class="mx-10 my-[30px]">
            <table class="border-collapse w-full rounded-t-[10px] overflow-hidden">
                <thead class="bg-gray-200 border-b text-left py-5">
                    <tr class=" text-stone-400">
                        <th class="font-normal text-sm">Alternatif</th>
                        <th class="font-normal text-sm">Hasil Perhitungan</th>
                    </tr>
                </thead>
                <tbody class="">
                    @for ($i = 0; $i < count($rank); $i++)
                        <tr class="text-neutral-950 text-left">
                            <td class="font-normal text-sm">A{{$i+1}}</td>
                            <td class="font-normal text-sm">{{number_format($rank[$i], 3)}}</td>
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
