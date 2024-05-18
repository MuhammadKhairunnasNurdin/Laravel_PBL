@extends('promosi.template')

@section('content')
    <div class="flex flex-col mx-[185px] my-[30px] rounded-md">
        <p class="font-bold text-[30px] text-center">Jadwal Kegiatan Selanjutnya</p>
        <div class="flex mt-[30px] mx-10 gap-[30px]">
            <div class="flex w-full h-full items-center align-middle">
                <p class="text-base text-neutral-950 text-center pr-[10px]">Cari:</p>
                <div class="relative flex">
                    <input type="text" class="w-100 border border-stone-400 bg-transparent text-sm font-normal pl-[10px] pr-28 py-[10px] rounded-[5px] focus:outline-none placeholder:text-neutral-950" id="search" name="search" placeholder="Cari kegiatan di sini">
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>                      
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="model" id="model" value="{{encrypt('App\Models\Kegiatan')}}">
        <input type="hidden" name="url" id="url" value="{{encrypt('/jadwal/kegiatan/')}}">
        <input type="hidden" name="filterName" id="filterName" value="{{encrypt('kegiatan_id')}}">

        <div class="mx-10 my-[20px]">
            <table class=" border-collapse w-full rounded-t-[10px] overflow-hidden" id="kegiatan_table">
                <thead class="bg-gray-300 border-b text-left py-5">
                    <tr class=" text-white rounded-lg">
                        <th class="font-normal text-sm py-2">Nama Kegiatan</th>
                        <th class="font-normal text-sm py-2">Tanggal Kegiatan</th>
                        <th class="font-normal text-sm py-2">Pukul</th>
                        <th class="font-normal text-sm py-2">Tempat Pelaksanaan</th>
                        <th class="font-normal text-sm py-2">Aksi</th>
                    </tr>
                </thead>
                {{-- <tbody class="">
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Imunisasi Polio</td>
                        <td class="font-normal text-sm">1 April 2024</td>
                        <td class="font-normal text-sm">08:00-selesai</td>
                        <td class="font-normal text-sm">Posyandu Delima Merah</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                            </div>
                        </td>
                    </tr>          
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Imunisasi Polio</td>
                        <td class="font-normal text-sm">1 April 2024</td>
                        <td class="font-normal text-sm">08:00-selesai</td>
                        <td class="font-normal text-sm">Posyandu Delima Merah</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                            </div>
                        </td>
                    </tr>          
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Imunisasi Polio</td>
                        <td class="font-normal text-sm">1 April 2024</td>
                        <td class="font-normal text-sm">08:00-selesai</td>
                        <td class="font-normal text-sm">Posyandu Delima Merah</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                            </div>
                        </td>
                    </tr>      
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Imunisasi Polio</td>
                        <td class="font-normal text-sm">1 April 2024</td>
                        <td class="font-normal text-sm">08:00-selesai</td>
                        <td class="font-normal text-sm">Posyandu Delima Merah</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                            </div>
                        </td>
                    </tr>          
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Imunisasi Polio</td>
                        <td class="font-normal text-sm">1 April 2024</td>
                        <td class="font-normal text-sm">08:00-selesai</td>
                        <td class="font-normal text-sm">Posyandu Delima Merah</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                            </div>
                        </td>
                    </tr>         
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Imunisasi Polio</td>
                        <td class="font-normal text-sm">1 April 2024</td>
                        <td class="font-normal text-sm">08:00-selesai</td>
                        <td class="font-normal text-sm">Posyandu Delima Merah</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                            </div>
                        </td>
                    </tr>          
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Imunisasi Polio</td>
                        <td class="font-normal text-sm">1 April 2024</td>
                        <td class="font-normal text-sm">08:00-selesai</td>
                        <td class="font-normal text-sm">Posyandu Delima Merah</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                            </div>
                        </td>
                    </tr>          
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Imunisasi Polio</td>
                        <td class="font-normal text-sm">1 April 2024</td>
                        <td class="font-normal text-sm">08:00-selesai</td>
                        <td class="font-normal text-sm">Posyandu Delima Merah</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                            </div>
                        </td>
                    </tr>          
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Imunisasi Polio</td>
                        <td class="font-normal text-sm">1 April 2024</td>
                        <td class="font-normal text-sm">08:00-selesai</td>
                        <td class="font-normal text-sm">Posyandu Delima Merah</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                            </div>
                        </td>
                    </tr>          
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Imunisasi Polio</td>
                        <td class="font-normal text-sm">1 April 2024</td>
                        <td class="font-normal text-sm">08:00-selesai</td>
                        <td class="font-normal text-sm">Posyandu Delima Merah</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
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
        border-bottom: 1px solid #A8A29E;
    }
    #ubah, #hapus {
        display: none;
    }
</style>
@endpush

@push('js')
    <!-- jQuery Reload -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- DataTable Reload-->
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            let dataKegiatan = $('#kegiatan_table').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ route('jadwal.list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d._token = "{{ csrf_token() }}";
                        d.filterValue = $('#filterValue').val();
                        d.model = $('#model').val();
                        d.url = $('#url').val();
                        d.filterName = $('#filterName').val();
                    }
                },
                columns: [
                    {
                        data: "nama",
                        className: "font-normal text-smr",
                        width: 300,
                        orderable: false,
                        searchable: true
                    }, {
                        data: "tgl_kegiatan",
                        className: "font-normal text-sm",
                        orderable: true,
                        searchable: true
                    }, {
                        data: "jam_mulai",
                        className: "font-normal text-sm",
                        orderable: false,
                        searchable: false,
                    }, {
                        data: "tempat",
                        className: "font-normal text-sm",
                        orderable: false,
                        searchable: false,
                    }, {
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $('#filterValue').on('change', function() {
                dataKegiatan.ajax.reload();
            });
        });
    </script>
@endpush