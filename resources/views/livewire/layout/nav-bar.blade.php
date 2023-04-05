<div>
    <nav class="container mx-auto p-4 flex justify-between">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
                integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <div class="flex items-center space-x-2">
            <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                Home
            </x-nav-link>
            <x-nav-link href="{{ route('playground') }}" :active="request()->routeIs('playground')">
                Playground
            </x-nav-link>
            <x-nav-link href="{{ route('clan') }}" :active="request()->routeIs('clan')">
                Clan
            </x-nav-link>
            <x-nav-link href="{{ route('player') }}" :active="request()->routeIs('player')">
                Player
            </x-nav-link>
        </div>
        
        
        <div class="relative flex items-center space-x-2 gap-4">
            @guest
                <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                    Login
                </x-nav-link>
                <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                    Register
                </x-nav-link>
            @endguest
            
            @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <div class="cursor-pointer text-2xl">
                            <i class="fa-regular fa-user"></i>
                        </div>
                    </x-slot>
                    <x-slot name="content">
                        <div class="block px-4 py-2 text-xs text-gray-400">{{auth()->user()->email}}</div>
                        <x-dropdown-link href="{{ route('profile.show') }}">Manage account</x-dropdown-link>
                        <div class="border-t border-gray-100"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
                                Log out
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>
            @endauth
        </div>
    </nav>
</div>
