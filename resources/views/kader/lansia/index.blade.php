@extends('kader.layouts.template')

@section('content')
    <div class="flex flex-col bg-white mx-5 mt-5 shadow-[0_-4px_0_0_rgba(29,78,216,1)] rounded-md">
        <div class="flex justify-between items-center w-full py-2 border-b">
            <p class="text-sm md:text-lg ml-5 md:ml-10">Daftar pemeriksaan lansia</p>
            <a href="{{ url('kader/lansia/create') }}" class="bg-blue-700 text-sm text-white font-bold py-1 px-4 mr-5 md:mr-10 rounded">Tambah</a>
        </div>
        {{-- <div class="flex mt-[30px] mx-10 "> --}}
            <div class="flex w-fit h-full items-center align-middle gap-[20px] mx-10 mt-[30px]">
                <x-dropdown.dropdown-filter>Filter</x-dropdown.dropdown-filter>
                <x-input.search-input name="search" placeholder="Cari nama anggota posyandu"></x-input.search-input>
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
            {{-- <table class=" border-collapse w-full rounded-t-[10px] overflow-hidden" id="lansia_table">
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
            </table> --}}
            <x-table.data-table :dt="$penduduks" :headers="['Nama', 'Tgl Pemeriksaan', 'Usia', 'Berat', 'Tinggi', 'L.Perut', 'Status', 'Aksi']">
                @php
                    $no = ($penduduks->currentPage() - 1) * $penduduks->perPage() + 1;
                @endphp
                @foreach ($penduduks as $pd)
                <x-table.table-row>
                        <td class="px-6 border-b lg:py-2 bg-white">{{$pd->penduduk->nama}}</td>
                        <td class="px-6 lg:py-2 border-b bg-white">{{$pd->tgl_pemeriksaan}}</td>
                        <td class="px-6 lg:py-2 border-b bg-white usia" id="usia">{{now()->diffInYears($pd->penduduk->tgl_lahir)}} Tahun</td>
                        <td class="px-6 lg:py-2 border-b bg-white">{{$pd->berat_badan}} Kg</td>
                        <td class="px-6 lg:py-2 border-b bg-white">{{$pd->tinggi_badan}} Cm</td>
                        <td class="px-6 lg:py-2 border-b bg-white">{{$pd->pemeriksaan_lansia->lingkar_perut}} Cm</td>
                            {{-- @dd($pd->pemeriksaan_lansia->lingkar_perut); --}}
                        <td class="px-6 lg:py-2 border-b bg-white">{{$pd->status}}</td>
                        <td class="px-6 lg:py-2 border-b bg-white">
                            <form action="lansia/{{$pd->pemeriksaan_id}}" method="post" class="flex items-center gap-2">
                                <a href="lansia/{{$pd->pemeriksaan_id}}" class="bg-blue-400 text-[12px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                                <a href="lansia/{{$pd->pemeriksaan_id}}/edit" class="bg-yellow-400 text-[12px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-yellow-300">Ubah</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="Javascript:return confirm('Apakah anda yakin ingin menghapus data?')" class="bg-red-400 text-[12px] text-neutral-950 py-[6px] px-2 rounded-sm hover:bg-red-600 hover:text-white">Hapus</button>
                            </form>
                        </td>
                    </x-table.table-row>
                @php
                    $no++;
                @endphp
                @endforeach
            </x-table.data-table>
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
<script>

    //         function filterByKategori(kategori) {
    //     let url = `/bayi?`;

    //     let statusElement = document.querySelector('input[name="statusKes"]:checked');
    //     let golonganElement = document.querySelector('input[name="golUmur"]:checked');

    //     let status = statusElement? statusElement.value : '';
    //     let golongan = golonganElement? golonganElement.value : '';

    //     if(status !== ''){
    //         url += `&status=${status}`;
    //     }
    //     if(golongan !== ''){
    //         url += `&golongan=${golongan}`;
    //     }
    //     window.location.href=url;
    // }

    // document.addEventListener('click', (event) => {
    //     const dropdown = document.querySelector('.dropdown');
    //     const button = dropdown.querySelector('#filterInput');
    //     const urlParams = new URLSearchParams(window.location.search);
    //     const filters = [['statusKes'], ['golUmur']];
    //     let activeFilters = 0;
    //     for (let filter of filters) {
    //         let filterValues = urlParams.getAll(filter[0]);
    //         if(filterValues.length>0){
    //             filter.push(...filterValues);
    //             activeFilters += filterValues.length;
    //         }
    //     }
    //     if (!dropdown.contains(event.target) && activeFilters === 0) {
    //             button.classList.remove('focusElement');
    //             button.querySelectorAll('path').forEach(path => {
    //                 path.classList.remove('fill-Primary/10');
    //                 path.classList.add('fill-[#025864]');
    //             });
    //     }
    // });

    // window.onload = function () {
    //         const urlParams = new URLSearchParams(window.location.search);
    //         const filters = [['statusKes'], ['golUmur']];
    //         let activeFilters = 0;
    //         for (let filter of filters) {
    //             let filterValues = urlParams.getAll(filter[0]);
    //             if (filterValues.length > 0) {
    //                 filter.push(...filterValues);
    //                 activeFilters += filterValues.length;
    //             }
    //         }

    //         const countSpan = document.getElementById('count');
    //         if (activeFilters > 0) {
    //             countSpan.textContent = activeFilters;
    //             document.getElementById('filterInput').classList.add('focusElement');
    //             countSpan.classList.remove('hidden');
    //         } else {
    //             countSpan.classList.add('hidden');
    //         }
    //     }

    //     {{--Javascript function to add active style to filter button--}}
    //     function activeFilter(e) {
    //         e.classList.add('focusElement')
    //         e.querySelectorAll('path').forEach(path => {
    //             path.classList.remove('fill-[#025864]')
    //             path.classList.add('fill-[#000000]')
    //         })
    //         document.querySelector('.filter-content').classList.toggle('hidden')
    //     }

    //     {{--Javascript function to add active style for filter button--}}
    //     const inputFilterChange = () => {
    //         const count = document.getElementById('count')
    //         const button = document.querySelector('button[type="submit"]')
    //         button.classList.add('activeSubmitButton')
    //         button.classList.remove('pointer-events-none')
    //         count.classList.remove('hidden')
    //         count.innerText = document.querySelectorAll('input[type="radio"]:checked').length
    //     }

    //     {{--Javascript function to reset input--}}
    //     const resetInput = () => {
    //         const buttons = document.querySelectorAll('input[type="radio"]')

    //         const count = document.getElementById('count')
    //         count.classList.add('hidden')
    //         count.innerText = ''

    //         buttons.forEach(button => {
    //             button.checked = false
    //         })

    //         const button = document.querySelector('button[type="submit"]')
    //         button.classList.remove('activeSubmitButton')
    //         button.classList.add('pointer-events-none')

    //         window.location.href = '/kader/bayi';
    //     }

        function calculateAge(ttl){
            let birth = new Date(ttl);
            
            // Get the current date
            let today = new Date();
            
            // Calculate the age based on the year difference
            let age = today.getFullYear() - birth.getFullYear();
            
            // Adjust the age if the birth date hasn't occurred yet this year
            let monthDifference = today.getMonth() - birth.getMonth();
            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birth.getDate())) {
                age--;
            }
            
            return age;
        }

        function clearTable() {
            const table = document.getElementById('dataTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = rows.length - 1; i > 0; i--) {
                table.deleteRow(i);
            }
        }

        function addRowToTable(item) {
            const table = document.getElementById('dataTable');
            const row = table.insertRow(-1);
            console.log(item)

            row.innerHTML = `
            <x-table.table-row>
                        <td class="px-6 border-b lg:py-2 bg-white">${item.penduduk.nama}</td>
                        <td class="px-6 lg:py-2 border-b bg-white">${item.tgl_pemeriksaan}</td>
                        <td class="px-6 lg:py-2 border-b bg-white">${calculateAge(item.penduduk.tgl_lahir)} Tahun</td>
                        <td class="px-6 lg:py-2 border-b bg-white">${item.berat_badan} Kg</td>
                        <td class="px-6 lg:py-2 border-b bg-white">${item.tinggi_badan} Cm</td>
                        <td class="px-6 lg:py-2 border-b bg-white">${item.pemeriksaan_lansia.lingkar_perut} Cm</td>
                        <td class="px-6 lg:py-2 border-b bg-white">${item.status}</td>
                        <td class="px-6 lg:py-2 border-b bg-white">
                            <form action="lansia/${item.pemeriksaan_id}" method="post" class="flex items-center gap-2">
                                <a href="lansia/${item.pemeriksaan_id}" class="bg-blue-400 text-[12px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                                <a href="lansia/${item.pemeriksaan_id}/edit" class="bg-yellow-400 text-[12px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-yellow-300">Ubah</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data?')" class="bg-red-400 text-[12px] text-neutral-950 py-[6px] px-2 rounded-sm hover:bg-red-600 hover:text-white">Hapus</button>
                            </form>
                        </td>
                    </x-table.table-row>
    `;

        }

        async function searchFunction() {
            let input;
            input = document.getElementById('searchInput');
            search = input.value;

            try {
                // Make a request to the server
                const response = await fetch(`/api/lansia/search?search=${search}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                });

                const responseData = await response.json();
                clearTable();

                responseData.data.forEach(item => {
                    addRowToTable(item);
                });


            } catch (error) {
                console.log(error);
                const table = document.getElementById('dataTable');

                clearTable();

                const row = table.insertRow(-1);
                row.innerHTML = `
                    <td colspan="7" class="text-center p-6 bg-white border-b font-medium text-Neutral/60">Data tidak ditemukan</td>
                    `;
            }
        }

        // $(document).ready(function () {
        //     let relationships = [];
        //     $('input[name="relationships[]"]').each(function() {
        //         relationships.push($(this).val());
        //     });
        //     let dataLansia = $('#lansia_table').DataTable({
        //         serverSide: true,
        //         ajax: {
        //             "url": "{{ route('lansia.list') }}",
        //             "dataType": "json",
        //             "type": "POST",
        //             "data": function (d) {
        //                 d._token = "{{ csrf_token() }}";
        //                 d.filterValue = $('#filterValue').val();
        //                 d.model = $('#model').val();
        //                 d.relationships = relationships;
        //                 d.url = $('#url').val();
        //                 d.filterName = $('#filterName').val();
        //                 d.whereName = $('#whereName').val();
        //                 d.whereValue = $('#whereValue').val();
        //             }
        //         },
        //         columns: [
        //             {
        //                 data: "penduduk.nama",
        //                 className: "font-normal text-smr",
        //                 orderable: false,
        //                 searchable: false
        //             }, {
        //                 data: "tgl_pemeriksaan",
        //                 className: "font-normal text-sm",
        //                 orderable: true,
        //                 searchable: true
        //             }, {
        //                 data: null,
        //                 className: "font-normal text-sm",
        //                 orderable: true,
        //                 searchable: true,
        //                 render: function (data) {
        //                     // Menghitung umur dalam bulan
        //                     let tglLahir = new Date(data.penduduk.tgl_lahir);
        //                     let sekarang = new Date();
        //                     let tahun = sekarang.getFullYear() - tglLahir.getFullYear();
        //                     if (sekarang.getMonth() < tglLahir.getMonth() ||
        //                         (sekarang.getMonth() === tglLahir.getMonth() && sekarang.getDate() < tglLahir.getDate())) {
        //                         tahun--;
        //                     }
        //                     return tahun + " Tahun";
        //                 }
        //             }, {
        //                 data: "berat_badan",
        //                 className: "font-normal text-sm",
        //                 orderable: false,
        //                 searchable: false,
        //             }, {
        //                 data: "tinggi_badan",
        //                 className: "font-normal text-sm",
        //                 orderable: false,
        //                 searchable: false,
        //             }, {
        //                 // error: can't get data pemeriksaanLansia
        //                 data: "pemeriksaan_lansia.lingkar_perut",
        //                 className: "font-normal text-sm",
        //                 orderable: false,
        //                 searchable: false,
        //             }, {
        //                 data: "status",
        //                 className: "font-normal text-sm",
        //                 orderable: false,
        //                 searchable: false,
        //             }, {
        //                 data: "aksi",
        //                 className: "",
        //                 orderable: false,
        //                 searchable: false
        //             }
        //         ]
        //     });
        //     console.log(dataLansia);
        //     $('#filterValue').on('change', function() {
        //         dataLansia.ajax.reload();
        //     });
        // });
    </script>
@endpush
