@extends('admin.layouts.template')

@section('content')
    <div class="flex flex-col bg-white mx-5 my-5 shadow-[0_-4px_0_0_rgba(29,78,216,1)] rounded-md">
        <div class="flex justify-between items-center w-full py-2 border-b">
            <p class="text-sm md:text-lg ml-5 md:ml-10">Daftar User</p>
            <a href="{{ route('user.create') }}" class="bg-blue-700 text-sm text-white font-bold py-1 px-4 mr-5 md:mr-10 rounded">Tambah</a>
        </div>
        <div class="flex flex-col mt-[30px] mx-10 gap-[30px] relative">
            <div class="flex flex-row w-fit h-full items-center align-middle gap-4">
                <x-dropdown.dropdown-filter><span class="hidden lg:flex">Filter</span></x-dropdown.dropdown-filter>
                <x-input.search-input name="search" placeholder="Cari username user"></x-input.search-input>
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
        {{-- <div class="flex flex-col mt-[30px] mx-10 gap-[30px] relative">
            <div class="flex flex-row w-fit h-full items-center align-middle gap-4">
                <x-dropdown.dropdown-filter><span class="hidden lg:flex">Filter</span></x-dropdown.dropdown-filter>
                <x-input.search-input name="search" placeholder="Cari nama anggota posyandu"></x-input.search-input>
            </div>
            @if(session('success'))
                <div class="flex w-full h-full items-center p-1 mb-1 border-2 border-green-500 bg-green-100 text-green-700 rounded-md" id="message">
                    <p class="mr-4"> <b>BERHASIL</b> {{ session('success') }}</p>
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
        </div> --}}

        <div class="mx-10 my-[30px] overflow-x-auto">
            <x-table.data-table :dt="$users"
            :headers="['Username', 'Level', 'Foto', 'Aksi']">
            @php
                    $no = ($users->currentPage() - 1) * $users->perPage() + 1;
                    @endphp
                @foreach ($users as $user)
                    <x-table.table-row>
                        <td class="tableBody">{{$user->username}}</td>
                        <td class="tableBody">{{$user->level}}</td>
                        <td class="tableBody"><img src="{{$user->foto_profil}}" alt=""></td>
                        <td class="tableBody">
                            <form action="user/{{$user->user_id}}" method="post" class="flex items-center gap-2">
                                @php
                                    $queryString = http_build_query(request()->query());
                                    session(['urlPagination' => $queryString ? '?' . $queryString : '']);
                                @endphp
                                <a href="user/{{$user->user_id}}" class="bg-blue-400 text-[12px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                                <a href="user/{{$user->user_id}}/edit" class="bg-yellow-400 text-[12px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-yellow-300">Ubah</a>
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="updated_at" value="{{ $user->updated_at }}">
                                <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data?')" class="bg-red-400 text-[12px] text-neutral-950 py-[6px] px-2 rounded-sm hover:bg-red-600 hover:text-white">Hapus</button>
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
    // function filterByKategori(kategori) {
    //     let url = `/penduduk?`;

    //     let hubunganElement = document.querySelector('input[name="hubKeluarga"]:checked');
    //     let indikasiElement = document.querySelector('input[name="indikasi"]:checked');
    //     let rtElement = document.querySelector('input[name="rt"]:checked');
    //     let kelaminElement = document.querySelector('input[name="kelamin"]:checked');

    //     let hubungan = hubungnaElement? hubunganElement.value : '';
    //     let indikasi = indikasiElement? indikasiElement.value : '';
    //     let rt = rtElement? rtElement.value : '';
    //     let kelamin = kelaminElement? kelaminElement.value : '';

    //     if(status !== ''){
    //         url += `&hubungan=${hubungan}`;
    //     }
    //     if(golongan !== ''){
    //         url += `&indikasi=${$indikasi}`;
    //     }
    //     if(rt !== ''){
    //         url += `&rt=${$rt}`;
    //     }
    //     if(kelamin !== ''){
    //         url += `&kelamin=${$kelamin}`;
    //     }
    //     window.location.href=url;
    // }

    // document.addEventListener('click', (event) => {
    //     const dropdown = document.querySelector('.dropdown');
    //     const button = dropdown.querySelector('#filterInput');
    //     const urlParams = new URLSearchParams(window.location.search);
    //     const filters = [['hubKeluarga'], ['indikasi'], ['rt'], ['kelamin']];
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
    //     const urlParams = new URLSearchParams(window.location.search);
    //         const filters = [['hubKeluarga'], ['indikasi'], ['rt'], ['kelamin']];
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
    //         const dropdown = document.querySelector('.dropdown-filter-bayi');
    //         dropdown.classList.toggle('hidden');
    //         if (!dropdown.classList.contains('hidden')) {
    //             dropdown.classList.remove('opacity-0', 'transform', 'scale-95');
    //             dropdown.classList.add('opacity-100', 'transform', 'scale-100');
    //         } else {
    //             dropdown.classList.remove('opacity-100', 'transform', 'scale-100');
    //             dropdown.classList.add('opacity-0', 'transform', 'scale-95');
    //         }
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

    //         window.location.href = '/admin/penduduk';
    //     }

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
                    <td class="px-6 border-b lg:py-2 bg-white">${item.username}</td>
                    <td class="tableBody">${item.level}</td>
                    <td class="tableBody">${item.foto_profil}</td>
                    <td class="tableBody">
                        <form action="user/${item.user_id}" method="post" class="flex items-center gap-2">
                            <a href="user/${item.user_id}" class="bg-blue-400 text-[12px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                            <a href="user/${item.user_id}/edit" class="bg-yellow-400 text-[12px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-yellow-300">Ubah</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="confirm('Apakah anda yakin ingin menghapus data?')" class="bg-red-400 text-[12px] text-neutral-950 py-[6px] px-2 rounded-sm hover:bg-red-600 hover:text-white">Hapus</button>
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
            const response = await fetch(`/api/user/search?search=${search}`, {
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

    document.addEventListener('DOMContentLoaded', function() {
        let div = document.getElementById('message');
        let button = document.getElementById('close');

        if (div && button) {
            button.addEventListener('click', function() {
                div.classList.add('hidden');
            });
        }
    });
    $(document).ready(function (){
        setTimeout(function() {
            $('#message').fadeOut('fast');
        }, 3000);
    })
</script>
@endpush
