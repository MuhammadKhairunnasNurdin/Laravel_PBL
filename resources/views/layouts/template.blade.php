<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body class="bg-gray-200 w-full h-screen">
    @include('layouts.header')
    <div class="grid grid-cols-6">
        <div class="col-span-1">
            @include('layouts.sidebar')
        </div>
        <div class="col-span-5">
            @yield('content')
        </div>
    </div>
</body>
</html>