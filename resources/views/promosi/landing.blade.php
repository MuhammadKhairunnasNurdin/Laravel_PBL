@extends('promosi.template')

@section('content')
<div id="default-carousel" class="relative w-full" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-[600px]">
         <!-- Item 1 -->
        <div class="hidden duration-700 ease-in-out h-full  " data-carousel-item>
            {{-- <img src="/docs/images/carousel/carousel-1.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> --}}
            <div class="absolute w-full -translate-x-1/2 -translate-y-1/2 bg-posyandu top-1/2 left-1/2 grid grid-cols-2 px-[131px] h-full items-center gap-[235px]">
                <div class="col-span-1 gap-[30px] pr-10 justify-center">
                    <h2 class="font-bold text-[40px]">Posyandu Delima Merah</h2>
                    <p class="text-[30px] text-justify tracking-[10%] mb-[35px]">Pelayanan kesehatan untuk mewujudkan masyarakat sehat</p>
                    <a href="{{ url('profil')}}" class="px-[30px] py-[15px] rounded-[5px] text-[25px] border border-neutral-950 bg-transparent">Pelajari Selengkapnya</a>
                </div>
                <img class=" py-[39px] pl-10" src="{{ asset('img/logo_posyandu.png') }}" alt="logo posyandu">
            </div>
        </div>
        <div class="hidden duration-700 ease-in-out h-full  " data-carousel-item>
            {{-- <img src="/docs/images/carousel/carousel-1.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> --}}
            <div class="absolute w-full -translate-x-1/2 -translate-y-1/2 bg-posyandu top-1/2 left-1/2 grid grid-cols-2 px-[131px] h-full items-center gap-[235px]">
                <div class="col-span-1 gap-[30px] pr-10 justify-center">
                    <h2 class="font-bold text-[40px]">Posyandu Delima Merah</h2>
                    <p class="text-[30px] text-justify tracking-[10%] mb-[35px]">Pelayanan kesehatan untuk mewujudkan masyarakat sehat</p>
                    <a href="{{ url('profil')}}" class="px-[30px] py-[15px] rounded-[5px] text-[25px] border border-neutral-950 bg-transparent">Pelajari Selengkapnya</a>
                </div>
                <img class=" py-[39px] pl-10" src="{{ asset('img/logo_posyandu.png') }}" alt="logo posyandu">
            </div>
        </div>
        <div class="hidden duration-700 ease-in-out h-full  " data-carousel-item>
            {{-- <img src="/docs/images/carousel/carousel-1.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> --}}
            <div class="absolute w-full -translate-x-1/2 -translate-y-1/2 bg-posyandu top-1/2 left-1/2 grid grid-cols-2 px-[131px] h-full items-center gap-[235px]">
                <div class="col-span-1 gap-[30px] pr-10 justify-center">
                    <h2 class="font-bold text-[40px]">Posyandu Delima Merah</h2>
                    <p class="text-[30px] text-justify tracking-[10%] mb-[35px]">Pelayanan kesehatan untuk mewujudkan masyarakat sehat</p>
                    <a href="{{ url('profil')}}" class="px-[30px] py-[15px] rounded-[5px] text-[25px] border border-neutral-950 bg-transparent">Pelajari Selengkapnya</a>
                </div>
                <img class=" py-[39px] pl-10" src="{{ asset('img/logo_posyandu.png') }}" alt="logo posyandu">
            </div>
        </div>
        <div class="hidden duration-700 ease-in-out h-full  " data-carousel-item>
            {{-- <img src="/docs/images/carousel/carousel-1.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> --}}
            <div class="absolute w-full -translate-x-1/2 -translate-y-1/2 bg-posyandu top-1/2 left-1/2 grid grid-cols-2 px-[131px] h-full items-center gap-[235px]">
                <div class="col-span-1 gap-[30px] pr-10 justify-center">
                    <h2 class="font-bold text-[40px]">Posyandu Delima Merah</h2>
                    <p class="text-[30px] text-justify tracking-[10%] mb-[35px]">Pelayanan kesehatan untuk mewujudkan masyarakat sehat</p>
                    <a href="{{ url('profil')}}" class="px-[30px] py-[15px] rounded-[5px] text-[25px] border border-neutral-950 bg-transparent">Pelajari Selengkapnya</a>
                </div>
                <img class=" py-[39px] pl-10" src="{{ asset('img/logo_posyandu.png') }}" alt="logo posyandu">
            </div>
        </div>
        <!-- Item 2 -->
        
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-full hover:bg-blue-500 hover:bg-white" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full hover:bg-blue-500 hover:bg-white" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full hover:bg-blue-500 hover:bg-white" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        {{-- <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button> --}}
        {{-- <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button> --}}
        {{-- <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 6" data-carousel-slide-to="5"></button> --}}
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none " data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

<p class="font-bold text-[30px] text-center py-[35px]">Jumlah Kunjungan Masyarakat ke Posyandu Bulan ini</p>
<div>
    <div class="flex justify-between pt-5 flex-col pr-6 pl-7 mb-10 gap-9 bg-white rounded-[10px] mx-[55px]">
        <p class="font-medium text-base">Grafik Kunjungan Masyarakat per RT</p>
        <div class="px-[173px]">
            {!! $chart->container() !!}
        </div>
    </div>
    <p class="text-xs text-stone-400 -mt-[30px] pl-[55px]">Data diatas adalah data kunjungan bulan April 2024</p>
</div>

<div class="bg-gray-300 gap-8 pr-6 pl-7 mb-10 rounded-[5px] mx-[55px] py-5 my-[60px]">
    <div class="flex justify-between flex-col gap-5">
        <div class="flex w-full justify-between">
            <span class="text-[26px] font-bold -mt-[10px]">Kegiatan</span>
            <a href="{{ url('jadwal')}}" class="bg-neutral-950 text-white rounded-full px-5 py-2.5 ">Lihat Semua</a>
        </div>

        <p class="text-[18px]">Berita-berita seputar kegiatan</p>
        <div class="px-[173px]">
            {!! $chart->container() !!}
        </div>
    </div>
    <div>
        <div class="grid grid-cols-4 gap-[22px]">
            <div class="flex flex-col gap-[15px]">
                <img src="{{ asset('img/image 1.png')}}" alt="">
                <p class="text-[17px] font-semibold text-justify">Tingkatkan Masyarakat Sehat Sejahtera, Kader Panjang Baru adakan Posyandu Balita di Polehan</p>
                <span class="text-red-400">Kegiatan</span>
            </div>
            <div class="flex flex-col gap-[15px]">
                <img src="{{ asset('img/image 1.png')}}" alt="">
                <p class="text-[17px] font-semibold text-justify">Tingkatkan Masyarakat Sehat Sejahtera, Kader Panjang Baru adakan Posyandu Balita di Polehan</p>
                <span class="text-red-400">Kegiatan</span>
            </div>
            <div class="flex flex-col gap-[15px]">
                <img src="{{ asset('img/image 1.png')}}" alt="">
                <p class="text-[17px] font-semibold text-justify">Tingkatkan Masyarakat Sehat Sejahtera, Kader Panjang Baru adakan Posyandu Balita di Polehan</p>
                <span class="text-red-400">Kegiatan</span>
            </div>
            <div class="flex flex-col gap-[15px]">
                <img src="{{ asset('img/image 1.png')}}" alt="">
                <p class="text-[17px] font-semibold text-justify">Tingkatkan Masyarakat Sehat Sejahtera, Kader Panjang Baru adakan Posyandu Balita di Polehan</p>
                <span class="text-red-400">Kegiatan</span>
            </div>
        </div>
    </div>
</div>

<div class="bg-white gap-8 pr-6 pl-7 mb-10 rounded-[5px] mx-[55px] py-5 my-[60px]">
    <div class="flex justify-between flex-col gap-5">
        <div class="flex w-full justify-between">
            <span class="text-[26px] font-bold -mt-[10px]">Edukasi</span>
            <a href="" class="bg-neutral-950 text-white rounded-full px-5 py-2.5 ">Lihat Semua</a>
        </div>

        <p class="text-[18px]">Berita-berita seputar edukasi</p>
        <div class="px-[173px]">
            {!! $chart->container() !!}
        </div>
    </div>
    <div>
        <div class="grid grid-cols-4 gap-[22px]">
            <div class="flex flex-col gap-[15px]">
                <img src="{{ asset('img/image 2.png')}}" alt="">
                <p class="text-[17px] font-semibold text-justify">Pengaruh Keharmonisan Keluarga Terhadap Perkembangan Anak</p>
                <span class="text-red-400">Edukasi</span>
            </div>
            <div class="flex flex-col gap-[15px]">
                <img src="{{ asset('img/image 2.png')}}" alt="">
                <p class="text-[17px] font-semibold text-justify">Pengaruh Keharmonisan Keluarga Terhadap Perkembangan Anak</p>
                <span class="text-red-400">Edukasi</span>
            </div>
            <div class="flex flex-col gap-[15px]">
                <img src="{{ asset('img/image 2.png')}}" alt="">
                <p class="text-[17px] font-semibold text-justify">Pengaruh Keharmonisan Keluarga Terhadap Perkembangan Anak</p>
                <span class="text-red-400">Edukasi</span>
            </div>
            <div class="flex flex-col gap-[15px]">
                <img src="{{ asset('img/image 2.png')}}" alt="">
                <p class="text-[17px] font-semibold text-justify">Pengaruh Keharmonisan Keluarga Terhadap Perkembangan Anak</p>
                <span class="text-red-400">Edukasi</span>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{ $chart->cdn() }}"></script>
{{$chart->script() }}
@endpush