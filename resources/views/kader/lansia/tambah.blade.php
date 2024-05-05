@extends('kader.layouts.template')

@section('content')
    <form action="{{route('lansia.store')}}" method="post">
        @csrf
        <div class="flex flex-col bg-white mx-5 my-5 shadow-[0_-4px_0_0_rgba(29,78,216,1)] rounded-md">
            <div class="flex justify-between items-center w-full py-2 border-b">
                <p class="text-lg mx-10">Form Pemeriksaan Lansia</p>
            </div>

            <div class="grid grid-cols-2 my-[30px] mx-10 gap-x-[101px]">
                <div class="col-span-1 flex flex-col gap-[23px]">
                    <div class="flex flex-col w-full h-fill gap-[20px]" id="page_1">
                        <p class="text-base text-neutral-950">Nama<span class="text-red-400">*</span></p>
                        <select id="penduduk_id" name="penduduk_id" class="w-100 border border-stone-400 placeholder:text-gray-300 text-sm font-normal pl-[10px] pr-[300px] py-[10px] rounded-[5px] focus:outline-none">
                            <option value="" class="">Masukkan nama</option>
                            @foreach($lansiasData as $lansia)
                                <option value="{{ $lansia->penduduk_id }}">{{ $lansia->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950">Berat Badan<span class="text-red-400">*</span></p>
                        <input type="number" step="any" name="berat_badan" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan berat badan">
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px]" id="page_1">
                        <p class="text-base text-neutral-950">Usia<span class="text-red-400">*</span></p>
                        <input type="text" id="usia" class="w-100 text-sm font-normal border border-stone-300 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-400 cursor-not-allowed" placeholder="Otomatis terisi setelah memilih nama warga" disabled>
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950">Tinggi Badan<span class="text-red-400">*</span></p>
                        <input type="number" step="any" name="tinggi_badan" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan tinggi badan">
                    </div>
                  {{--  <div class="flex flex-col w-full h-fill gap-[20px]" id="page_1">
                        <p class="text-base text-neutral-950 pr-[10px]">Alamat<span class="text-red-400">*</span></p>
                        <input type="text" id="alamat" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] pr-[300px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan alamat" disabled>
                    </div>--}}
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950">Lingkar Perut<span class="text-red-400">*</span></p>
                        <input type="number" step="any" name="lingkar_perut" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan lingkar perut">
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950">Tensi Darah<span class="text-red-400">*</span></p>
                        <div class="flex gap-x-5 items-center me-[337px]">
                            <input type="number" name="tensi_darah" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="masukan tensi">
                            {{--<span class="w-fit">/</span>
                            <input type="text" class=" w-[83px] text-sm text-center font-normal border border-stone-400 py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Diastolik">--}}
                        </div>
                    </div>
                </div>

                <div class="col-span-1 flex flex-col gap-[23px]">
                    <div class="flex flex-col w-full h-fill gap-[20px]" id="page_1">
                        <p class="text-base text-neutral-950">Tanggal Pemeriksaan<span class="text-red-400">*</span></p>
                        <div class="grid grid-cols-3 gap-5">
                            <input name="day" id="date" class="w-100 border border-none text-black-300 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none disabled:bg-transparent" value="{{ now()->day }}" disabled>
    
                            <input name="month" id="month" class="w-100 border border-none text-black-300 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none disabled:bg-transparent" value="{{ now()->month }}" disabled>
    
                            <input name="year" id="year" class="w-100 border border-none text-black-300 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none disabled:bg-transparent" value="{{ now()->year }}" disabled>
                        </div>
                    </div>
                    
                    <div class="flex flex-col w-full h-fill gap-[20px]" id="page_1">
                        <p class="text-base text-neutral-950 pr-[10px]">Alamat<span class="text-red-400">*</span></p>
                        <input type="text" id="alamat" class="w-100 text-sm font-normal border border-stone-300 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-400 cursor-not-allowed" placeholder="Otomatis terisi setelah memilih nama warga" disabled>
                    </div>
                    {{-- <div class="flex flex-col w-full h-full gap-[20px]" id="page_1">
                        <p class="text-base text-neutral-950 pr-[10px]">Respon Pengunjung<span class="text-red-400">*</span></p>
                        <textarea type="text" name="respon" id="comment" class="text-sm font-normal border border-stone-400 px-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" rows="5" maxlength="200" placeholder="Masukkan respon pengunjung"></textarea>
                        <p class="text-xs font-normal text-stone-400 mt-[-10px]" id="counter">0/200</p>
                    </div> --}}
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950">Gula Darah<span class="text-red-400">*</span></p>
                        <input type="number" name="gula_darah" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan gula darah">
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950">Asam Urat<span class="text-red-400">*</span></p>
                        <input type="number" step="any" name="asam_urat" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan asam urat">
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950">Kolesterol<span class="text-red-400">*</span></p>
                        <input type="number" name="kolesterol" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan kolesterol">
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950 pr-[10px]">Status Kesehatan?<span class="text-red-400">*</span></p>
                        <div class="flex items-center gap-10">
                            <input type="radio" class="indeterminate:outline-2 indeterminate:outline-stone-400 indeterminate:w-4 indeterminate:py-[6px] checked:w-4 checked:outline-2 checked:border-transparent -mr-[25px]" name="status" value="sehat" id="option1" required><span>Sehat</span>
                            <input type="radio" class="indeterminate:outline-2 indeterminate:outline-stone-400 indeterminate:w-4 indeterminate:py-[6px] checked:w-4 checked:outline-2 checked:bg-red-400 -mr-[25px]" name="status" value="sakit" id="option2" required><span>Sakit</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 mx-10 gap-x-[101px] pb-[30px]">
               
                <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                    {{--<p class="text-base text-neutral-950">Tensi Darah<span class="text-red-400">*</span></p>
                    <div class="flex gap-x-5 items-center me-[337px]">
                        <input type="number" name="tensi_darah" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="masukan tensi">
                        --}}{{--<span class="w-fit">/</span>
                        <input type="text" class=" w-[83px] text-sm text-center font-normal border border-stone-400 py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Diastolik">--}}{{--
                    </div>--}}
                </div>
                <div class="col-span-2 flex justify-end items-center gap-[26px] w-full">
                    <p class="text-xs"><span class="text-red-400">*</span>Wajib diisi</p>
                    <a href="{{ url('kader/lansia')}}" class="bg-gray-300 text-neutral-950 font-bold text-base py-[5px] px-[19px] rounded-[5px]" id="page_1">Kembali</a>
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
                counter.classList.add("text-stone-400")
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

        button.addEventListener("click", function() {
            button.classList.add('hidden')
            togglePages(page1, page2);
        });

        back.addEventListener("click", function() {
            button.classList.remove('hidden')
            togglePages(page1, page2);
        });
    </script>

    <script>
        document.getElementById('penduduk_id').addEventListener('change', function() {
            let lansias = @json($lansiasData)

            for (let i = 0; i < lansias.length; i++) {
                if (lansias[i].penduduk_id.toString() === this.value) {
                    document.getElementById('alamat').value = lansias[i].alamat;
                    let tgl_lahir = new Date(lansias[i].tgl_lahir);
                    let sekarang = new Date();
                    document.getElementById('usia').value = (sekarang.getFullYear() - tgl_lahir.getFullYear()) + " tahun";
                }
            }
        });
    </script>

@endpush
