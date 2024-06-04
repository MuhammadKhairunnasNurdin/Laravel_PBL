@extends('promosi.template')

@section('content')
<div class="flex flex-col lg:grid lg:grid-cols-8 gap-4 mx-4 my-4">
    <div class="lg:col-span-6 flex flex-col w-full max-md:h-fit bg-white py-[30px] items-center px-10 lg:px-20">
        <h2 class="text-justify text-lg lg:text-3xl font-bold text-neutral-950">{{$artikels->judul}}</h2>
        {{-- <p>{{$publisher->kaders->penduduks->nama}}</p> --}}
        <p class="text-justify">
            @if ($artikels->updated_at !== null)
                {{$artikels->updated_at}}
            @else
                {{$artikels->created_at}}
            @endif
        </p>
        <img src="{{$artikels->foto_artikel}}" alt="" class="w-full py-5 lg:py-10">
        <p class="text-sm lg:text-lg indent-10 lg:indent-20 text-justify pb-5 leading-relaxed">{{$artikels->isi}}</p>
    </div>
    
    <div class="lg:col-span-2 flex flex-col w-full lg:h-fit bg-white px-10 lg:px-4 py-4 gap-5 overflow-y-auto">
        <h3 class="border-b-4 border-blue-700 font-bold text-lg">Artikel Lainnya</h3>
        @foreach ($recommendation as $rec)
            <a class="grid grid-cols-3 lg:grid-cols-2 gap-4 hover:text-blue-700" href="/read={{$rec->artikel_id}}">
                <div class="col-span-2 lg:col-span-1 flex items-center overflow-hidden">
                    <img src="{{$rec->foto_artikel}}" alt="" class="w-full hover:transform hover:scale-125 hover:transition hover:ease-in-out hover:duration-500">
                </div>
                <h3 class="font-bold text-justify">{{$rec->judul}}</h3>
            </a>
        @endforeach
    </div>
</div>
@endsection