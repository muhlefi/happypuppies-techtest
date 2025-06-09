<header id="main-header" class="bg-white border-b border-gray-200 px-6 py-4 fixed top-0 w-full z-30">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <button id="mobile-menu-btn" class="p-2 rounded-lg hover:bg-gray-100">
                <i class="fas fa-bars text-gray-600"></i>
            </button>
        </div>

        <div class="flex items-center gap-4">
            <div class="relative">
                <button id="user-menu-button" class="flex items-center gap-3 focus:outline-none cursor-pointer">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                        <span class="text-sm font-medium text-white">{{ $user ? mb_strtoupper(substr($user->name, 0, 1)) : 'G' }}</span>
                    </div>
                    <div class="hidden md:block">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-medium text-gray-900">{{ $user->name ?? 'User' }}</span>
                            <i class="fas fa-chevron-down text-gray-400 text-xs transition-transform duration-200 ease-in-out" id="user-menu-arrow"></i>
                        </div>
                    </div>
                </button>

                <div id="user-dropdown-menu"
                    class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md py-1 focus:outline-none hidden transition-all duration-200 ease-out origin-top-right transform scale-95 opacity-0"
                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100 cursor-pointer" role="menuitem" tabindex="-1" id="user-menu-item-2">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
