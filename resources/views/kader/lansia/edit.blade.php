@extends('kader.layouts.template')

@section('content')
    <form action="{{url('kader/lansia/' . $lansiaData->pemeriksaan_id)}}" method="post">
        @csrf
        <!--add 'PUT' method, because we use Route::put() for update-->
        {!! method_field('PUT') !!}

        <input type="hidden" name="pemeriksaan_lansia" value="{{$lansiaData->pemeriksaan_lansia}}">
        <input type="hidden" name="pemeriksaan" value="{{ json_encode([
            'tgl_pemeriksaan' => $lansiaData->tgl_pemeriksaan,
            'golongan' => $lansiaData->golongan,
            'kader_id' => $lansiaData->kader_id,
            'berat_badan' => $lansiaData->berat_badan,
            'tinggi_badan' => $lansiaData->tinggi_badan,
            'status' => $lansiaData->status,
            'respon' => $lansiaData->respon
            ])
        }}">
        <div class="flex flex-col bg-white mx-5 my-5 shadow-[0_-4px_0_0_rgba(29,78,216,1)] rounded-md">
            <div class="flex justify-between items-center w-full py-2 border-b">
                <p class="text-lg mx-10">Form Edit Pemeriksaan Lansia</p>
            </div>

            <div class="grid grid-cols-2 my-[30px] mx-10 gap-x-[101px]">
                <div class="col-span-1 flex flex-col gap-[23px]">
                    <div class="flex flex-col w-full h-fill gap-[20px]" id="page_1">
                        <p class="text-base text-neutral-950">Nama<span class="text-red-400">*</span></p>
                        <input name="nama" id="nama" class="w-100 border border-stone-400 text-sm font-normal pl-[10px] py-[10px] rounded-[5px] focus:outline-none" value="{{$lansiaData->penduduk->nama}}" disabled>

                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950">Berat Badan<span class="text-red-400">*</span></p>
                        <input type="number" step="any" name="berat_badan" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" value="{{ $lansiaData->berat_badan}}" placeholder="Masukkan berat badan">
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px]" id="page_1">
                        <p class="text-base text-neutral-950">Usia<span class="text-red-400">*</span></p>
                        <div class="grid grid-cols-3 gap-5">
                            <input type="text" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" value="{{  now()->diffInYears($lansiaData->penduduk->tgl_lahir) . ' tahun'}}" placeholder="Masukkan usia balita" disabled>
                        </div>
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950">Tinggi Badan<span class="text-red-400">*</span></p>
                        <input type="number" step="any" name="tinggi_badan" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" value="{{ $lansiaData->tinggi_badan}}" placeholder="Masukkan tinggi badan">
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px]" id="page_1">
                        <p class="text-base text-neutral-950 pr-[10px]">Alamat<span class="text-red-400">*</span></p>
                        <input type="text" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" value="{{ $lansiaData->penduduk->alamat }}" placeholder="Masukkan alamat" disabled>
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950">Lingkar Perut<span class="text-red-400">*</span></p>
                        <input type="number" step="any" name="lingkar_perut" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" value="{{$lansiaData->pemeriksaan_lansia->lingkar_perut}}" placeholder="Masukkan lingkar perut">
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950">Tensi Darah<span class="text-red-400">*</span></p>
                        <div class="flex gap-x-5 items-center me-[337px]">
                            {{--<input type="text" class=" w-[83px] text-sm text-center font-normal border border-stone-400 py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Sistolik">
                            <span class="w-fit">/</span>
                            <input type="text" class=" w-[83px] text-sm text-center font-normal border border-stone-400 py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Diastolik">--}}
                            <input type="number" name="tensi_darah" class=" w-[83px] text-sm text-center font-normal border border-stone-400 py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="tensi_darah" value="{{$lansiaData->pemeriksaan_lansia->tensi_darah}}">
                        </div>
                    </div>
                </div>

                <div class="col-span-1 flex flex-col gap-[23px]">
                    <div class="flex flex-col w-full h-full gap-[20px]" id="page_1">
                        <p class="text-base text-neutral-950 pr-[10px]">Respon Pengunjung<span class="text-red-400">*</span></p>
                        <textarea type="text" name="respon" id="comment" class="text-sm font-normal border border-stone-400 px-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" rows="5" maxlength="200" placeholder="Masukkan respon pengunjung">{{ $lansiaData->respon }}</textarea>
                        <p class="text-xs font-normal text-stone-400 mt-[-10px]" id="counter">0/200</p>
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950">Gula Darah<span class="text-red-400">*</span></p>
                        <input type="number" name="gula_darah" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" value="{{ $lansiaData->pemeriksaan_lansia->gula_darah}}" placeholder="Masukkan gula darah">
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950">Asam Urat<span class="text-red-400">*</span></p>
                        <input type="number" step="any" name="asam_urat" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" value="{{ $lansiaData->pemeriksaan_lansia->asam_urat}}" placeholder="Masukkan asam urat">
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950">Kolesterol<span class="text-red-400">*</span></p>
                        <input type="number" name="kolesterol" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" value="{{ $lansiaData->pemeriksaan_lansia->kolesterol }}" placeholder="Masukkan kolesterol">
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                        <p class="text-base text-neutral-950 pr-[10px]">Status Kesehatan?<span class="text-red-400">*</span></p>
                        <div class="flex gap-10">
                            @if($lansiaData->status === 'sehat')
                                <input type="radio" class="indeterminate:outline-2 indeterminate:outline-stone-400 indeterminate:w-4 indeterminate:py-[20px] rounded-[5px] checked:w-4 checked:outline-2 checked:bg-red-400 checked:border-transparent -mr-[25px]" name="status"  value="sehat" id="option1" checked><span>Sehat</span>
                                <input type="radio" class="indeterminate:outline-2 indeterminate:outline-stone-400 indeterminate:w-4 indeterminate:py-[20px] checked:w-4 checked:outline-2 -mr-[25px]" name="status" value="sakit" id="option2"><span>Sakit</span>
                            @else
                                <input type="radio" class="indeterminate:outline-2 indeterminate:outline-stone-400 indeterminate:w-4 indeterminate:py-[20px] rounded-[5px] checked:w-4 checked:outline-2 checked:bg-red-400 checked:border-transparent -mr-[25px]" name="status"  value="sehat" id="option1"><span>Sehat</span>
                                <input type="radio" class="indeterminate:outline-2 indeterminate:outline-stone-400 indeterminate:w-4 indeterminate:py-[20px] checked:w-4 checked:outline-2 -mr-[25px]" name="status" value="sakit" id="option2" checked><span>Sakit</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 mx-10 gap-x-[101px] pb-[30px]">
                <div class="flex flex-col w-full h-fill gap-[20px]" id="page_1">
                    <p class="text-base text-neutral-950">Tanggal Pemeriksaan<span class="text-red-400">*</span></p>
                    <div class="grid grid-cols-3 gap-5">
                        <select name="day" id="day" class="w-100 border border-stone-400 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none">
                            <option value="{{ date('d', strtotime($lansiaData->tgl_pemeriksaan)) }}" class="text-black-300">{{ date('d', strtotime($lansiaData->tgl_pemeriksaan)) }}</option>
                            @for ($i = 1; $i <= 31; $i++)
                                <option value="{{ $i }}" name="">{{$i}}</option>
                            @endfor
                        </select>
                        <select name="month" id="month" class="w-100 border border-stone-400 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none">
                            <option value="{{ date('m', strtotime($lansiaData->tgl_pemeriksaan)) }}" class="text-black-300">{{ date('m', strtotime($lansiaData->tgl_pemeriksaan)) }}</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" name="">{{$i}}</option>
                            @endfor
                        </select>
                        <select name="year" id="year" class="w-100 border border-stone-400 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none">
                            <option value="{{ date('Y', strtotime($lansiaData->tgl_pemeriksaan)) }}" class="text-black-300">{{ date('Y', strtotime($lansiaData->tgl_pemeriksaan)) }}</option>
                            @for ($i = 2024; $i <= 2050; $i++)
                                <option value="{{ $i }}" name="">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="flex flex-col w-full h-fill gap-[20px] hidden" id="page_2">
                   {{-- <p class="text-base text-neutral-950">Tensi Darah<span class="text-red-400">*</span></p>
                    <div class="flex gap-x-5 items-center me-[337px]">
                        --}}{{--<input type="text" class=" w-[83px] text-sm text-center font-normal border border-stone-400 py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Sistolik">
                        <span class="w-fit">/</span>
                        <input type="text" class=" w-[83px] text-sm text-center font-normal border border-stone-400 py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Diastolik">--}}{{--
                        <input type="text" name="tensi_darah" class=" w-[83px] text-sm text-center font-normal border border-stone-400 py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="tensi_darah" value="{{$lansiaData->pemeriksaan_lansia->tensi_darah}}">--}}
                    {{--</div>--}}
                </div>
                <div class="col-span-1 flex justify-end items-center gap-[26px] pt-10 w-full">
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

        button.addEventListener("click", function () {
            button.classList.add('hidden');
            togglePages(page1, page2);
        });

        back.addEventListener("click", function () {
            button.classList.remove('hidden');
            togglePages(page1, page2);
        });
    </script>
@endpush
