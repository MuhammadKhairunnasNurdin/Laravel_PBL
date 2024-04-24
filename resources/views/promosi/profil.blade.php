@extends('promosi.template')

@section('content')
    <p class="font-bold text-[30px] text-center py-[35px]">Posyandu</p>
    <div class="flex bg-white rounded-[10px] mx-[55px] gap-[42px]">
        <img class="w-[496px] h-[372px] py-[39px] pl-10" src="{{ asset('img/logo_posyandu.png') }}" alt="logo posyandu">
        <div class="flex flex-col gap-[30px] pr-10 justify-center">
            <h2 class="font-bold text-[30px]">Apa itu Posyandu?</h2>
            <p class="text-[23px] text-justify">Pos Pelayanan Terpadu  adalah suatu kegiatan  perwujudan peran serta  masyarakat yang dikelola  oleh masyarakat, dari  masyarakat, dan untuk  masyarakat dalam mencapai  pelayanan kesehatan yang  lebih baik.</p>
        </div>
    </div>

    <p class="font-bold text-[30px] text-center py-[35px]">Visi dan Misi</p>
    <div class="grid grid-cols-2 gap-[60px] h-full px-[55px]">
        <div class="flex flex-col items-center rounded-[10px] h-full px-[39px] bg-white gap-[41px]">
            <div class="flex flex-col items-center gap-[25px]">
                <img src="{{ asset('img/Vision board-amico.png') }}" alt="" class="w-[210px] aspect-square pt-[25px]">
                <h2 class="font-bold">Visi</h2>
            </div>
            <div class="px-[39px]">
                <ul class="list-disc gap-5 text-justify text-[23px]">
                    <li class="pb-5">Mewujudkan pelayanan  kesehatan yang optimal di  Posyandu Delima Merah</li>
                    <li class="pb-5">Mewujudkan program  prioritas nasional yaitu  menurunkan angka  kematian ibu dan bayi,  percepatan penurunan  stunting, dan  meningkatkan pencapaian  posyandu.</li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col items-center rounded-[10px] px-[39px] bg-white gap-[41px]">
            <div class="flex flex-col items-center gap-[25px]">
                <img src="{{ asset('img/Business mission-amico.png') }}" alt="" class="w-[210px] aspect-square pt-[25px]">
                <h2 class="font-bold">Misi</h2>
            </div>
            <div class="px-[39px]">
                <ul class="list-disc gap-5 text-justify text-[23px]">
                    <li class="pb-5">Meningkatkan pemerataan  pelayanan kesehatan kepada  masyarakat</li>
                    <li class="pb-5">Meningkatkan jangkauan  pelayanan kesehatan dengan  pendekatan proaktif</li>
                    <li class="pb-5">Meningkatkan mutu layanan  kesehatan masyarakat di wilayah  Kelurahan Polehan RW 06</li>
                </ul>   
            </div>
        </div>
    </div>

    <p class="font-bold text-[30px] text-center py-[35px]">Kegiatan</p>
    <div class="mx-[55px] bg-white rounded-[10px] mb-[60px]">
        <div class="grid grid-cols-3 gap-[25px] h-full px-[49px] py-[31px]">
            <div class="flex flex-col text-white items-center bg-[#32A0C0] gap-[55px] py-[55px] rounded-[5px]">
                <p class="text-[35px]">Posyandu Balita</p>
                <div class="px-[26px]">
                    <ul class="list-disc text-justify text-lg font-semibold">
                        <li class="pb-[25px]">Penimbangan Berat Badan</li>
                        <li class="pb-[25px]">Penentuan Status Pertumbuhan</li>
                        <li class="pb-[25px]">Pengisian Buku KMS</li>
                        <li class="pb-[25px]">Penyuluhan</li>
                        <li class="pb-[25px]">Pelayanan Imunisasi</li>
                        <li class="pb-[25px]">Pemberian Makanan Tambahan (PTM)</li>
                    </ul>
                </div>
            </div>
            <div class="flex flex-col items-center text-white h-full bg-[#5BB3CC] gap-[55px] py-[55px] rounded-[5px]">
                <p class="text-[35px]">Posyandu Lansia</p>
                <div class="px-[26px]">
                    <ul class="list-disc text-justify text-lg font-semibold">
                        <li class="pb-[25px]">Penimbangan Berat Badan</li>
                        <li class="pb-[25px]">Pengukuran Tinggi Badan</li>
                        <li class="pb-[25px]">Pengecekan Tekanan Darah</li>
                        <li class="pb-[25px]">Pengukuran Lingkar Perut</li>
                    </ul>
                </div>
            </div>
            <div class="flex flex-col items-center text-white h-full bg-[#84C6D9] gap-[55px] py-[55px] rounded-[5px]">
                <p class="text-[35px]">Kegiatan Penunjang</p>
                <div class="px-[48px]">
                    <ul class="list-disc text-justify text-lg font-semibold">
                        <li class="pb-[25px]">Kelas Ibu Hamil</li>
                        <li class="pb-[25px]">Pencegahan Diare</li>
                        <li class="pb-[25px]">Team Pendamping Keluarga</li>
                        <li class="pb-[25px]">Pemeriksaan Gula Darah Gratis</li>
                        <li class="pb-[25px]">Imunisasi Lengkap Di Pos Kesehatan Kelurahan Polehan</li>
                    </ul>
                </div>
            </div>
            {{-- <div class="flex flex-col  items-center bg-red-400 gap-[55px] py-[67.5px]">
                <p class="text-[35px]">Kegiatan Penunjang</p>
                <div class="px-[26px]">
                    <ul class="list-disc text-justify text-lg font-semibold">
                        <li class="pb-[25px]">Kelas Ibu Hamil</li>
                        <li class="pb-[25px]">Pencegahan Diare</li>
                        <li class="pb-[25px]">Team Pendamping Keluarga</li>
                        <li class="pb-[25px]">Pemeriksaan Gula Darah Gratis</li>
                        <li class="pb-[25px]">Imunisasi Lengkap Di Pos Kesehatan Kelurahan Polehan</li> 
                    </ul>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
