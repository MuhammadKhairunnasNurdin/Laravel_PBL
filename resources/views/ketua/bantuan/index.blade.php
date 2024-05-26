@extends('ketua.layouts.template')

@section('content')
    <div class="flex flex-col bg-white mx-5 mt-5 shadow-[0_-4px_0_0_rgba(29,78,216,1)] rounded-md">
        <div class="flex justify-between items-center w-full py-2 border-b">
            <p class="text-lg ml-10">Daftar Penerima Bantuan Pangan</p>
            <a href="{{ url('ketua/bantuan/penerima') }}" class="bg-blue-700 text-sm text-white font-bold py-1 px-4 mr-10 rounded">Tambah</a>
        </div>
        <div class="mx-10 my-[30px] overflow-x-auto">
            <x-table.data-table :dt="$bayis" :headers="['Nama Bayi', 'Nama Ibu', 'Nama Ayah', 'Periode Bantuan', 'Jenis Bantuan', 'Aksi']">
                @php
                    $no = ($bayis->currentPage() - 1) * $bayis->perPage() + 1;
                @endphp
                @foreach ($bayis as $bayi)
                <x-table.table-row>
                        <td class="px-6 border-b 2xl:py-6 lg:py-5 bg-white">{{$bayi->penduduk->nama}}</td>
                        <td class="px-6 2xl:py-6 lg:py-5 border-b bg-white">
                        @foreach ($parents as $mom)
                            @if ($mom->hubungan_keluarga === 'Istri' && $mom->NKK === $bayi->penduduk->NKK)
                                {{$mom->nama}}
                                @break
                            @else
                                @continue
                            @endif
                        @endforeach    
                        </td>
                        
                        <td class="px-6 2xl:py-6 lg:py-5 border-b bg-white">
                        @foreach ($parents as $dad)
                            @if ($dad->hubungan_keluarga === 'Kepala Keluarga' && $dad->NKK === $bayi->penduduk->NKK)
                                {{$dad->nama}}
                                @break
                            @else
                                @continue
                            @endif
                        @endforeach    
                        </td>
                        <td class="px-6 2xl:py-6 lg:py-5 border-b bg-white">1</td>
                        <td class="px-6 2xl:py-6 lg:py-5 border-b bg-white">Bahan Pangan</td>
                        <td class="px-6 2xl:py-6 lg:py-5 border-b bg-white">
                            <a href="bayi/{{$bayi->pemeriksaan_id}}" class="bg-blue-400 text-[12px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600">Detail</a>
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
                        <td class="px-6 border-b lg:py-2 bg-white">${item.penduduk.nama}</td>
                        <td class="px-6 lg:py-2 border-b bg-white">${item.tgl_pemeriksaan}</td>
                        <td class="px-6 lg:py-2 border-b bg-white">${calculateAge(item.penduduk.tgl_lahir)} Bulan</td>
                        <td class="px-6 lg:py-2 border-b bg-white">${item.pemeriksaan_bayi.kategori_golongan}</td>
                        <td class="px-6 lg:py-2 border-b bg-white">${item.berat_badan} Kg</td>
                        <td class="px-6 lg:py-2 border-b bg-white">${item.tinggi_badan} Cm</td>
                        <td class="px-6 lg:py-2 border-b bg-white">${item.status}</td>
                        <td class="px-6 2xl:py-6 lg:py-5 border-b bg-white">
                            <form action="bayi/${item.pemeriksaan_id}" method="post">
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
</script>
@endpush
