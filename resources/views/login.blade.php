<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('img/logo_posyandu.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>Sistem Informasi Posyandu</title>
    <style>
        *,html{
            font-family: 'Plus Jakarta Sans'
        }
    </style>
</head>
<body>
    <div class="flex bg-gray-200 w-screen h-screen justify-center items-center">
        <div class="bg-white w-full flex flex-col mx-8 px-[25px] py-[22px] gap-[25px] md:grid md:grid-cols-2 md:px-[100px] md:py-[55px] md:rounded-[25px] md:gap-[100px] md:mx-32 ">
            <div class="w-full flex flex-col md:justify-center">
                <p class="md:text-[31px] order-2 hidden md:flex">Sistem Informasi</p>
                <p class="font-bold md:text-[57px] order-3 hidden md:flex">Posyandu</p>
                <p class="font-bold md:text-[57px] order-2 md:hidden">Login</p>
                <p class="text-xs md:hidden order-3">Gunakan Akun Anda</p>
                <img src="{{ asset('img/logo_posyandu.png') }}" alt="logo Posyandu" class="w-[75px] -ml-2.5 md:w-[142px] md:h-[106.5px] md:hidden  order-1">
            </div>
            <div class="md:flex md:flex-col w-100 justify-center items-center md:gap-[42px]">
                <img src="{{ asset('img/logo_posyandu.png') }}" alt="logo Posyandu" class="w-[75px] md:w-[142px] md:h-[106.5px] hidden md:flex">
                @error('login_failed')
                <div class="pl-5 py-[15px] bg-red-200 w-full fade show" role="alert">
                    <span class="alert-inner-text"><strong>Warning!</strong> {{ $message }}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
{{--                        <span aria-hidden="true">&times;</span>--}}
                    </button>
                </div>
                @enderror
                <div class="flex flex-col w-full gap-4">
                    <form method="post" action="{{route('login.auth')}}" id="login-form">
                        @csrf
                        <div class="flex flex-col w-full gap-[15px] md:gap-[30px]">
                            <input type="text" name="username" placeholder="Username" class=" w-full border border-stone-400 pl-2.5 py-[7px] rounded text-sm placeholder:text-xs md:pl-5 md:py-[10px] focus:outline-none md:placeholder:text-sm" required>
                            <input type="password" id="password" name="password" placeholder="Password" class="w-full border border-stone-400 pl-2.5 py-[7px] rounded text-sm placeholder:text-xs md:pl-5 md:py-[10px] focus:outline-none md:placeholder:text-sm placeholder:items-center" required>
                        </div>
                        <div class="flex left w-full">
                            <span id="passwordError" class="text-red-500 hidden"></span>
                        </div>
{{--                        <div class="flex left pt-4 w-full gap-4">--}}
{{--                            <input type="checkbox" name="remember" id="">--}}
{{--                            <p>Ingat saya</p>--}}
{{--                        </div>--}}
                        <div class="flex right w-full pt-2 md:pt-4 gap-4 justify-end">
                            <button class="bg-blue-700 text-white text-xs py-[8px] px-[15px] md:text-base md:py-[10px] md:px-[17px] rounded-[5px] w-fit right-0" id="submit" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- <div class="border-t w-full m-0 p-0">
                <p class="text-xs text-stone-400">Sistem Informasi Posyandu</p>
            </div> --}}
        </div>
    </div>
    <script>
        document.getElementById("login-form").addEventListener("submit", function(event){
            let pwd = document.getElementById("password").value;
            let passwordError = document.getElementById("passwordError");
            let valid = true;

            if (!/[A-Z]/.test(pwd)) {
                passwordError.textContent = "Password harus memiliki setidaknya satu huruf kapital.";
                passwordError.classList.remove("hidden");
                valid = false;
            }
            if (!/[0-9]/.test(pwd)) {
                passwordError.textContent = "Password harus memiliki setidaknya 1 angka.";
                passwordError.classList.remove("hidden");
                valid = false;
            }
            if (pwd.length < 8) {
                passwordError.textContent = "Password minimal 8 karakter ";
                passwordError.classList.remove("hidden");
                valid = false;
            }
            if(!valid) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>