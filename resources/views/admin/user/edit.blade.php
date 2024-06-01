@extends('admin.layouts.template')

@section('content')
    <form action="{{route('user.store')}}" method="POST">
    {{-- <form action="{{url('admin/user/' . $users->user_id)}}" method="post"> --}}
        @csrf
        {!! method_field('PUT') !!}
        <input type="hidden" name="user" value="{{json_encode($users->toArray())}}">
        <div class="flex flex-col bg-white mx-5 my-5 rounded-md shadow-[0_-4px_0_0_rgba(29,78,216,1)]">
            <div class="flex justify-between items-center w-full py-2 border-b">
                <p class="text-lg mx-10">Ubah Data Penduduk</p>
            </div>
            <div class="flex flex-col lg:grid lg:grid-cols-2 my-[30px] mx-5 lg:mx-10 lg:gap-x-[101px] gap-[23px]">
                <div class="col-span-1 flex flex-col gap-[23px]">
                    <div class="flex flex-col w-full gap-[20px]">
                        <p class="text-base text-neutral-950">Nama Penduduk</p>
                        <select name="" id="" class="w-100 border border-stone-400 text-sm font-normal pl-[10px] py-[10px] rounded-[5px] focus:outline-none">
                            <option value="{{old('')}}" disabled selected>Pilih nama penduduk</option>
                            @foreach ($users as $user)
                                {{-- <option value="" {{ old('nama', $penduduk->penduduk_id) == $option ? 'selected': ''}}>{{ $user->nama }}</option> --}}
                            @endforeach
                        </select>
                        @error('nama')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-full gap-[20px] " id="page_1">
                        <p class="text-base text-neutral-950">Level<span class="text-red-400">*</span></p>
                        <select name="level" id="level" class="w-100 border border-stone-400 text-sm font-normal pl-[10px] py-[10px] rounded-[5px] focus:outline-none">
                            @php
                                $options = ['ketua', 'kader', 'admin'];
                            @endphp
                            @foreach ($options as $option)
                                <option value="{{ $option }}" {{ old('level', $user->level) == $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                        @error('level')
                            <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-span-1 flex flex-col gap-[23px]">
                    <div class="flex flex-col w-full gap-[20px]">
                        <p class="text-base text-neutral-950">Username</p>
                        <input type="text" name="nama" value="{{old('username', $user->username)}}" class="w-100 text-sm font-normal border border-stone-400 lg:pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan username">
                        @error('nama')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-full gap-[20px]">
                        <p class="text-base text-neutral-950">Password</p>
                        <input type="text" name="nama" value="{{old('password', $user->password)}}" class="w-100 text-sm font-normal border border-stone-400 lg:pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan password">
                        @error('nama')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-full gap-[20px] ">
                        <p class="text-base text-neutral-950">Confirm Password</p>
                        <input type="text" name="tempat" value="{{old('')}}" class="w-100 text-sm font-normal border border-stone-400 lg:pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan konfirmasi password">
                        @error('tempat')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- <input type="hidden" name="kategori_golongan" id="kategori_golongan"> --}}
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