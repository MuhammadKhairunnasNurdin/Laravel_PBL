@extends('kader.layouts.template')

@section('content')
    <div class="flex flex-col bg-white mx-5 my-5 shadow-[0_-4px_0_0_rgba(29,78,216,1)] rounded-md">
        <div class="flex justify-between items-center w-full py-2 border-b">
            <p class="text-lg mx-10">Form Pemeriksaan Lansia</p>
        </div>

        <div class="grid grid-cols-2 my-[30px] mx-10 gap-x-[101px]">
            <div class="col-span-1 flex flex-col gap-[23px]">
                <div class="flex flex-col w-full h-fill gap-[20px]" id="page_1">
                    <p class="text-base text-neutral-950">Nama<span class="text-red-400">*</span></p>
                    <select name="filter" id="filter" class="w-100 border border-stone-400 text-gray-300 text-sm font-normal pl-[10px] pr-[300px] py-[10px] rounded-[5px] focus:outline-none">
                        <option value="" class="">Masukkan nama</option>
                    </select>
                </div>
                <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                    <p class="text-base text-neutral-950">Berat Badan<span class="text-red-400">*</span></p>
                    <input type="text" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan berat badan">
                </div>
                <div class="flex flex-col w-full h-fill gap-[20px]" id="page_1">
                    <p class="text-base text-neutral-950">Tanggal Lahir<span class="text-red-400">*</span></p>
                    <div class="grid grid-cols-3 gap-5">
                        <select name="date" id="date" class="w-100 border border-stone-400 text-gray-300 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none">
                            <option value="">Tanggal</option>
                            @for ($i = 1; $i <= 31; $i++)
                                <option value="{{ $i }}" name="">{{$i}}</option>
                            @endfor
                        </select>
                        <select name="month" id="month" class="w-100 border border-stone-400 text-gray-300 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none">
                            <option value="">Bulan</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" name="">{{$i}}</option>
                            @endfor
                        </select>
                        <select name="year" id="year" class="w-100 border border-stone-400 text-gray-300 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none">
                            <option value="">Tahun</option>
                            @for ($i = 2000; $i <= 2050; $i++)
                                <option value="{{ $i }}" name="">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                    <p class="text-base text-neutral-950">Tinggi Badan<span class="text-red-400">*</span></p>
                    <input type="text" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan tinggi badan">
                </div>
                <div class="flex flex-col w-full h-fill gap-[20px]" id="page_1">
                    <p class="text-base text-neutral-950 pr-[10px]">Alamat<span class="text-red-400">*</span></p>
                    <input type="text" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] pr-[300px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan alamat">
                </div>
                <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                    <p class="text-base text-neutral-950">Lingkar Perut<span class="text-red-400">*</span></p>
                    <input type="text" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan lingkar perut">
                </div>
            </div>

            <div class="col-span-1 flex flex-col gap-[23px]">
                <div class="flex flex-col w-full h-full gap-[20px]" id="page_1">
                    <p class="text-base text-neutral-950 pr-[10px]">Respon Pengunjung<span class="text-red-400">*</span></p>
                    <textarea type="text" id="comment" class="text-sm font-normal border border-stone-400 px-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" rows="5" maxlength="200" placeholder="Masukkan respon pengunjung"></textarea>
                    <p class="text-xs font-normal text-stone-400 mt-[-10px]" id="counter">0/200</p>
                </div>
                <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                    <p class="text-base text-neutral-950">Gula Darah<span class="text-red-400">*</span></p>
                    <input type="text" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan gula darah">
                </div>
                <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                    <p class="text-base text-neutral-950">Asam Urat<span class="text-red-400">*</span></p>
                    <input type="text" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan asam urat">
                </div>
                <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                    <p class="text-base text-neutral-950">Kolesterol<span class="text-red-400">*</span></p>
                    <input type="text" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan kolesterol">
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 mx-10 gap-x-[101px] pb-[30px]">
            <div class="flex flex-col w-full h-fill gap-[20px]" id="page_1">
                <p class="text-base text-neutral-950">Tanggal Kunjungan<span class="text-red-400">*</span></p>
                <div class="grid grid-cols-3 gap-5">
                    <select name="date" id="date" class="w-100 border border-stone-400 text-gray-300 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none">
                        <option value="">Tanggal</option>
                        @for ($i = 1; $i <= 31; $i++)
                            <option value="{{ $i }}" name="">{{$i}}</option>
                        @endfor
                    </select>
                    <select name="month" id="month" class="w-100 border border-stone-400 text-gray-300 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none">
                        <option value="">Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" name="">{{$i}}</option>
                        @endfor
                    </select>
                    <select name="year" id="year" class="w-100 border border-stone-400 text-gray-300 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none">
                        <option value="">Tahun</option>
                        @for ($i = 2000; $i <= 2050; $i++)
                            <option value="{{ $i }}" name="">{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                <p class="text-base text-neutral-950">Tensi Darah<span class="text-red-400">*</span></p>
                <div class="flex gap-x-5 items-center me-[337px]">
                    <input type="text" class=" w-[83px] text-sm text-center font-normal border border-stone-400 py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Sistolik">
                    <span class="w-fit">/</span>
                    <input type="text" class=" w-[83px] text-sm text-center font-normal border border-stone-400 py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Diastolik">
                </div>
            </div>
            <div class="col-span-1 flex justify-end items-center gap-[26px] pt-10 w-full">
                <p class="text-xs"><span class="text-red-400">*</span>Wajib diisi</p>
                <a href="{{ url('kader/lansia')}}" class="bg-gray-300 text-neutral-950 font-bold text-base py-[5px] px-[19px] rounded-[5px]" id="page_1">Back</a>
                <button class="bg-gray-300 text-neutral-950 font-bold text-base py-[5px] px-[19px] rounded-[5px] hidden back" id="page_2">Back</button>
                <button class="bg-blue-700 text-white font-bold text-base py-[5px] px-[19px] rounded-[5px]" id="next">Next</button>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        let counter = document.getElementById('counter')
        let total = document.getElementById('comment')
        let character = 0;

        function full(){
            if(character == 200){
                counter.classList.remove("text-stone-400");
                counter.classList.add("text-red-400");
            } else {
                counter.classList.remove("text-red-400");
                counter.classList.add("text-stone-400")
            }
        }

        total.addEventListener("input", function() {
            character = total.value.length
            counter.innerText = character+"/200";
            full();
        });

        function togglePages(page1, page2, buttonText) {
            page1.forEach(function(page) {
                page.classList.toggle('hidden');
            });
            page2.forEach(function(page) {
                page.classList.toggle('hidden');
            });
            button.innerText = buttonText;
        }

        let button = document.getElementById('next');
        let back = document.querySelector('.back');
        let page1 = document.querySelectorAll('#page_1');
        let page2 = document.querySelectorAll('#page_2');

        button.addEventListener("click", function() {
            togglePages(page1, page2, "Simpan Data");
        });

        back.addEventListener("click", function() {
            togglePages(page1, page2, "Next");
        });
    </script>
@endpush
