<nav x-data="{ open: false }" class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- KIRI: LOGO + NAMA APLIKASI -->
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-green-700">
                        Pengaduan Masyarakat
                    </a>
                </div>
            </div>

            <!-- KANAN: USER LOGIN -->
            @auth
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:text-gray-900 focus:outline-none transition ease-in-out duration-150">
                            <div class="text-right">
                                <div class="font-semibold">
                                    {{ Auth::user()->name }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ strtoupper(Auth::user()->role) }}
                                    @if(Auth::user()->kecamatan)
                                        - {{ Auth::user()->kecamatan }}
                                    @endif
                                    @if(Auth::user()->wilayah)
                                        ({{ Auth::user()->wilayah }})
                                    @endif
                                </div>
                            </div>

                            <div class="ml-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <!-- DROPDOWN MENU -->
                    <x-slot name="content">

                        <!-- DASHBOARD SESUAI ROLE -->
                        @if(Auth::user()->role === 'lurah')
                            <x-dropdown-link :href="route('lurah.dashboard')">
                                Dashboard Lurah
                            </x-dropdown-link>
                        @elseif(Auth::user()->role === 'camat')
                            <x-dropdown-link :href="route('camat.dashboard')">
                                Dashboard Camat
                            </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-100"></div>

                        <!-- LOGOUT -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Logout
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @endauth

            <!-- HAMBURGER (MOBILE) -->
            @auth
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }"
                            class="inline-flex" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }"
                            class="hidden" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            @endauth
        </div>
    </div>

    <!-- MENU MOBILE -->
    @auth
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">
                    {{ Auth::user()->name }}
                </div>
                <div class="text-sm text-gray-500">
                    {{ strtoupper(Auth::user()->role) }}
                    @if(Auth::user()->kecamatan)
                        - {{ Auth::user()->kecamatan }}
                    @endif
                    @if(Auth::user()->wilayah)
                        ({{ Auth::user()->wilayah }})
                    @endif
                </div>
            </div>

            <div class="mt-3 space-y-1">
                @if(Auth::user()->role === 'lurah')
                    <x-responsive-nav-link :href="route('lurah.dashboard')">
                        Dashboard Lurah
                    </x-responsive-nav-link>
                @elseif(Auth::user()->role === 'camat')
                    <x-responsive-nav-link :href="route('camat.dashboard')">
                        Dashboard Camat
                    </x-responsive-nav-link>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Logout
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
    @endauth
</nav>
