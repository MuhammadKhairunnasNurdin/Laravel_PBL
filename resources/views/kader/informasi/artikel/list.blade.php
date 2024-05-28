@extends('kader.layouts.template')

@section('content')
<div class="flex w-full justify-center items-center my:2 lg:my-4" id="message">
    @if(session('success'))
        <div class="flex w-3/4 h-full items-center p-2 mb-1 border-2 border-green-500 bg-green-100 text-green-700 rounded-md" id="message">
            <p class="mr-4"> <b>BERHASIL </b> {{ session('success') }}</p>
            <button id="close" class="ml-auto bg-transparent text-green-700 hover:text-green-900">
                <span>&times;</span>
            </button>
        </div>
    @elseif(session('error'))
        <div class="flex w-3/4 h-full items-center p-4 mb-4 border-2 border-red-500 bg-red-100 text-red-700 rounded-md" id="message">
            <p class="mr-4">{{ session('error') }}</p>
            <button id="close" class="ml-auto bg-transparent text-red-700 hover:text-red-900">
                <span>&times;</span>
            </button>
        </div>
    @endif
</div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-[41px] my-5 mx-5">
        @foreach ($artikels as $artikel)
            <div
                class="w-100 flex flex-col justify-center items-center bg-white px-[15px] py-5 rounded-[15px] gap-[15px]">
                <img src="{{ $artikel->foto_artikel}}" alt="" class="w-[327px] h-[225px] rounded-[7.5px]">
                <h3 class="font-bold text-[15px] text-justify">{{ $artikel->judul}}</h3>
                <p class="text-[15px] text-justify">{{ substr($artikel->isi, 0, 200) }} {{ strlen($artikel->isi) > 100 ? '...' : '' }}</p>
                <form action="artikel/{{$artikel->artikel_id}}" method="post" class="flex items-center gap-2">
                    <div class="flex w-full justify-center gap-[10px] pt-[13px]">
                        @php
                            session(['urlArtikel' => '']);
                        @endphp
                        <a href="artikel/{{$artikel->artikel_id}}"
                           class="bg-gray-300 text-[15px] py-[10px] px-[30px] rounded-[5px]">Lihat</a>
                        <a href="artikel/{{$artikel->artikel_id}}/edit"
                           class="bg-blue-700 text-[15px] text-white py-[10px] px-[30px] rounded-[5px]">Edit</a>
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="updated_at" value="{{ $artikel->updated_at }}">
                        <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data?')" class="bg-red-400 text-[15px] py-[10px] px-[30px] rounded-[5px] hover:bg-red-600 hover:text-white">Hapus</button>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
@endsection

@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function (){
            setTimeout(function() {
                $('#message').fadeOut('fast');
            }, 3000);
        })

        document.addEventListener('DOMContentLoaded', function() {
        let div = document.getElementById('message');
        let button = document.getElementById('close');

        if (div && button) {
            button.addEventListener('click', function() {
            div.classList.add('hidden');
            });
        }
    });
    </script>
@endpush
