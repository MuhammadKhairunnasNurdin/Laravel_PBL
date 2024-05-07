@extends('kader.layouts.template')

@section('content')
    <form action="{{route('bayi.store')}}" method="POST">
        @csrf
        <div class="flex flex-col bg-white mx-5 my-5 shadow-[0_-4px_0_0_rgba(248,113,113,1)] rounded-md">
            <div class="flex justify-between items-center w-full py-2 border-b">
                <p class="text-lg mx-10">Form Pemeriksaan Bayi</p>
            </div>

            <div class="grid md:grid-cols-2 my-[30px] mx-10 gap-x-[101px]">
                <div class="md:col-span-1 flex flex-col gap-[23px]">
                    <div class="flex flex-col w-full h-fill gap-[20px]" id="page_1">
                        <p class="text-base text-neutral-950">Nama Bayi<span class="text-red-400">*</span></p>
                        <select name="penduduk_id" id="penduduk_id" class="w-100 border border-stone-400 text-sm font-normal pl-[10px] py-[10px] rounded-[5px] focus:outline-none">
                            <option value="" class="text-gray-300">Masukkan nama balita</option>
                            @foreach($bayisData as $bayi)
                                <option value="{{ $bayi->penduduk_id }}" class="text-neutral-950">{{ $bayi->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950">Usia<span class="text-red-400">*</span></p>
                        <input type="text" id="usia2" class="w-100 text-sm font-normal border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan usia bayi" disabled>
                    </div> --}}
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950 pr-[10px]">Lingkar Kepala<span class="text-red-400">*</span></p>
                        <input type="number" step="any" name="lingkar_kepala" class="w-100 text-sm font-normal border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan lingkar kepala" required>
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950 pr-[10px]">Lingkar Lengan<span class="text-red-400">*</span></p>
                        <input type="number" step="any" name="lingkar_lengan" class="w-100 text-sm font-normal border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan lingkar lengan" required>
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950">Berat Badan<span class="text-red-400">*</span></p>
                        <input type="number" step="any" name="berat_badan" class="w-100 text-sm font-normal border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan berat badan" required>
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px]" id="page_1">
                    {{-- <div class="grid grid-cols-3 w-full h-fill gap-[20px]" id="page_1"> --}}
                        <p class="text-base text-neutral-950 ">Usia</p>
                        {{-- <p class="text-base text-neutral-950 w-1/2 -ml-20">:</p> --}}
                        {{-- <p class="text-base text-neutral-950 text-left -ml-56" id="usia1"></p> --}}
                        <input type="text" id="usia1" class="w-100 text-sm font-normal border border-stone-300 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-400 cursor-not-allowed" placeholder="Otomatis terisi setelah memilih nama bayi" value="" disabled>
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px]" id="page_1">
                    {{-- <div class="grid grid-cols-3 w-full h-fill gap-[20px]" id="page_1"> --}}
                        <p class="text-base text-neutral-950">Nama Ibu</p>
                        {{-- <p class="text-base text-neutral-950 -mb-4 w-1/2 -ml-20">:</p> --}}
                        {{-- <p class="text-base text-neutral-950 -ml-56" id="ibu"></p> --}}
                        <input type="text" id="ibu" class="w-100 text-sm font-normal border border-stone-300 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-400 cursor-not-allowed" placeholder="Otomatis terisi setelah memilih nama bayi" value="" disabled>
                    </div>
                </div>
                
                <div class="md:col-span-1 flex flex-col gap-[23px] max-md:mt-[23px]">
                    <div class="flex flex-col w-full h-fill gap-[20px]" id="page_1">
                        <p class="text-base text-neutral-950">Tanggal Pemeriksaan<span class="text-red-400">*</span></p>
                        <div class="grid grid-cols-3 w-1/2">
                            <input name="day" id="date" class="w-100 border-stone-400 text-black-300 text-sm font-normal pl-[10px] lg:px-[31px] py-[10px] rounded-[5px] focus:outline-none disabled:bg-transparent" value="{{ now()->day }}" disabled>
                            
                            <input name="month" id="month" class="w-100 border-stone-400 text-black-300 text-sm font-normal pl-[10px] lg:px-[31px] py-[10px] rounded-[5px] focus:outline-none disabled:bg-transparent" value="{{ now()->month }}" disabled>
                            
                            <input name="year" id="year" class="w-100 border-stone-400 text-black-300 text-sm font-normal pl-[10px] lg:px-[31px] py-[10px] rounded-[5px] focus:outline-none disabled:bg-transparent" value="{{ now()->year }}" disabled>
                        </div>
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px]" id="page_1">
                    {{-- <div class="grid grid-cols-3 w-full h-fill gap-[20px]" id="page_1"> --}}
                        <p class="text-base text-neutral-950 pr-[10px]">Nama Ayah</p>
                        {{-- <p class="text-base text-neutral-950 pr-[10px] w-1/2 -ml-20">:</p> --}}
                        {{-- <p class="text-base text-neutral-950 pr-[10px] -ml-56" id="ayah"></p> --}}
                        <input type="text" id="ayah" class="w-100 text-sm font-normal border border-stone-300 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-400 cursor-not-allowed" placeholder="Otomatis terisi setelah memilih nama bayi" disabled>
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px]" id="page_1">
                    {{-- <div class="grid grid-cols-3 w-full h-fill gap-[20px]" id="page_1"> --}}
                        <p class="text-base text-neutral-950 pr-[10px]">Alamat</p>
                        {{-- <p class="text-base text-neutral-950 pr-[10px] w-1/2 -ml-20">:</p> --}}
                        {{-- <p class="text-base text-neutral-950 pr-[10px] -ml-56" id="alamat"></p> --}}
                        <input type="text" id="alamat" class="w-100 text-sm font-normal border border-stone-300 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-400 cursor-not-allowed" placeholder="Otomatis terisi setelah memilih nama bayi" disabled>
                    </div>
                    {{-- <div class="flex flex-col w-full h-full gap-[20px]" id="page_1">
                        <p class="text-base text-neutral-950 pr-[10px]">Respon Pengunjung<span class="text-red-400">*</span></p>
                        <textarea type="text" name="respon" id="comment" class="text-sm font-normal border border-stone-400 px-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" rows="5" maxlength="200" placeholder="Masukkan respon pengunjung"></textarea>
                        <p class="text-xs font-normal text-stone-400 mt-[-10px]" id="counter">0/200</p>
                    </div> --}}
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950 pr-[10px]">Tinggi Badan<span class="text-red-400">*</span></p>
                        <input type="number" step="any" name="tinggi_badan" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan tinggi badan" required>
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950 pr-[10px]">Status Kesehatan?<span class="text-red-400">*</span></p>
                        <div class="flex items-center gap-10">
                            <input type="radio" class="indeterminate:outline-2 indeterminate:outline-stone-400 indeterminate:w-4 indeterminate:py-[6px] checked:w-4 checked:outline-2 checked:border-transparent -mr-[25px]" name="status" value="sehat" id="option1" required><span>Sehat</span>
                            <input type="radio" class="indeterminate:outline-2 indeterminate:outline-stone-400 indeterminate:w-4 indeterminate:py-[6px] checked:w-4 checked:outline-2 checked:bg-red-400 -mr-[25px]" name="status" value="sakit" id="option2" required><span>Sakit</span>
                        </div>
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950 pr-[10px]">Apakah Ada Kenaikan?<span class="text-red-400">*</span></p>
                        <div class="flex items-center gap-10">
                            <input type="radio" class="indeterminate:outline-2 indeterminate:outline-stone-400 indeterminate:w-4 indeterminate:py-[6px] checked:w-4 checked:outline-2 checked:border-transparent -mr-[25px]" name="kenaikan" value="iya" id="option1" required><span>Ya</span>
                            <input type="radio" class="indeterminate:outline-2 indeterminate:outline-stone-400 indeterminate:w-4 indeterminate:py-[6px] checked:w-4 checked:outline-2 checked:bg-red-400 -mr-[25px]" name="kenaikan" value="tidak" id="option2" required><span>Tidak</span>
                        </div>
                    </div>
                    <div class="flex flex-col w-full h-fit gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950 pr-[10px]">ASI Eksklusif?<span class="text-red-400">*</span></p>
                        <div class="flex items-center gap-10">
                            <input type="radio" class="indeterminate:outline-2 indeterminate:outline-stone-400 indeterminate:w-4 indeterminate:py-[6px] checked:w-4 checked:outline-2 checked:border-transparent -mr-[25px]" name="asi" value="iya" id="option1" required><span>Ya</span>
                            <input type="radio" class="indeterminate:outline-2 indeterminate:outline-stone-400 indeterminate:w-4 indeterminate:py-[6px] checked:w-4 checked:outline-2 checked:bg-red-400 -mr-[25px]" name="asi" value="tidak" id="option2" required><span>Tidak</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 mx-10 gap-x-[101px] pb-[30px]">
                <div class="col-span-2 md:col-span-1 flex flex-col w-full h-fill gap-[20px]" id="page_1">
                    <p class="text-base text-neutral-950 pr-[10px]">Data KB<span class="text-red-400">*</span></p>
                    <input name="data_kb" id="data_kb" class="w-100 border border-stone-400 text-gray-300 text-sm font-normal pl-[10px] py-[10px] rounded-[5px] focus:outline-none" required>
                </div>
                <span id="page_2" class="col-span-1 hidden md:hidden"></span>                
                <div class="col-span-2 md:col-span-1 flex justify-end items-center gap-[26px] pt-10 w-full">
                    <p class="text-xs"><span class="text-red-400">*</span>Wajib diisi</p>
                    <a href="{{ url('kader/bayi')}}" class="bg-gray-300 text-neutral-950 font-bold text-base py-[5px] px-[19px] rounded-[5px]" id="page_1">Kembali</a>
                    <button type="button" class="bg-gray-300 text-neutral-950 font-bold text-base py-[5px] px-[19px] rounded-[5px] hidden back" id="page_2">Kembali</button>
                    <button type="button" class="bg-blue-700 text-white font-bold text-base py-[5px] px-[19px] rounded-[5px]" id="next">Lanjut</button>
                    <button type="submit" class="bg-blue-700 text-white font-bold text-base py-[5px] px-[19px] rounded-[5px] hidden" id="page_2">Simpan Data</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script>
        let counter = document.getElementById('counter')
        let total = document.getElementById('comment')
        let character = 0;

        function full(){
            if(character === 200){
                counter.classList.remove("text-stone-400");
                counter.classList.add("text-red-400");
            } else {
                counter.classList.remove("text-red-400");
                counter.classList.add("text-stone-400");
            }
        }

        // total.addEventListener("input", function() {
        //     character = total.value.length
        //     counter.innerText = character+"/200";
        //     full();
        // });

        function togglePages(page1, page2) {
            page1.forEach(function(page) {
                page.classList.toggle('hidden');
            });
            page2.forEach(function(page) {
                page.classList.toggle('hidden');
            });
        }

        let button = document.getElementById('next');
        let back = document.querySelector('.back');
        let page1 = document.querySelectorAll('#page_1');
        let page2 = document.querySelectorAll('#page_2');

        button.addEventListener('click', function() {
            button.classList.add('hidden')
            togglePages(page1, page2);
        });

        back.addEventListener('click', function() {
            button.classList.remove('hidden')
            togglePages(page1, page2);
        });
    </script>
    <script>
        document.getElementById('penduduk_id').addEventListener('change', function() {
            let bayis = @json($bayisData);
            let parents = @json($parentsData);
            let bayi;

            for (let i = 0; i < bayis.length; i++) {
                if (bayis[i].penduduk_id.toString() === this.value) {
                    document.getElementById('alamat').innerText = bayis[i].alamat;
                    document.getElementById('alamat').value = bayis[i].alamat;
                    let tgl_lahir = new Date(bayis[i].tgl_lahir);
                    let sekarang = new Date();
                    let bulan = (sekarang.getFullYear() - tgl_lahir.getFullYear()) * 12;
                    bulan -= tgl_lahir.getMonth();
                    bulan += sekarang.getMonth();
                    document.getElementById('usia1').innerText = bulan + " bulan";
                    document.getElementById('usia1').value = bulan + " bulan";
                    // document.getElementById('usia2').innerText = bulan + " bulan";
                    // document.getElementById('usia2').value = bulan + " bulan";
                    bayi = bayis[i].NKK;
                }
            }

            for (let i = 0; i < parents.length; i++) {
                if (parents[i].NKK === bayi) {
                    console.log(parents[i].NKK, bayi);
                    if (parents[i].hubungan_keluarga === 'Istri') {
                        // document.getElementById('ibu').innerText = parents[i].nama;
                        document.getElementById('ibu').value = parents[i].nama;
                        break;
                    } else {
                        // document.getElementById('ibu').innerText = "Data Ibu tidak ditemukan";
                        document.getElementById('ibu').value = "Data Ibu tidak ditemukan";
                    }
                }
            }

            for (let i = 0; i < parents.length; i++) {
                if (parents[i].NKK === bayi) {
                    console.log(parents[i].NKK, bayi);
                    if (parents[i].hubungan_keluarga === 'Kepala Keluarga') {
                        // document.getElementById('ayah').innerText = parents[i].nama;
                        document.getElementById('ayah').value = parents[i].nama;
                        break;
                    } else {
                        // document.getElementById('ayah').innerText = "Data Ayah tidak ditemukan";
                        document.getElementById('ayah').value = "Data Ayah tidak ditemukan";
                    }
                }
            }
        });
    </script>

@endpush
