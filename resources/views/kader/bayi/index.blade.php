@extends('kader.layouts.template')

@section('content')
    <div class="flex flex-col bg-white mx-5 mt-5 shadow-[0_-4px_0_0_rgba(248,113,113,1)] rounded-md">
        <div class="flex justify-between items-center w-full py-2 border-b">
            <p class="text-lg ml-10">Daftar pemeriksaan bayi</p>
            <a href="{{ url('kader/bayi/create') }}" class="bg-blue-700 text-sm text-white font-bold py-1 px-4 mr-10 rounded">Tambah</a>
        </div>
        <div class="flex mt-[30px] mx-10 gap-[30px]">
            <div class="flex w-fit h-full items-center align-middle">
                <p class="text-base text-neutral-950 text-center pr-[10px]">Filter:</p>
                <select name="filter" id="filter" class="w-100 border border-stone-400 text-sm font-normal pl-[10px] pr-28 py-[10px] rounded-[5px] focus:outline-none">
                    <option value="" class="">Semua</option>
                </select>
            </div>
            <div class="flex w-full h-full items-center align-middle">
                <p class="text-base text-neutral-950 text-center pr-[10px]">Cari:</p>
                <div class="relative flex">
                    <input type="text" class="w-100 border border border-stone-400 text-sm font-normal pl-[10px] pr-28 py-[10px] rounded-[5px] focus:outline-none placeholder:text-neutral-950" id="search" name="search" placeholder="Cari di sini">
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-10 my-[30px]">
            <table class="border-collapse w-full rounded-t-[10px] overflow-hidden" id="bayi_table">
                <thead class="bg-gray-200 border-b text-left py-5">
                    <tr class=" text-stone-400">
                        <th class="font-normal text-sm">Nama Bayi</th>
                        <th class="font-normal text-sm">Tgl Pemeriksaan</th>
                        <th class="font-normal text-sm">Usia</th>
                        <th class="font-normal text-sm">Kategori Umur</th>
                        <th class="font-normal text-sm">Berat</th>
                        <th class="font-normal text-sm">Tinggi</th>
                        <th class="font-normal text-sm">Status</th>
                        <th class="font-normal text-sm">Aksi</th>
                    </tr>
                </thead>
                {{-- <tbody class="">
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Alvino Hermawan</td>
                        <td class="font-normal text-sm">1 April 2024</td>
                        <td class="font-normal text-sm">14 Bulan</td>
                        <td class="font-normal text-sm">Balita</td>
                        <td class="font-normal text-sm">5 kg</td>
                        <td class="font-normal text-sm">70 cm</td>
                        <td class="font-normal text-sm">Sehat</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="{{ url('kader/bayi/show')}}" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600">Detail</a>
                                <a href="" class="bg-yellow-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-yellow-500">Ubah</a>
                                <a href="" class="bg-red-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-red-600 hover:text-white">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Alvino Hermawan</td>
                        <td class="font-normal text-sm">1 April 2024</td>
                        <td class="font-normal text-sm">14 Bulan</td>
                        <td class="font-normal text-sm">Balita</td>
                        <td class="font-normal text-sm">5 kg</td>
                        <td class="font-normal text-sm">70 cm</td>
                        <td class="font-normal text-sm">Sehat</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="{{ url('kader/bayi/show')}}" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600">Detail</a>
                                <a href="" class="bg-yellow-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-yellow-500">Ubah</a>
                                <a href="" class="bg-red-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-red-600 hover:text-white">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Alvino Hermawan</td>
                        <td class="font-normal text-sm">17 April 2022</td>
                        <td class="font-normal text-sm">2 Tahun</td>
                        <td class="font-normal text-sm">Baduta</td>
                        <td class="font-normal text-sm">5 kg</td>
                        <td class="font-normal text-sm">70 cm</td>
                        <td class="font-normal text-sm">Sehat</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="{{ url('kader/bayi/show')}}" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600">Detail</a>
                                <a href="" class="bg-yellow-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-yellow-500">Ubah</a>
                                <a href="" class="bg-red-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-red-600 hover:text-white">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Alvino Hermawan</td>
                        <td class="font-normal text-sm">1 April 2024</td>
                        <td class="font-normal text-sm">14 Bulan</td>
                        <td class="font-normal text-sm">Balita</td>
                        <td class="font-normal text-sm">5 kg</td>
                        <td class="font-normal text-sm">70 cm</td>
                        <td class="font-normal text-sm">Sehat</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="{{ url('kader/bayi/show')}}" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600">Detail</a>
                                <a href="" class="bg-yellow-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-yellow-500">Ubah</a>
                                <a href="" class="bg-red-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-red-600 hover:text-white">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Alvino Hermawan</td>
                        <td class="font-normal text-sm">1 April 2024</td>
                        <td class="font-normal text-sm">14 Bulan</td>
                        <td class="font-normal text-sm">Balita</td>
                        <td class="font-normal text-sm">5 kg</td>
                        <td class="font-normal text-sm">70 cm</td>
                        <td class="font-normal text-sm">Sehat</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="{{ url('kader/bayi/show')}}" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600">Detail</a>
                                <a href="" class="bg-yellow-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-yellow-500">Ubah</a>
                                <a href="" class="bg-red-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-red-600 hover:text-white">Hapus</a>
                            </div>
                        </td>
                    </tr>
                </tbody> --}}
            </table>
        </div>
    </div>
@endsection

@push('css')
<style>
    th, td {
        padding-inline: 20px;
        padding-block: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
</style>
@endpush

@push('js')
<!-- Memuat jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<!-- Memuat DataTable -->
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>

<script>
        $(document).ready(function () {
            var dataUser = $('#bayi_table').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ route('bayi.list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d._token = "{{ csrf_token() }}"
                    }
                },
                columns: [
                    {
                        data: "penduduk.nama",    
                        className: "font-normal text-smr",
                        orderable: false,
                        searchable: false
                    },{
                        data: "tgl_pemeriksaan",
                        className: "font-normal text-sm",
                        orderable: true,    
                        searchable: true    
                    },{
                        data: null, 
                        className: "font-normal text-sm",
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            // Menghitung umur dalam bulan
                            var tglLahir = new Date(data.penduduk.tgl_lahir);
                            var sekarang = new Date();
                            var bulan = (sekarang.getFullYear() - tglLahir.getFullYear()) * 12;
                            bulan -= tglLahir.getMonth();
                            bulan += sekarang.getMonth();
                            return bulan + " bulan";
                        }
                    },{
                        data: "golongan",
                        className: "font-normal text-sm",
                        orderable: false,   
                        searchable: false, 
                    },{
                        data: "berat_badan",
                        className: "font-normal text-sm",
                        orderable: false,  
                        searchable: false, 
                    },{
                        data: "tinggi_badan",
                        className: "font-normal text-sm",
                        orderable: false,  
                        searchable: false, 
                    },{
                        data: "status",
                        className: "font-normal text-sm",
                        orderable: false,  
                        searchable: false, 
                    },{
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // $('#level_id').on('change', function() {
            //     dataUser.ajax.reload();
            // });
        });
    </script>
@endpush
