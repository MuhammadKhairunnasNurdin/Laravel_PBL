<nav class="grid grid-cols-3 h-fit py-5 bg-white shadow-md sticky top-0 z-50">
    <div class="flex w-fit col-span-1 px-5">
        <img src="{{ asset('img/logo_posyandu.png') }}" alt="" class="w-16 h-auto">
        <div class="flex flex-col">
            <p class="text-neutral-950 text-xs">Sistem Informasi</p class="">
            <p class="text-neutral-950 text-2xl font-bold">Posyandu</p class="">
        </div>
    </div>
    <div class="flex col-span-1 justify-center align-middle px-5 w-full h-full items-center">
        <div class="flex gap-[70px]">
            <a class="text-neutral-950 text-base pb-[5px] transition ease-in-out duration-300 {{ ($activeMenu == '')? '' : 'hover:border-b-[3px] hover:border-blue-700'}}" href="">Berita</a>
            <a class="text-neutral-950 text-base pb-[5px] transition ease-in-out duration-300 {{ ($activeMenu == 'profil')? 'activeHeader' : 'hover:border-b-[3px] hover:border-blue-700'}}" href="{{ url('profil')}}">Profil</a>
            <a class="text-neutral-950 text-base pb-[5px] transition ease-in-out duration-300 {{ ($activeMenu == 'jadwal')? 'activeHeader' : 'hover:border-b-[3px] hover:border-blue-700'}}" href="{{ url('jadwal')}}">Kegiatan</a>
        </div>
    </div>
    <div class="flex col-span-1 justify-end items-center align-middle w-full h-full ">
        <a href="{{ url('login')}}" class="bg-blue-700 text-white rounded-[20px] px-5 py-2.5 mx-12">Login</a>
    </div>
</nav>