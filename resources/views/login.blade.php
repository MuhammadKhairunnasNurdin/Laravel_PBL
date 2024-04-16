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
        <div class="grid grid-cols-2 bg-white w-full px-[100px] py-[55px] rounded-[25px] gap-[100px] mx-32 ">
            <div class="flex flex-col w-full justify-center">
                <p class="text-[31px]">Sistem Informasi</p>
                <p class="font-bold text-[57px]">Posyandu</p>
            </div>
            <div class="flex flex-col w-100 justify-center items-center gap-[42px]">
                <img src="{{ asset('img/logo_posyandu.png') }}" alt="logo Posyandu" class="w-[142px] h-[106.5px]">
                <div class="flex flex-col w-full gap-4">
                    <div class="flex flex-col w-full gap-[30px]">
                        <input type="text" placeholder="Email atau username" class="pl-5 py-[15px] w-full border border-stone-400 rounded focus:outline-none">
                        <input type="text" placeholder="Password" class="pl-5 py-[15px] w-full border border-stone-400 rounded focus:outline-none">
                    </div>
                    <div class="flex left w-full gap-4">
                        <input type="checkbox" name="" id="">
                        <p>Ingat saya</p>
                    </div>
                    <div class="flex right w-full gap-4 justify-end">
                        <button class="bg-blue-700 text-white py-[10px] px-[17px] rounded-[5px] w-fit right-0">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>