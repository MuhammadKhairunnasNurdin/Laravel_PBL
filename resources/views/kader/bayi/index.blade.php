@extends('kader.layouts.template')

@section('content')
    <div class="flex flex-col bg-white mx-5 mt-5 shadow-[0_-4px_0_0_rgba(248,113,113,1)] rounded-md">
        <div class="flex justify-between items-center w-full py-2 border-b">
            <p class="text-sm md:text-lg ml-10">Daftar pemeriksaan bayi</p>
            <a href="{{ url('kader/bayi/create') }}" class="bg-blue-700 text-sm text-white font-bold py-1 px-4 mr-10 rounded">Tambah</a>
        </div>
        <div class="flex flex-col mt-[30px] mx-10 gap-[30px] relative">
            <div class="flex flex-row w-fit h-full items-center align-middle gap-4">
                <x-dropdown.dropdown-filter><span class="hidden lg:flex">Filter</span></x-dropdown.dropdown-filter>
                <x-input.search-input name="search" placeholder="Cari nama anggota posyandu"></x-input.search-input>
            </div>
            <div class="flex w-full h-full justify-center items-center absolute" id="message">
                @if(session('success'))
                    <div class="flex w-full h-full items-center p-1 mb-1 border-2 border-green-500 bg-green-100 text-green-700 rounded-md" id="message">
                        <p class="mr-4"> <b>BERHASIL </b> {{ session('success') }}</p>
                        <button id="close" class="ml-auto bg-transparent text-green-700 hover:text-green-900">
                            <span>&times;</span>
                        </button>
                    </div>
                @elseif(session('error'))
                    <div class="flex w-full h-full items-center p-4 mb-4 border-2 border-red-500 bg-red-100 text-red-700 rounded-md" id="message">
                        <p class="mr-4">{{ session('error') }}</p>
                        <button id="close" class="ml-auto bg-transparent text-red-700 hover:text-red-900">
                            <span>&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>

        @php
            $relationships = ['penduduk'];
        @endphp
        @foreach($relationships as $relationship)
            <input type="hidden" name="relationships[]" id="relationship" value="{{encrypt($relationship)}}">
        @endforeach
        <input type="hidden" name="model" id="model" value="{{encrypt('App\Models\Pemeriksaan')}}">
        <input type="hidden" name="url" id="url" value="{{encrypt('/kader/bayi/')}}">
        <input type="hidden" name="filterName" id="filterName" value="{{encrypt('NIK')}}">
        <input type="hidden" name="where" id="whereName" value="{{encrypt('golongan')}}">
        <input type="hidden" name="where" id="whereValue" value="{{encrypt('bayi')}}">

        <div class="mx-10 my-[30px]">
            <x-table.data-table :dt="$penduduks" :headers="['Nama Bayi', 'Tgl Pemeriksaan', 'Usia', 'Kategori Umur', 'Berat', 'Tinggi', 'Status', 'Aksi']">
                @php
                    $no = ($penduduks->currentPage() - 1) * $penduduks->perPage() + 1;
                @endphp
                @foreach ($penduduks as $pd)
                <x-table.table-row>
                        <td class="tableBody">{{$pd->penduduk->nama}}</td>
                        <td class="tableBody">{{$pd->tgl_pemeriksaan}}</td>
                        <td class="tableBody usia" id="usia">{{now()->diffInMonths($pd->penduduk->tgl_lahir)}} Bulan</td>
                        <td class="tableBody">{{$pd->pemeriksaan_bayi->kategori_golongan}}</td>
                        <td class="tableBody">{{$pd->berat_badan}} Kg</td>
                        <td class="tableBody">{{$pd->tinggi_badan}} Cm</td>
                        <td class="tableBody">{{$pd->status}}</td>
                        <td class="tableBody">
                            <form action="bayi/{{$pd->pemeriksaan_id}}" method="post" class="flex items-center gap-2">
                                @php
                                    $queryString = http_build_query(request()->query());
                                    session(['urlPagination' => $queryString ? '?' . $queryString : '']);
                                @endphp
                                <a href="bayi/{{$pd->pemeriksaan_id}}" class="bg-blue-400 text-[12px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                                <a href="bayi/{{$pd->pemeriksaan_id}}/edit" class="bg-yellow-400 text-[12px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-yellow-300">Ubah</a>
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="updated_at" value="{{ $pd->updated_at }}">
                                <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data?')" class="bg-red-400 text-[12px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-red-600 hover:text-white">Hapus</button>
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

@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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


    // document.addEventListener('DOMContentLoaded', function(button) {
    //     console.log('test id');
    //     button.addEventListener('click', function() {
    //         div.classList.add('hidden');
    //         console.log('test button');
    //     });
    // });

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
            const dropdown = document.querySelector('.dropdown-filter-bayi');
            dropdown.classList.toggle('hidden');
            if (!dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('opacity-0', 'transform', 'scale-95');
                dropdown.classList.add('opacity-100', 'transform', 'scale-100');
            } else {
                dropdown.classList.remove('opacity-100', 'transform', 'scale-100');
                dropdown.classList.add('opacity-0', 'transform', 'scale-95');
            }
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

    function calculateAge(ttl){
        let birth = new Date(ttl);

        // Get the current date
        let today = new Date();

        // Calculate the age based on the year difference
        let year = today.getFullYear() - birth.getFullYear();
        let month = today.getMonth() - birth.getMonth();
        let day = today.getDay() - birth.getDay();

        let ageInMonths = year * 12 + month;

        // Adjust the age if the birth date hasn't occurred yet this year
        if (day < 0) {
                ageInMonths -= 1;
            }

         return ageInMonths;
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

            row.innerHTML = `
            <x-table.table-row>
                        <td class="tableBody">${item.penduduk.nama}</td>
                        <td class="tableBody">${item.tgl_pemeriksaan}</td>
                        <td class="tableBody">${calculateAge(item.penduduk.tgl_lahir)} Bulan</td>
                        <td class="tableBody">${item.pemeriksaan_bayi.kategori_golongan}</td>
                        <td class="tableBody">${item.berat_badan} Kg</td>
                        <td class="tableBody">${item.tinggi_badan} Cm</td>
                        <td class="tableBody">${item.status}</td>
                        <td class="tableBody">
                            <form action="bayi/${item.pemeriksaan_id}" method="post" class="flex items-center gap-2">
                                <a href="bayi/${item.pemeriksaan_id}" class="bg-blue-400 text-[12px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600">Detail</a>
                                <a href="bayi/${item.pemeriksaan_id}/edit" class="bg-yellow-400 text-[12px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600">Ubah</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data?')" class="bg-red-400 text-[12px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600">Hapus</button>
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
                const response = await fetch(`/api/bayi/search?search=${search}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                });

                const responseData = await response.json();

                clearTable();

                responseData[0].data.forEach(item => {
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

        $(document).ready(function (){
            setTimeout(function() {
                $('#message').fadeOut('fast');
            }, 3000);
        })
    </script>
@endpush
