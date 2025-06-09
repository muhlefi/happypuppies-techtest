<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title') | HP Tech Test
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
</head>

<body
    class="bg-[#FDFDFC] text-[#1b1b18]">
    <div class="flex min-h-screen">
        @include('components.sidebar')

        <div id="main-content-wrapper" class="flex-1 lg:ml-72">
            @include('components.navbar')

            <main id="main-content" class="p-6 my-[74px]">
                <div class="bg-white rounded-xl border border-gray-200 p-8 text-center">
                    @yield('content')
                </div>
            </main>

            @include('components.footer')
        </div>
    </div>
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 lg:hidden hidden"></div>
    
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    @yield('scripts')
    @include('sweetalert::alert')
</body>

</html>
