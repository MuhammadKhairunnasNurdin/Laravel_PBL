@extends('kader.layouts.template')

@section('content')
    <div class="flex flex-col my-5 mx-5 bg-white">
        <h1 class="font-bold text-justify w-full text-3xl px-10 py-10">Tingkatkan Masyarakat Sehat Sejahtera, Kader Panjang Baru adakan Posyandu Balita di Polehan</h1>
        <img src="{{ asset('img/image 1.png')}}" alt="" class="px-20 py-10">
        <p class="px-10 text-lg indent-20 text-justify pb-5 leading-relaxed">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur eius, mollitia totam, laudantium recusandae, dolorum assumenda minima explicabo deserunt facere eveniet alias hic! Doloremque soluta quo molestiae sint rerum saepe! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Omnis commodi temporibus maiores culpa atque adipisci, recusandae corporis rerum quam, laboriosam mollitia quo cupiditate aliquam. Cumque, animi! Quaerat excepturi architecto totam! Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos omnis porro, expedita dolorum suscipit saepe aut deleniti laboriosam, fugit doloribus provident numquam! Omnis dolor quasi aspernatur iure consectetur praesentium magnam! Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi similique inventore facilis eius molestias enim nam exercitationem est a possimus, repudiandae maiores fugiat ab deleniti cumque nostrum blanditiis cupiditate aut.
        </p>
        <p class="px-10 text-lg indent-20 text-justify leading-relaxed">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur eius, mollitia totam, laudantium recusandae, dolorum assumenda minima explicabo deserunt facere eveniet alias hic! Doloremque soluta quo molestiae sint rerum saepe! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Omnis commodi temporibus maiores culpa atque adipisci, recusandae corporis rerum quam, laboriosam mollitia quo cupiditate aliquam. Cumque, animi! Quaerat excepturi architecto totam! Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos omnis porro, expedita dolorum suscipit saepe aut deleniti laboriosam, fugit doloribus provident numquam! Omnis dolor quasi aspernatur iure consectetur praesentium magnam! Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi similique inventore facilis eius molestias enim nam exercitationem est a possimus, repudiandae maiores fugiat ab deleniti cumque nostrum blanditiis cupiditate aut.
        </p>
        <div class="flex w-full justify-end gap-[15px] font-bold px-10 pb-10">
            <a href="{{ url('kader/informasi/')}}" class="bg-gray-300 text-[15px] py-[10px] px-[30px] rounded-[5px]">Kembali</a>
            <a href="" class="bg-yellow-400 text-[15px py-[10px] px-[20px] rounded-[5px]">Edit</a>
        </div>
    </div>
@endsection
