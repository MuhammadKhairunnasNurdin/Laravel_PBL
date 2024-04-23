@extends('kader.layouts.template')

@section('content')
    <form action="{{ url('kader/informasi/kegiatan/' . $kegiatans->kegiatan_id) }}" method="post">
        @csrf
        <!--add 'PUT' method, because we use Route::put() for update-->
        {!! method_field('PUT') !!}
        <div class="flex flex-col bg-white mx-5 my-5 rounded-md">
            <div class="grid grid-cols-2 my-[30px] mx-10 gap-x-[101px]">
                <div class="col-span-1 flex flex-col gap-[23px]">
                    <div class="flex flex-col w-full h-fill gap-[20px]">
                        <p class="text-base text-neutral-950">Nama Kegiatan</p>
                        <input type="text" name="nama" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" value="{{ $kegiatans->nama}}" placeholder="Masukkan nama kegiatan">
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px]">
                        <p class="text-base text-neutral-950">Tempat</p>
                        <input type="text" name="tempat" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" value="{{ $kegiatans->tempat}}" placeholder="Masukkan tempat pelaksanaan">
                    </div>
                </div>

                <div class="col-span-1 flex flex-col gap-[23px]">
                    <div class="flex flex-col w-full h-fill gap-[23px]">
                        <p class="text-base text-neutral-950">Tanggal Kegiatan</p>
                        <div class="grid grid-cols-3 gap-5">
                            <select name="date" id="date" class="w-100 border border-stone-400 text-black-300 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none">
                                <option value="{{ date('d', strtotime($kegiatans->tgl_kegiatan)) }}" class="text-black-300">{{ date('d', strtotime($kegiatans->tgl_kegiatan)) }}</option>
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}" name="" class="text-neutral-950">{{$i}}</option>
                                @endfor
                            </select>
                            <select name="month" id="month" class="w-100 border border-stone-400 text-black-300 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none">
                                <option value="{{ date('m', strtotime($kegiatans->tgl_kegiatan)) }}">{{ date('m', strtotime($kegiatans->tgl_kegiatan)) }}</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" name="" class="text-neutral-950">{{$i}}</option>
                                @endfor
                            </select>
                            <select name="year" id="year" class="w-100 border border-stone-400 text-black-300 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none">
                                <option value="{{ date('y', strtotime($kegiatans->tgl_kegiatan)) }}">{{ date('y', strtotime($kegiatans->tgl_kegiatan)) }}</option>
                                @for ($i = 2024; $i <= 2050; $i++)
                                    <option value="{{ $i }}" name="" class="text-neutral-950">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="flex flex-col w-full h-fill gap-[20px]">
                            <p class="text-base text-neutral-950">Pukul Kegiatan</p>
                            <div class="flex gap-x-5 items-center me-[300px]">
                                <input type="text" id="timeInput" pattern="[0-9]{2}:[0-9]{2}" name="jam_mulai" class="w-full text-sm text-center font-normal border border-stone-400 py-[10px] px-2.5 rounded-[5px] decoration-none focus:outline-none placeholder:text-gray-300" value="{{ date('H:i', strtotime($kegiatans->jam_mulai)) }}" placeholder="Jam Mulai">
                                <span class="w-fit">-</span>
                                <span class="w-fit">Selesai</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end items-end gap-[26px] px-[50px] pb-10 w-full h-full">
                <a href="{{ route('kegiatan.index')}}" class="bg-gray-300 text-neutral-950 font-bold text-base py-[10px] px-[10px] rounded-[5px]">Kembali</a>
                <button type="submit" class="bg-blue-700 text-white font-bold text-base py-[10px] px-[10px] rounded-[5px]">Simpan</button>
            </div>
        </div>
    </form>
@endsection
