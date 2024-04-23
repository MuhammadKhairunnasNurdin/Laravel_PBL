<nav class="grid grid-cols-6 w-full h-fit py-5 bg-white shadow-md fixed top-0 z-50">
    <div class="flex w-fit col-span-1 px-5">
        <img src="{{ asset('img/logo_posyandu.png') }}" alt="" class="w-16 h-auto">
        <div class="flex flex-col">
            <p class="text-neutral-950 text-xs">Sistem Informasi</p class="">
            <p class="text-neutral-950 text-2xl font-bold">Posyandu</p class="">
        </div>
    </div>
    <div class="flex col-span-5 justify-between align-middle px-5">
        <div class="flex flex-col">
            <p class="text-neutral-950 text-xs">Halo, {{auth()->user()->username}}!</p>
            <p class="text-neutral-950 text-xl">{{ now()->formatLocalized('%d %B %Y')}}</p>
        </div>
        <div class="flex w-fit gap-3" onmouseover="showDropdown()" onmouseout="hideDropdown()">
            <img src="{{ asset('img/profile_picture.png')}}" alt="" class="w-9 h-9 rounded-full mt-1">
            <div class="flex flex-col">
                <p class="text-neutral-950 text-base">{{auth()->user()->username}}</p>
                <p class="text-neutral-950 text-sm">{{auth()->user()->level}}</p>
            </div>
            <div class="dropdown-content hidden absolute bg-white border border-gray-200 mt-10 py-2 rounded-md shadow-md">
                <!-- Isi dropdown content di sini -->
                <a href="{{ route('ketua.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-b">Atur Profil</a>
                <form action="{{ route('ketua.logout') }}" method="post">
                    @csrf
                    <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                </form>
              </div>
        </div>
    </div>
</nav>

@push('js')
<script>
function showDropdown() {
    document.querySelector('.dropdown-content').classList.remove('hidden');
  }

  function hideDropdown() {
    document.querySelector('.dropdown-content').classList.add('hidden');
  }
</script>
@endpush
