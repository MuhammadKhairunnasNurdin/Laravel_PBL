@extends('admin.layouts.template')

@section('content')
    <form action="{{route('user.store')}}" method="POST">
        @csrf
        <div class="flex flex-col bg-white mx-5 my-5 rounded-md">
            <div class="flex flex-col lg:grid lg:grid-cols-2 my-[30px] mx-5 lg:mx-10 lg:gap-x-[101px] gap-[23px]">
                <div class="col-span-1 flex flex-col gap-[23px]">
                    <div class="flex flex-col w-full gap-[20px]">
                        <p class="text-base text-neutral-950">Nama Penduduk</p>
                        {{-- <input type="text" name="nama" value="{{old('nama')}}" class="w-100 text-sm font-normal border border-stone-400 lg:pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan nama kegiatan"> --}}
                        <select name="" id="" class="w-100 border border-stone-400 text-sm font-normal pl-[10px] py-[10px] rounded-[5px] focus:outline-none">
                            <option value="" disabled selected>Pilih nama penduduk</option>
                            @foreach ($penduduks as $p)
                                <option value="">{{ $p->nama }}</option>
                            @endforeach
                        </select>
                        @error('nama')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-full gap-[20px] ">
                        <p class="text-base text-neutral-950">Level</p>
                        {{-- <input type="text" name="tempat" value="{{old('tempat')}}" class="w-100 text-sm font-normal border border-stone-400 lg:pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan tempat pelaksanaan"> --}}
                        <select name="" id="" class="w-100 border border-stone-400 text-sm font-normal pl-[10px] py-[10px] rounded-[5px] focus:outline-none">
                                <option value="" disabled selected>Pilih level user</option>
                                <option value="">Kader</option>
                                <option value="">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-1 flex flex-col gap-[23px]">
                    <div class="flex flex-col w-full gap-[20px]">
                        <p class="text-base text-neutral-950">Username</p>
                        <input type="text" name="nama" value="{{old('nama')}}" class="w-100 text-sm font-normal border border-stone-400 lg:pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan username">
                        @error('nama')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-full gap-[20px]">
                        <p class="text-base text-neutral-950">Password</p>
                        <input type="text" name="nama" value="{{old('nama')}}" class="w-100 text-sm font-normal border border-stone-400 lg:pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan password">
                        @error('nama')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-full gap-[20px] ">
                        <p class="text-base text-neutral-950">Confirm Password</p>
                        <input type="text" name="tempat" value="{{old('tempat')}}" class="w-100 text-sm font-normal border border-stone-400 lg:pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan konfirmasi password">
                        @error('tempat')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <input type="hidden" name="kategori_golongan" id="kategori_golongan">
            <div class="grid md:grid-cols-2 mx-10 gap-x-[101px] pb-[30px]">
                <span id="page_1" class="col-span-1 hidden md:hidden"></span>
                <div class="col-span-2 flex justify-end items-center gap-[26px] pt-10 w-full" id="">
                    <p class="text-xs"><span class="text-red-400">*</span>Wajib diisi</p>
                    <a href="{{ url('admin/user' . session('urlPagination')) }}" class="bg-gray-300 text-neutral-950 font-bold text-base py-[5px] px-[19px] rounded-[5px]" id="page_1">Kembali</a>
                    <button type="submit" class="bg-blue-700 text-white font-bold text-base py-[5px] px-[19px] rounded-[5px]" id="page_2">Simpan Data</button>
                </div>
            </div>
        </div>

        </div>
    </form>
@endsection