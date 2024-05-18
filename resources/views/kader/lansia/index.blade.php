@extends('kader.layouts.template')

@section('content')
    <div class="flex flex-col bg-white mx-5 mt-5 shadow-[0_-4px_0_0_rgba(29,78,216,1)] rounded-md">
        <div class="flex justify-between items-center w-full py-2 border-b">
            <p class="text-sm md:text-lg ml-5 md:ml-10">Daftar pemeriksaan lansia</p>
            <a href="{{ url('kader/lansia/create') }}" class="bg-blue-700 text-sm text-white font-bold py-1 px-4 mr-5 md:mr-10 rounded">Tambah</a>
        </div>
        <div class="flex mt-[30px] mx-10 gap-[30px]">
            <div class="flex w-fit h-full items-center align-middle">
                <x-dropdown.dropdown-filter>Filter</x-dropdown.dropdown-filter>
                {{-- <p class="text-base text-neutral-950 text-center pr-[10px]">Filter:</p>
                <select name="filterValue" id="filterValue" class="w-100 border border-stone-400 text-sm font-normal pl-[10px] pr-28 py-[10px] rounded-[5px] focus:outline-none">
                    <option value="" class="">Pilih Kategori</option>
                    @foreach($penduduks as $filter)
                        <option value="{{ $filter->NIK }}">{{ $filter->penduduk->nama }}</option>
                    @endforeach
                </select> --}}
            </div>
            @if(session('success'))
                <div class="flex items-center p-1 mb-1 border-2 border-green-500 bg-green-100 text-green-700 rounded-md" id="message">
                    <p class="mr-4"> <b>BERHASIL</b> {{ session('success') }}</p>
                    <button id="close" class="ml-auto bg-transparent text-green-700 hover:text-green-900">
                        <span>&times;</span>
                    </button>
                </div>
            @elseif(session('error'))
                <div class="flex items-center p-4 mb-4 border-2 border-red-500 bg-red-100 text-red-700 rounded-md" id="message">
                    <p class="mr-4">{{ session('error') }}</p>
                    <button id="close" class="ml-auto bg-transparent text-red-700 hover:text-red-900">
                        <span>&times;</span>
                    </button>
                </div>
            @endif
            {{-- <div class="flex w-full h-full items-center align-middle">
                <p class="text-base text-neutral-950 text-center pr-[10px]">Cari:</p>
                <div class="relative flex">
                    <input type="text" class="w-100 border border border-stone-400 text-sm font-normal pl-[10px] pr-28 py-[10px] rounded-[5px] focus:outline-none placeholder:text-neutral-950" id="search" name="search" placeholder="Cari nama di sini">
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                </div>
            </div> --}}
        </div>

        @php
            $relationships = ['penduduk', 'pemeriksaan_lansia'];
        @endphp
        @foreach($relationships as $relationship)
            <input type="hidden" name="relationships[]" id="relationship" value="{{encrypt($relationship)}}">
        @endforeach
        <input type="hidden" name="model" id="model" value="{{encrypt('App\Models\Pemeriksaan')}}">
        <input type="hidden" name="url" id="url" value="{{encrypt('/kader/lansia/')}}">
        <input type="hidden" name="filterName" id="filterName" value="{{encrypt('NIK')}}">
        <input type="hidden" name="where" id="whereName" value="{{encrypt('golongan')}}">
        <input type="hidden" name="where" id="whereValue" value="{{encrypt('lansia')}}">

        <div class="mx-10 my-[30px]">
            <table class=" border-collapse w-full rounded-t-[10px] overflow-hidden" id="lansia_table">
                <thead class="bg-gray-200 border-b text-left py-5">
                    <tr class=" text-stone-400 rounded-lg">
                        <th class="font-normal text-sm py-2">Nama</th>
                        <th class="font-normal text-sm py-2">Tgl Pemeriksaan</th>
                        <th class="font-normal text-sm py-2">Usia</th>
                        <th class="font-normal text-sm py-2">Berat</th>
                        <th class="font-normal text-sm py-2">Tinggi</th>
                        <th class="font-normal text-sm py-2">L.Perut</th>
                        <th class="font-normal text-sm py-2">Status</th>
                        <th class="font-normal text-sm py-2">Aksi</th>
                    </tr>
                </thead>
                {{-- <tbody class="">
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Suryo Abdi</td>
                        <td class="font-normal text-sm">1 April 2024</td>
                        <td class="font-normal text-sm">58 Tahun</td>
                        <td class="font-normal text-sm">60 kg</td>
                        <td class="font-normal text-sm">160 cm</td>
                        <td class="font-normal text-sm">70 cm</td>
                        <td class="font-normal text-sm">Kurang Sehat</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="{{ url('kader/lansia/show')}}" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                                <a href="{{ url('kader/lansia/show')}}" class="bg-yellow-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-yellow-500">Ubah</a>
                                <a href="" class="bg-red-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-red-600 hover:text-white">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Suryo Abdi</td>
                        <td class="font-normal text-sm">1 April 2024</td>
                        <td class="font-normal text-sm">58 Tahun</td>
                        <td class="font-normal text-sm">60 kg</td>
                        <td class="font-normal text-sm">160 cm</td>
                        <td class="font-normal text-sm">70 cm</td>
                        <td class="font-normal text-sm">Kurang Sehat</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="{{ url('kader/lansia/show')}}" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                                <a href="" class="bg-yellow-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-yellow-500">Ubah</a>
                                <a href="" class="bg-red-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-red-600 hover:text-white">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Suryo Abdi</td>
                        <td class="font-normal text-sm">1 April 2024</td>
                        <td class="font-normal text-sm">58 Tahun</td>
                        <td class="font-normal text-sm">60 kg</td>
                        <td class="font-normal text-sm">160 cm</td>
                        <td class="font-normal text-sm">70 cm</td>
                        <td class="font-normal text-sm">Kurang Sehat</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="{{ url('kader/lansia/show')}}" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                                <a href="" class="bg-yellow-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-yellow-500">Ubah</a>
                                <a href="" class="bg-red-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-red-600 hover:text-white">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Suryo Abdi</td>
                        <td class="font-normal text-sm">1 April 2024</td>
                        <td class="font-normal text-sm">58 Tahun</td>
                        <td class="font-normal text-sm">60 kg</td>
                        <td class="font-normal text-sm">160 cm</td>
                        <td class="font-normal text-sm">70 cm</td>
                        <td class="font-normal text-sm">Kurang Sehat</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="{{ url('kader/lansia/show')}}" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                                <a href="" class="bg-yellow-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-yellow-500">Ubah</a>
                                <a href="" class="bg-red-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-red-600 hover:text-white">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Suryo Abdi</td>
                        <td class="font-normal text-sm">1 April 2024</td>
                        <td class="font-normal text-sm">58 Tahun</td>
                        <td class="font-normal text-sm">60 kg</td>
                        <td class="font-normal text-sm">160 cm</td>
                        <td class="font-normal text-sm">70 cm</td>
                        <td class="font-normal text-sm">Kurang Sehat</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="{{ url('kader/lansia/show')}}" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                                <a href="" class="bg-yellow-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-yellow-500">Ubah</a>
                                <a href="" class="bg-red-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-red-600 hover:text-white">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-neutral-950 text-left">
                        <td class="font-normal text-sm">Suryo Abdi</td>
                        <td class="font-normal text-sm">1 April 2024</td>
                        <td class="font-normal text-sm">58 Tahun</td>
                        <td class="font-normal text-sm">60 kg</td>
                        <td class="font-normal text-sm">160 cm</td>
                        <td class="font-normal text-sm">70 cm</td>
                        <td class="font-normal text-sm">Kurang Sehat</td>
                        <td class="font-normal text-sm">
                            <div class="gap-[5px]">
                                <a href="{{ url('kader/lansia/show')}}" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
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
<!-- jQuery Reload -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<!-- DataTable Reload-->
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var div = document.getElementById('message');
        var button = document.getElementById('close');

        if (div && button) {
            button.addEventListener('click', function() {
                div.classList.add('hidden');
                console.log('test button');
            });
        }
    });
        function filterByKategori(kategori) {
        let url = `/bayi?`;

        let statusElement = document.querySelector('input[name="statusKes"]:checked');
        let golonganElement = document.querySelector('input[name="golUmur"]:checked');

        let status = statusElement? statusElement.value : '';
        let golongan = golonganElement? golonganElement.value : '';

        if(status !== ''){
            url += `&status=${status}`;
        }
        if(golongan !== ''){
            url += `&golongan=${golongan}`;
        }
        window.location.href=url;
    }

    document.addEventListener('click', (event) => {
        const dropdown = document.querySelector('.dropdown');
        const button = dropdown.querySelector('#filterInput');
        const urlParams = new URLSearchParams(window.location.search);
        const filters = [['statusKes'], ['golUmur']];
        let activeFilters = 0;
        for (let filter of filters) {
            let filterValues = urlParams.getAll(filter[0]);
            if(filterValues.length>0){
                filter.push(...filterValues);
                activeFilters += filterValues.length;
            }
        }
        if (!dropdown.contains(event.target) && activeFilters === 0) {
                button.classList.remove('focusElement');
                button.querySelectorAll('path').forEach(path => {
                    path.classList.remove('fill-Primary/10');
                    path.classList.add('fill-[#025864]');
                });
        }
    });

    window.onload = function () {
            const urlParams = new URLSearchParams(window.location.search);
            const filters = [['statusKes'], ['golUmur']];
            let activeFilters = 0;
            for (let filter of filters) {
                let filterValues = urlParams.getAll(filter[0]);
                if (filterValues.length > 0) {
                    filter.push(...filterValues);
                    activeFilters += filterValues.length;
                }
            }

            const countSpan = document.getElementById('count');
            if (activeFilters > 0) {
                countSpan.textContent = activeFilters;
                document.getElementById('filterInput').classList.add('focusElement');
                countSpan.classList.remove('hidden');
            } else {
                countSpan.classList.add('hidden');
            }
        }

        {{--Javascript function to add active style to filter button--}}
        function activeFilter(e) {
            e.classList.add('focusElement')
            e.querySelectorAll('path').forEach(path => {
                path.classList.remove('fill-[#025864]')
                path.classList.add('fill-[#000000]')
            })
            document.querySelector('.filter-content').classList.toggle('hidden')
        }

        {{--Javascript function to add active style for filter button--}}
        const inputFilterChange = () => {
            const count = document.getElementById('count')
            const button = document.querySelector('button[type="submit"]')
            button.classList.add('activeSubmitButton')
            button.classList.remove('pointer-events-none')
            count.classList.remove('hidden')
            count.innerText = document.querySelectorAll('input[type="radio"]:checked').length
        }

        {{--Javascript function to reset input--}}
        const resetInput = () => {
            const buttons = document.querySelectorAll('input[type="radio"]')

            const count = document.getElementById('count')
            count.classList.add('hidden')
            count.innerText = ''

            buttons.forEach(button => {
                button.checked = false
            })

            const button = document.querySelector('button[type="submit"]')
            button.classList.remove('activeSubmitButton')
            button.classList.add('pointer-events-none')

            window.location.href = '/kader/bayi';
        }

        $(document).ready(function () {
            let relationships = [];
            $('input[name="relationships[]"]').each(function() {
                relationships.push($(this).val());
            });
            let dataLansia = $('#lansia_table').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ route('lansia.list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d._token = "{{ csrf_token() }}";
                        d.filterValue = $('#filterValue').val();
                        d.model = $('#model').val();
                        d.relationships = relationships;
                        d.url = $('#url').val();
                        d.filterName = $('#filterName').val();
                        d.whereName = $('#whereName').val();
                        d.whereValue = $('#whereValue').val();
                    }
                },
                columns: [
                    {
                        data: "penduduk.nama",
                        className: "font-normal text-smr",
                        orderable: false,
                        searchable: false
                    }, {
                        data: "tgl_pemeriksaan",
                        className: "font-normal text-sm",
                        orderable: true,
                        searchable: true
                    }, {
                        data: null,
                        className: "font-normal text-sm",
                        orderable: true,
                        searchable: true,
                        render: function (data) {
                            // Menghitung umur dalam bulan
                            let tglLahir = new Date(data.penduduk.tgl_lahir);
                            let sekarang = new Date();
                            let tahun = sekarang.getFullYear() - tglLahir.getFullYear();
                            if (sekarang.getMonth() < tglLahir.getMonth() ||
                                (sekarang.getMonth() === tglLahir.getMonth() && sekarang.getDate() < tglLahir.getDate())) {
                                tahun--;
                            }
                            return tahun + " Tahun";
                        }
                    }, {
                        data: "berat_badan",
                        className: "font-normal text-sm",
                        orderable: false,
                        searchable: false,
                    }, {
                        data: "tinggi_badan",
                        className: "font-normal text-sm",
                        orderable: false,
                        searchable: false,
                    }, {
                        // error: can't get data pemeriksaanLansia
                        data: "pemeriksaan_lansia.lingkar_perut",
                        className: "font-normal text-sm",
                        orderable: false,
                        searchable: false,
                    }, {
                        data: "status",
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
            console.log(dataLansia);
            $('#filterValue').on('change', function() {
                dataLansia.ajax.reload();
            });
        });
    </script>
@endpush
