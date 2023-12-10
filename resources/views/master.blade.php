<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>

</head>

<body class="flex flex-col h-screen">
    {{-- navbar --}}
    <div class="wrapper ">
        @include('navbar1')
        @include('navbar2')
    </div>
    <div class="flex-grow flex bg-gray-700">
        {{-- sidebar --}}
        <div class="wrapper w-1/5 p-8" style="background-color: #726274;">
            @include('sidebar')
        </div>
        <div class="w-4/5 bg-white">
            {{-- content --}}
            <div class="content-wrapper">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

</body>

</html>
