@extends('kader.layouts.template')

@section('content')
    <form action="{{url('kader/bayi/' . $bayiData->pemeriksaan_id)}}" method="post">
        @csrf
        <!--add 'PUT' method, because we use Route::put() for update-->
        {!! method_field('PUT') !!}

        <input type="hidden" name="pemeriksaan_bayi" value="{{$bayiData->pemeriksaan_bayi}}">
        <input type="hidden" name="pemeriksaan" value="{{ json_encode([
            'tgl_pemeriksaan' => $bayiData->tgl_pemeriksaan,
            'golongan' => $bayiData->golongan,
            'kader_id' => $bayiData->kader_id,
            'berat_badan' => $bayiData->berat_badan,
            'tinggi_badan' => $bayiData->tinggi_badan,
            'status' => $bayiData->status,
            'respon' => $bayiData->respon
            ])
        }}">

        <div class="flex flex-col bg-white mx-5 my-5 shadow-[0_-4px_0_0_rgba(248,113,113,1)] rounded-md">
            <div class="flex justify-between items-center w-full py-2 border-b">
                <p class="text-lg mx-10">Ubah Pemeriksaan Bayi</p>
            </div>
            <div class="grid md:grid-cols-2 my-[30px] mx-10 gap-x-[101px]">
                <div class="md:col-span-1 flex flex-col gap-[23px]">
                    <div class="flex flex-col w-full h-fill gap-[20px]" id="page_1">
                        <p class="text-base text-neutral-950">Nama Bayi<span class="text-red-400"></span></p>
                        <input name="nama" id="filter" class="w-100 border text-neutral-950 border-none text-base font-normal pl-[10px] py-[10px] rounded-[5px] focus:outline-none disabled:bg-transparent" value="{{$bayiData->penduduk->nama}}" disabled>
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950">Usia<span class="text-red-400">*</span></p>
                        <input type="text" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" value="{{  now()->diffInMonths($bayiData->penduduk->tgl_lahir) }}" placeholder="Masukkan usia bayi" disabled>
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px]" id="page_2">
                        <p class="text-base text-neutral-950 pr-[10px]">Lingkar Lengan<span class="text-red-400">*</span></p>
                        <input type="number" step="any" name="lingkar_lengan" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" value="{{ $bayiData->pemeriksaan_bayi->lingkar_lengan }}" placeholder="Masukkan lingkar lengan" required>
                        @error('lingkar_lengan')
                            <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px]" id="page_2">
                        <p class="text-base text-neutral-950 pr-[10px]">Lingkar Kepala<span class="text-red-400">*</span></p>
                        <input type="number" step="any" name="lingkar_kepala" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" value="{{ $bayiData->pemeriksaan_bayi->lingkar_kepala }}" placeholder="Masukkan lingkar kepala" required>
                        @error('lingkar_kepala')
                            <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px]" id="page_2">
                        <p class="text-base text-neutral-950">Berat Badan<span class="text-red-400">*</span></p>
                        <input type="number" step="any" name="berat_badan" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" value="{{ $bayiData->berat_badan }}" placeholder="Masukkan berat badan" required>
                        @error('berat_badan')
                            <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-span-1 flex flex-col w-full h-fill gap-[20px]" id="page_1">
                        <p class="text-base text-neutral-950 pr-[10px]">Data KB<span class="text-red-400"></span></p>
                        <input id="data_kb" class="w-100 border text-neutral-950 border-none text-base font-normal pl-[10px] py-[10px] rounded-[5px] focus:outline-none disabled:bg-transparent" value="{{ $momMedical->data_kb }}" disabled>
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_1">
                        <p class="text-base text-neutral-950">Usia<span class="text-red-400">*</span></p>
                        <input type="text" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" value="{{  now()->diffInMonths($bayiData->penduduk->tgl_lahir) }}" placeholder="Masukkan usia bayi" disabled>
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_1">
                        <p class="text-base text-neutral-950">Nama Ibu<span class="text-red-400">*</span></p>
                        <input type="text" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan nama ibu" value="@php
                            foreach($parentData as $parent) {
                                if($parent->penduduk_id === $momMedical->ibu_id) {
                                    echo $parent->nama;
                                }
                                elseif($parent->hubungan_keluarga === 'Kepala Keluarga' || $parent->hubungan_keluarga === 'Istri') {
                                    continue;
                                }
                                else {
                                    echo 'Tidak Ada Ibu';
                                }
                            }
                        @endphp" disabled>
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_1">
                        <p class="text-base text-neutral-950 pr-[10px]">Nama Ayah<span class="text-red-400">*</span></p>
                        <input type="text" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan nama ayah" value="@php
                            foreach($parentData as $parent) {
                                if($parent->hubungan_keluarga == 'Kepala Keluarga') {
                                    echo $parent->nama;
                                }
                                elseif($parent->hubungan_keluarga == 'Istri') {
                                    continue;
                                }
                                else {
                                    echo 'Tidak Ada Ayah';
                                }
                            }
                        @endphp" disabled>
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_1">
                        <p class="text-base text-neutral-950 pr-[10px]">Alamat<span class="text-red-400">*</span></p>
                        <input type="text" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan alamat" value="{{$bayiData->penduduk->alamat}}" disabled>
                    </div>
                </div>

                <div class="md:col-span-1 flex flex-col gap-[23px]">
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_1">
                        <p class="text-base text-neutral-950">Tanggal Pemeriksaan<span class="text-red-400">*</span></p>
                        <div class="grid grid-cols-3 gap-5">
                            <select name="day" id="date" class="w-100 border border-stone-400 text-black-300 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none">
                                <option value="{{ date('d', strtotime($bayiData->tgl_pemeriksaan)) }}" class="text-black-300">{{ date('d', strtotime($bayiData->tgl_pemeriksaan)) }}</option>
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}" name="day" class="text-neutral-950">{{$i}}</option>
                                @endfor
                            </select>
                            <select name="month" id="month" class="w-100 border border-stone-400 text-black-300 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none">
                                <option value="{{ date('m', strtotime($bayiData->tgl_pemeriksaan)) }}" class="text-black-300">{{ date('m', strtotime($bayiData->tgl_pemeriksaan)) }}</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" name="month" class="text-neutral-950">{{$i}}</option>
                                @endfor
                            </select>
                            <select name="year" id="year" class="w-100 border border-stone-400 text-black-300 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none">
                                <option value="{{ date('Y', strtotime($bayiData->tgl_pemeriksaan)) }}" class="text-black-300">{{ date('Y', strtotime($bayiData->tgl_pemeriksaan)) }}</option>
                                @for ($i = 2024; $i <= 2050; $i++)
                                    <option value="{{ $i }}" name="year" class="text-neutral-950">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px]" id="page_2">
                        <p class="text-base text-neutral-950 pr-[10px]">Tinggi Badan<span class="text-red-400">*</span></p>
                        <input type="text" name="tinggi_badan" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" value="{{ $bayiData->tinggi_badan }}" placeholder="Masukkan tinggi badan" required>
                        @error('tinggi_badan')
                            <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    {{-- <div class="flex flex-col w-full h-full gap-[20px]" id="page_1">
                        <p class="text-base text-neutral-950 pr-[10px]">Respon Pengunjung<span class="text-red-400">*</span></p>
                        <textarea type="text" id="comment" class="text-sm font-normal border border-stone-400 px-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" rows="5" maxlength="200" placeholder="Masukkan respon pengunjung" name="respon">{{ implode(' ', array_slice(explode(' ', $bayiData->respon), 0, 200)) }}</textarea>
                        <p class="text-xs font-normal text-stone-400 mt-[-10px]" id="counter">0/200</p>
                    </div> --}}
                    <div class="flex flex-col w-full h-fill gap-[20px]" id="page_2">
                        <p class="text-base text-neutral-950 pr-[10px]">Status Kesehatan?<span class="text-red-400">*</span></p>
                        <div class="flex items-center gap-10">
                            @if($bayiData->status === 'sehat')
                                <input type="radio" class="indeterminate:outline-2 indeterminate:outline-stone-400 indeterminate:w-4 indeterminate:py-[6px] checked:w-4 checked:outline-2 checked:border-transparent -mr-[25px]" name="status"  value="sehat" id="option1" checked><span>Sehat</span>
                                <input type="radio" class="indeterminate:outline-2 indeterminate:outline-stone-400 indeterminate:w-4 indeterminate:py-[20px] checked:w-4 checked:outline-2 -mr-[25px]" name="status" value="sakit" id="option2"><span>Sakit</span>
                            @else
                                <input type="radio" class="indeterminate:outline-2 indeterminate:outline-stone-400 indeterminate:w-4 indeterminate:py-[6px] checked:w-4 checked:outline-2 checked:border-transparent -mr-[25px]" name="status"  value="sehat" id="option1"><span>Sehat</span>
                                <input type="radio" class="indeterminate:outline-2 indeterminate:outline-stone-400 indeterminate:w-4 indeterminate:py-[20px] checked:w-4 checked:outline-2 -mr-[25px]" name="status" value="sakit" id="option2" checked><span>Sakit</span>
                            @endif
                        </div>
                        @error('status')
                            <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px]" id="page_2">
                        <p class="text-base text-neutral-950 pr-[10px]">ASI Eksklusif?<span class="text-red-400">*</span></p>
                        <div class="flex items-center gap-10">
                            @if($bayiData->pemeriksaan_bayi->asi === 'iya')
                                <input type="radio" class="indeterminate:outline-2 indeterminate:outline-stone-400 indeterminate:w-4 indeterminate:py-[6px] checked:w-4 checked:outline-2 checked:border-transparent -mr-[25px]" name="asi" value="iya" id="option1" checked><span>Ya</span>
                                <input type="radio" class="indeterminate:outline-2 indeterminate:outline-stone-400 indeterminate:w-4 indeterminate:py-[20px] checked:w-4 checked:outline-2 -mr-[25px]" name="asi" value="tidak" id="option2"><span>Tidak</span>
                            @else
                                <input type="radio" class="indeterminate:outline-2 indeterminate:outline-stone-400 indeterminate:w-4 indeterminate:py-[6px] checked:w-4 checked:outline-2 checked:border-transparent -mr-[25px]" name="asi" value="iya" id="option1" checked><span>Ya</span>
                                <input type="radio" class="indeterminate:outline-2 indeterminate:outline-stone-400 indeterminate:w-4 indeterminate:py-[20px] checked:w-4 checked:outline-2 -mr-[25px]" name="asi" value="tidak" id="option2" checked><span>Tidak</span>
                            @endif
                        </div>
                        @error('asi')
                            <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 mx-10 gap-x-[101px] pb-[30px]">
                <div class="col-span-2 flex justify-end items-center gap-[26px] w-full">
                    <p class="text-xs"><span class="text-red-400">*</span>Wajib diisi</p>
                    <a href="{{ url('kader/bayi')}}" class="bg-gray-300 text-neutral-950 font-bold text-base py-[5px] px-[19px] rounded-[5px]" id="page_1">Kembali</a>
                    <button type="submit" class="bg-blue-700 text-white font-bold text-base py-[5px] px-[19px] rounded-[5px]" id="page_2">Simpan Data</button>
                </div>
            </div>
        </div>
    </form>
@endsection

