<aside class="static lg:fixed flex bg-white w-[236.094px] h-screen lg:h-full justify-center shadow-inner">
    <div class="content flex flex-col w-full gap-10 pt-10 mx-7">
        <a href="{{ url('/ketua') }}" class="containerSidebar active:bg-blue-900 {{ ($activeMenu == 'dashboard')? 'active stroke-white' : 'stroke-neutral-950 hover:text-white hover:bg-blue-600 hover:stroke-white'}}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
            </svg>
            <p class="text-base">Dashboard</p>
        </a>
        <a href="{{ url('/ketua/bantuan') }}" class="containerSidebar active:bg-blue-900 {{ ($activeMenu == 'bantuan')? 'active stroke-white' : 'stroke-neutral-950 hover:text-white hover:bg-blue-600 hover:stroke-white'}}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
              </svg>                           
            <p class="text-base">Bantuan Pangan</p>
        </a>
        <a href="{{ url('/ketua/spk') }}" class="containerSidebar active:bg-blue-900 {{ ($activeMenu == 'spk')? 'active stroke-white' : 'stroke-neutral-950 hover:text-white hover:bg-blue-600 hover:stroke-white'}}">
            <svg width="27" height="23" viewBox="0 0 27 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M25.2812 0.625H15.3125L14.6781 0.896875L13.5 2.05687L12.3219 0.896875L11.6875 0.625H1.71875L0.8125 1.53125V19.6563L1.71875 20.5625H11.3069L12.8656 22.1031H14.1344L15.6931 20.5625H25.2812L26.1875 19.6563V1.53125L25.2812 0.625ZM12.5938 19.33L12.2675 19.0219L11.6875 18.75H2.625V2.4375H11.3069L12.6481 3.77875L12.5938 19.33ZM24.375 18.75H15.3125L14.6781 19.0219L14.4244 19.2575V3.70625L15.6931 2.4375H24.375V18.75ZM9.875 6.0625H4.4375V7.875H9.875V6.0625ZM9.875 13.3125H4.4375V15.125H9.875V13.3125ZM4.4375 9.6875H9.875V11.5H4.4375V9.6875ZM22.5625 6.0625H17.125V7.875H22.5625V6.0625ZM17.125 9.6875H22.5625V11.5H17.125V9.6875ZM17.125 13.3125H22.5625V15.125H17.125V13.3125Z" fill="black"/>
                </svg>                                        
            <p class="text-base">Sistem Pendukung Keputusan</p>
        </a>
    </div>
</aside>

{{-- {{ ($activeMenu == 'spk')? 'active' : ''}} --}}
{{-- {{ ($activeMenu == 'dashboard')? 'active' : ''}} --}}
{{-- {{ ($activeMenu == 'bantuan')? 'active' : ''}} --}}