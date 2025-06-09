<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | HP Tech Test</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-screen flex items-center justify-center bg-[#FDFDFC] text-[#1b1b18]">
    @include('sweetalert::alert')

    <div class="w-full max-w-sm p-6 bg-white text-[#1b1b18] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] rounded-lg">
        <h4 class="text-xl text-center mb-6">Register</h4>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div class="space-y-1">
                <label for="name" class="block text-sm">Name</label>
                <input type="text"
                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none text-sm
                              @error('name') border-red-500 @enderror"
                    name="name" id="name" placeholder="Your Name" value="{{ old('name') }}" autofocus>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="email" class="block text-sm">Email</label>
                <input type="email"
                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none text-sm
                              @error('email') border-red-500 @enderror"
                    name="email" id="email" placeholder="email@example.com" value="{{ old('email') }}">
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

            <div class="space-y-1">
                <label for="password_confirmation" class="block text-sm">Confirm Password</label>
                <input type="password"
                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none text-sm
                              @error('password_confirmation') border-red-500 @enderror"
                    name="password_confirmation" id="password_confirmation">
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="cursor-pointer w-full flex justify-center py-2 px-4 rounded-md text-sm font-medium text-white bg-gray-900 hover:bg-gray-200 hover:text-[#1b1b18] transition duration-150 ease-in-out">Register</button>
            <p class="text-xs text-center mt-4">
                Already have an account? <a href="{{ route('login.show') }}"
                    class="text-blue-500 hover:underline">Login</a>
            </p>
        </form>
    </div>
</body>

</html>