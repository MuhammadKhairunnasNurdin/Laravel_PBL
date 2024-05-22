<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('img/logo_posyandu.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>Sistem Informasi Posyandu</title>
    <style>
        *, html{
            font-family: 'Plus Jakarta Sans'
        }
        </style>
    {{-- @include('admin.layouts.datatables') --}}
    @stack('css')
</head>
<body class="bg-gray-200 w-full md:h-screen">
    @include('admin.layouts.header')
    <div class="flex h-full mt-[50px] lg:grid lg:grid-cols-6 md:mt-[88px]">
        <div id="sidebar" class="fixed lg:static z-20 h-full -translate-x-[999px] transform transition ease-in-out duration-500 sm:duration-700 col-span-1 lg:translate-x-0">
            @include('admin.layouts.sidebar')
        </div>
        <div class="w-full lg:col-span-5">
            <div class="flex text-base px-5 md:text-2xl pt-5">
                @include('admin.layouts.breadcrumb')
            </div>
            @yield('content')
        </div>
    </div>
    @stack('js')
</body>
</html>