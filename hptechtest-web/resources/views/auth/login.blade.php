<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | HP Tech Test</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-screen flex items-center justify-center bg-[#FDFDFC] text-[#1b1b18]">
    <div
        class="w-full max-w-xs p-6 bg-white shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] rounded-lg">
        <h4 class="text-xl text-center mb-6">Login</h4>

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf

            <div class="space-y-1">
                <label for="email" class="block text-sm">Email</label>
                <input type="email"
                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none text-sm
                              @error('email') border-red-500 @enderror"
                    name="email" id="email" placeholder="email@example.com" value="{{ old('email') }}" autofocus>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="password" class="block text-sm">Password</label>
                <input type="password"
                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none text-sm
                              @error('password') border-red-500 @enderror"
                    name="password" id="password" placeholder="ex: password123">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="cursor-pointer w-full flex justify-center py-2 px-4 rounded-md text-sm font-medium text-white bg-gray-900 hover:bg-gray-200 hover:text-[#1b1b18] transition duration-150 ease-in-out">Login</button>
            <p class="text-xs text-center mt-4">
                Don't have an account? <a href="{{ route('register.show') }}"
                    class="text-blue-500 hover:underline">Register</a>
            </p>
        </form>
    </div>
    @include('sweetalert::alert')
</body>

</html>

