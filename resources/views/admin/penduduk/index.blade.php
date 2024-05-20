@extends('admin.layouts.template')

@section('content')
    <div class="flex flex-col bg-white mx-5 my-5 shadow-[0_-4px_0_0_rgba(29,78,216,1)] rounded-md">
        <div class="flex justify-between items-center w-full py-2 border-b">
            <p class="text-sm md:text-lg ml-5 md:ml-10">Daftar pemeriksaan lansia</p>
            <a href="{{ url('kader/lansia/create') }}" class="bg-blue-700 text-sm text-white font-bold py-1 px-4 mr-5 md:mr-10 rounded">Tambah</a>
        </div>
        {{-- <div class="flex mt-[30px] mx-10 "> --}}
            <div class="flex w-fit h-full items-center align-middle gap-[20px] mx-10 mt-[30px]">
                <x-dropdown.dropdown-filter>Filter</x-dropdown.dropdown-filter>
                <x-input.search-input name="search" placeholder="Cari nama anggota posyandu"></x-input.search-input>
                {{-- <p class="text-base text-neutral-950 text-center pr-[10px]">Filter:</p>
                <select name="filterValue" id="filterValue" class="w-100 border border-stone-400 text-sm font-normal pl-[10px] pr-28 py-[10px] rounded-[5px] focus:outline-none">
                    <option value="" class="">Pilih Kategori</option>
                    @foreach($penduduks as $filter)
                        <option value="{{ $filter->NIK }}">{{ $filter->penduduk->nama }}</option>
                    @endforeach
                </select> --}}
            </div>
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
        {{-- </div> --}}

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
            <x-table.data-table :dt="$penduduks" 
                                :headers="['Nama', 'NIK', 'NKK', 'Tanggal Lahir', 'Jenis Kelamin', 'Hubungan Keluarga', 'Aksi']">
                @php
                    $no = ($penduduks->currentPage() - 1) * $penduduks->perPage() + 1;
                @endphp
                @foreach ($penduduks as $pd)
                    <x-table.table-row>
                        <td class="px-6 border-b lg:py-2 bg-white">{{$pd->nama}}</td>
                        <td class="px-6 lg:py-2 border-b bg-white">{{$pd->NIK}}</td>
                        <td class="px-6 lg:py-2 border-b bg-white">{{$pd->NKK}}</td>
                        <td class="px-6 lg:py-2 border-b bg-white">{{$pd->tgl_lahir}}</td>
                        <td class="px-6 lg:py-2 border-b bg-white">{{$pd->jenis_kelamin}}</td>
                            {{-- @dd($pd->pemeriksaan_lansia->lingkar_perut); --}}
                        <td class="px-6 lg:py-2 border-b bg-white">{{$pd->hubungan_keluarga}}</td>
                        <td class="px-6 lg:py-2 border-b bg-white">
                            <form action="lansia/{{$pd->penduduk_id}}" method="post" class="flex items-center gap-2">
                                <a href="lansia/{{$pd->penduduk_id}}" class="bg-blue-400 text-[12px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                                <a href="lansia/{{$pd->penduduk_id}}/edit" class="bg-yellow-400 text-[12px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-yellow-300">Ubah</a>
                                @csrf
                                @method('DELETE')
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
<script>
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
                    <td class="px-6 border-b lg:py-2 bg-white">${item.nama}</td>
                    <td class="px-6 lg:py-2 border-b bg-white">${item.NIK}</td>
                    <td class="px-6 lg:py-2 border-b bg-white">${item.NKK}</td>
                    <td class="px-6 lg:py-2 border-b bg-white">${item.tgl_lahir}</td>
                    <td class="px-6 lg:py-2 border-b bg-white">${item.jenis_kelamin}</td>
                    <td class="px-6 lg:py-2 border-b bg-white">${item.hubungan_keluarga}</td>
                    <td class="px-6 lg:py-2 border-b bg-white">
                        <form action="penduduk/${item.penduduk_id}" method="post" class="flex items-center gap-2">
                            <a href="penduduk/${item.penduduk_id}" class="bg-blue-400 text-[12px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600 hover:text-white">Detail</a>
                            <a href="penduduk/${item.penduduk_id}/edit" class="bg-yellow-400 text-[12px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-yellow-300">Ubah</a>
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
            const response = await fetch(`/api/penduduk/search?search=${search}`, {
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
</script>
@endpush