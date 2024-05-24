@extends('kader.layouts.template')

@section('content')
    <form action="{{ route('kegiatan.store') }}" method="post">
        @csrf
        <div class="flex flex-col bg-white mx-5 my-5 rounded-md">
            <div class="grid grid-cols-2 my-[30px] mx-10 gap-x-[101px]">
                <div class="col-span-1 flex flex-col gap-[23px]">
                    <div class="flex flex-col w-full h-fill gap-[20px]">
                        <p class="text-base text-neutral-950">Nama Kegiatan</p>
                        <input type="text" name="nama" value="{{old('nama')}}" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan nama kegiatan">
                        @error('nama')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-full h-fill gap-[20px]">
                        <p class="text-base text-neutral-950">Tempat</p>
                        <input type="text" name="tempat" value="{{old('tempat')}}" class="w-100 text-sm font-normal border border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none placeholder:text-gray-300" placeholder="Masukkan tempat pelaksanaan">
                        @error('tempat')
                        <span class="text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-span-1 flex flex-col gap-[23px]">
                    <div class="flex flex-col w-full h-fill gap-[23px]">
                        <p class="text-base text-neutral-950">Tanggal Kegiatan</p>
                        <div class="grid grid-cols-3 gap-5">
                            {{--<select name="day" id="day" class="w-100 border border-stone-400 text-black-300 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none">
                                <option value="" class="text-black-300">Tanggal</option>
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}" class="text-neutral-950">{{$i}}</option>
                                @endfor
                            </select>
                            <select name="month" id="month" class="w-100 border border-stone-400 text-black-300 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none">
                                <option value="">Bulan</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" class="text-neutral-950">{{$i}}</option>
                                @endfor
                            </select>
                            <select name="year" id="year" class="w-100 border border-stone-400 text-black-300 text-sm font-normal pl-[10px] px-[31px] py-[10px] rounded-[5px] focus:outline-none">
                                <option value="">Tahun</option>
                                @for ($i = 2024; $i <= 2050; $i++)
                                    <option value="{{ $i }}" class="text-neutral-950">{{$i}}</option>
                                @endfor
                            </select>--}}

                            <input type="date" step="any" name="tgl_kegiatan" value="{{old('tgl_kegiatan')}}" class="w-100 text-sm font-normal {{old('tgl_kegiatan') ? 'text-black-400' : 'text-gray-300'}}  border-stone-400 pl-[10px] py-[10px] rounded-[5px] focus:outline-none" id="tanggal" required>
                            @error('tgl_kegiatan')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col w-full h-fill gap-[20px]">
                            <p class="text-base text-neutral-950">Pukul Kegiatan</p>
                            <div class="flex gap-x-5 items-center me-[300px]">
                                <input type="time" id="timeInput" pattern="[0-9]{2}:[0-9]{2}" name="jam_mulai" value="{{old('jam_mulai')}}" id="timeInput" class="w-full text-sm text-center font-normal border border-stone-400 py-[10px] px-1.5 rounded-[5px] decoration-none focus:outline-none placeholder:text-gray-300" placeholder="Jam Mulai">
                                <span class="w-fit">-</span>
                                <span class="w-fit">Selesai</span>
                                @error('jam_mulai')
                                <span class="text-red-500">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end items-end gap-[26px] px-[50px] pb-10 w-full h-full">
                <a href="{{ url('kader/informasi')}}" class="bg-gray-300 text-neutral-950 font-bold text-base py-[10px] px-[10px] rounded-[5px]">Kembali</a>
                <button type="submit" class="bg-blue-700 text-white font-bold text-base py-[10px] px-[10px] rounded-[5px]">Simpan</button>
            </div>
        </div>
    </form>
@endsection

@push('js')
   {{-- <script>
        document.getElementById('timeInput').addEventListener('input', function () {
            var timeValue = this.value.split(':');
            var hours = parseInt(timeValue[0], 10);
            var minutes = parseInt(timeValue[1], 10);

            // Ensure the hours and minutes are within bounds
            hours = (hours >= 0 && hours <= 23) ? hours : 0;
            minutes = (minutes >= 0 && minutes <= 59) ? minutes : 0;

            // Format the time in HH:MM format
            var formattedTime = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2);

            this.value = formattedTime;
        });
    </script>--}}
   <script>
       let date = document.querySelector('#tanggal');
       date.onchange = function () {
           date.classList.toggle('text-gray-300');
       }
   </script>
@endpush
