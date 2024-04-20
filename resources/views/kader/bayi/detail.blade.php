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
                    <td>{{ $bayiData->penduduk->nama }}</td>
                </tr>
                <tr>
                    <td>Usia</td>
                    <td>:</td>
                    <td>{{ now()->diffInMonths($bayiData->penduduk->tgl_lahir)}} bulan</td>
                </tr>
                <tr>
                    <td>Nama Ibu</td>
                    <td>:</td>
                    @foreach($parentData as $parent)
                        @if($parent->hubungan_keluarga == 'Istri')
                            <td>{{ $parent->nama }}</td>
                        @elseif($parent->hubungan_keluarga == 'Kepala Keluarga')
                            @continue
                        @else
                            <td>Tidak Ada Ibu</td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>Nama Ayah</td>
                    <td>:</td>
                    @foreach($parentData as $parent)
                        @if($parent->hubungan_keluarga == 'Kepala Keluarga')
                            <td>{{ $parent->nama }}</td>
                        @elseif($parent->hubungan_keluarga == 'Istri')
                            @continue
                        @else
                            <td>Tidak Ada Ayah</td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $bayiData->penduduk->alamat }}</td>
                </tr>
                <tr>
                    <td>Data KB</td>
                    <td>:</td>
                    <td>{{ $bayiData->pemeriksaanBayi->data_kb }}</td>
                </tr>
                <tr>
                    <td>Tanggal Kunjungan</td>
                    <td>:</td>
                    <td>{{ $bayiData->tgl_pemeriksaan }}</td>
                </tr>
                <tr>
                    <td>Berat Badan</td>
                    <td>:</td>
                    <td>{{ $bayiData->berat_badan }} kg</td>
                </tr>
                <tr>
                    <td>Tinggi Badan</td>
                    <td>:</td>
                    <td>{{ $bayiData->tinggi_badan }} cm</td>
                </tr>
                <tr>
                    <td>Lingkar Lengan</td>
                    <td>:</td>
                    <td>{{ $bayiData->pemeriksaanBayi->lingkar_lengan }} cm</td>
                </tr>
                <tr>
                    <td>Apakah Ada Kenaikan?</td>
                    <td>:</td>
                    <td>{{ $bayiData->pemeriksaanBayi->kenaikan }}</td>
                </tr>
                <tr>
                    <td>ASI Eksklusif?</td>
                    <td>:</td>
                    <td>{{ $bayiData->pemeriksaanBayi->asi }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td>{{ $bayiData->status }}</td>
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
