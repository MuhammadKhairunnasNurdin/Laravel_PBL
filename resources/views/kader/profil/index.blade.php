@extends('kader.layouts.template')

@section('content')
    <div class="grid grid-cols-3 bg-white mx-5 mt-5 rounded-[15px]">
        <div class="flex flex-col items-center w-full pt-[30px] gap-[10px]">
            <p class="text-lg font-bold ">Informasi Profile</p>
            <img src="{{ asset('img/profile_picture.png')}}" alt="profile image" class="w-[250px] h-[250px] rounded-[50px] ">
            <div class="w-100 text-center">
                <p>Rizky Fauzi</p>
                <p>Ketua Posyandu</p>
            </div>
            <div class="flex gap-[30px] font-bold">
                <a href="" class="bg-red-600 text-white py-[10px] px-[17px] rounded-[5px]">Hapus</a>
                <a href="" class="bg-blue-700 text-white py-[10px] px-[17px] rounded-[5px]">Ubah</a>
            </div>

        </div>
        <div class="col-span-2 w-full h-full py-10">
            <div class="flex flex-col py-[55px] mr-[51px] bg-gray-200 rounded-[15px] gap-[60px]">
                <div class="grid grid-cols-2 justify-between px-[61px] ">
                    <p>Username</p>
                    <input type="text" class="w-100 py-1 rounded-[4px]">
                </div>
                <div class="grid grid-cols-2 justify-between px-[61px] ">
                    <p>Password</p>
                    <input type="text" class="w-100 py-1 rounded-[4px]">
                </div>
                <div class="grid grid-cols-2 justify-between px-[61px] ">
                    <p>Ulangi Password</p>
                    <input type="text" class="w-100 py-1 rounded-[4px]">
                </div>
            </div>
        </div>
        <div class="flex justify-end col-span-3 w-full pr-[51px] pb-[30px] gap-[30px]">
            <a href="{{ url('kader/') }}" class="bg-gray-300 py-[10px] px-[17px] rounded-[5px]">Kembali</a>
            <a href="" class="bg-blue-700 text-white py-[10px] px-[17px] rounded-[5px]">Simpan Data</a>
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
