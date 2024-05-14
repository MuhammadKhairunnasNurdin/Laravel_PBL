@extends('kader.layouts.template')

@section('content')
    <div class="grid grid-cols-3 gap-[41px] my-5 mx-5">
        @foreach ($artikels as $artikel)
        <div class="w-100 flex flex-col justify-center items-center bg-white px-[15px] py-5 rounded-[15px] gap-[15px]">
            <img src="{{ $artikel->foto_artikel}}" alt="" class="w-[327px] h-[225px] rounded-[7.5px]">
            <h3 class="font-bold text-[15px] text-justify">{{ $artikel->judul}}</h3>
            <p class="text-[15px] text-justify">{{ substr($artikel->isi, 0, 200) }} {{ strlen($artikel->isi) > 100 ? '...' : '' }}</p>
            <div class="flex w-full justify-center gap-[10px] pt-[13px]">
                <a href="{{ url('kader/informasi/artikel/' . $artikel->artikel_id )}}" class="bg-gray-300 text-[15px] py-[10px] px-[30px] rounded-[5px]">Lihat</a>
                <a href="{{ url('kader/informasi/artikel/'. $artikel->artikel_id .'/edit')}}" class="bg-blue-700 text-[15px] text-white py-[10px] px-[30px] rounded-[5px]">Edit</a>
            </div>
        </div>
        @endforeach
    </div>
@endsection
