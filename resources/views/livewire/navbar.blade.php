<div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <nav class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false" onclick="mobileMenu()">
                        <span class="sr-only">Open main menu</span>
                        <!--
                          Icon when menu is closed.

                          Heroicon name: outline/menu

                          Menu open: "hidden", Menu closed: "block"
                        -->
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!--
                          Icon when menu is open.

                          Heroicon name: outline/x

                          Menu open: "block", Menu closed: "hidden"
                        -->
                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 flex items-center justify-start sm:items-stretch sm:justify-start">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}">
                            <img class="block lg:hidden h-8 w-auto m-12" src="{{ asset("storage/toko-logo.png")  }}" alt="Toko Komputer" />
                        </a>

                        <a href="{{ route('home') }}">
                            <img class="hidden lg:block h-8 w-auto" src="{{ asset("storage/toko-logo.png")  }}" alt="Toko Komputer">
                        </a>
                    </div>
                    <div class="hidden sm:block sm:ml-6">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="/" class="{{ $route == 'home' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium" aria-current="page">
                                Beranda
                            </a>

                            <a href="/toko" class="{{ $route == 'toko' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium" aria-current="page">
                                Toko
                            </a>

                            <a href="/tentang" class="{{ \Illuminate\Support\Facades\Route::is("tentang") ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium" aria-current="page">
                                Tentang
                            </a>

                            <a href="/kontak" class="{{ \Illuminate\Support\Facades\Route::is("kontak") ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium" aria-current="page">
                                Kontak
                            </a>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <button class="bg-red-800 p-1 text-gray-400 rounded mx-2 px-2 hover:text-white focus:outline-none"
                            wire:click="checkCart">
                        <span class="sr-only">View notifications</span>
                        <!-- Heroicon name: outline/bell -->
                        <i class="fas fa-shopping-cart"></i>
                        <span class="count mx-2">{{ $total }}</span>
{{--                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />--}}
{{--                        </svg>--}}
                    </button>

                    <!-- Profile dropdown -->
                    <div class="ml-3 relative">
                        @auth('web')
                        <div>
                            <button type="button"
                                    class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2
                                    focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                                    id="user-menu-button" aria-expanded="false" aria-haspopup="true"
                                    onclick="userMenu()">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full" src="{{ asset($user->profile_photo_path) }}"
                                     alt="{{ $user->name }}">
                            </button>
                        </div>
                        @endauth

                        @guest('web')
                            <div>
                                <button class="bg-blue-800 text-gray-300 hover:bg-blue-700 py-2 px-4 rounded"
                                        wire:click="login()">Masuk</button>
                            </div>
                        @endguest

                        <div class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1
                        bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu"
                             aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                             id="user-account-navigation">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            <span class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-300 cursor-pointer"
                               id="user-menu-item-0" wire:click="dashboard()">Dashboard</span>
                            <span class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-300 cursor-pointer"
                               id="user-menu-item-2" wire:click="logout()">Sign out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="{{ route('home') }}" class="{{ $route == 'home' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium" aria-current="page">Beranda</a>

                <a href="{{ route('toko') }}" class="{{ $route == 'toko' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">Toko</a>

                <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Tentang</a>

                <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Kontak</a>
            </div>
        </div>
    </nav>
</div>
