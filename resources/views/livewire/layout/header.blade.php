@php use App\Helpers\PlayerAPI; @endphp
<header class="bg-side sm:bg-main sm:border-none border-b-2 border-cyan-300 sm:pr-8">
    <div class="max-sm:mr-4 py-4 max-w-screen-xl flex flex-nowrap items-center sm:justify-end">
        <div class="text-accent text-xs text-center cursor-pointer sm:mr-auto">
            <span class="sm:hidden">&lt; 640</span> <span class="hidden sm:block md:hidden">SM | 640 - 768</span> <span
                    class="hidden md:block lg:hidden">MD | 768 - 1024</span> <span class="hidden lg:block xl:hidden">LG | 1024 - 1280</span>
            <span class="hidden xl:block 2xl:hidden">XL | 1280 - 1536</span> <span class="hidden 2xl:block">2XL |  &gt; 1536</span>
        </div>
        
        <!-- Title for mobile -->
        <a class="flex items-center sm:hidden mr-auto">
            <span class="no-underline decoration-cyan-300 hover:underline hover:cursor-pointer self-center text-3xl font-bold font-semibold whitespace-nowrap text-white">
                Pava Tracker
            </span> </a>
        
        
        @guest()
            <div class="flex flex-wrap justify-end gap-x-2">
                <x-layout.header.nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                    Login
                </x-layout.header.nav-link>
                <x-layout.header.nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                    Register
                </x-layout.header.nav-link>
            </div>
        @endguest
        
        @auth
            <x-pt.dropdown name="playerDropdown">
                <x-slot name="text">
                    <div class="w-full sm:px-5 h-9 text-center inline-flex items-center place-content-between">
                        <span class="hidden sm:block whitespace-nowrap overflow-x-hidden text-ellipsis">{{ $activePlayer->name ?? 'No players selected' }}</span>
                        
                        <svg :class="{'-rotate-180': playerDropdown_open }" class="w-3 h-3 mx-auto sm:mr-1"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4"/>
                        </svg>
                    </div>
                </x-slot>
                
                @foreach($clans as $clan)
                    <ul class="py-2">
                        <div class="flex text-card-title font-bold mx-3 mb-1 pb-1 border-b-2 border-card-title-border">
                            <img class="left-3 w-8 h-8 mr-1" src="{{ $clan->badge_url_m }}" alt="{{ $clan->name }}"/>
                            <p class="leading-8 truncate justify-self-center">{{ $clan->name }}</p>
                        </div>
                        @foreach($clan->players as $player)
                            <li wire:key="player_{{ $player }}"
                                    wire:click="setActivePlayer({{ $player->id }})"
                                    class="{{ $activePlayer == $player ? 'font-bold border-l-4 border-accent' : '' }} hover:cursor-pointer">
                                <a class="flex px-4 py-2 hover:bg-card-title-border focus:outline-none [&>span]:focus:border-accent">
                                    <img src="{{ asset('/storage/th_icons/th' . $player->getTownHallLevel()[0] . '.png') }}"
                                            alt="Town Hall {{ $player->getTownHallLevel()[0] }}"
                                            class="h-6 {{ $activePlayer == $player ? '' : 'ml-1' }}">
                                    <p class="ml-2 leading-6 truncate">{{ $player->name }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
                
                <ul class="border-card-title-border {{ isset($clans) ? '' : 'border-t-2 ' }}">
                    <li wire:click="setNewPlayer()">
                        <a class="block px-4 py-3 hover:bg-card-title-border focus:outline-none [&>span]:focus:border-accent flex hover:cursor-pointer">
                            Link new user
                            <svg class="w-4 h-4 my-auto ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="20" height="20" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </x-pt.dropdown>
            
            
            <x-pt.dropdown name="userDropdown" width="9" align="right">
                <x-slot name="text">
                    <svg class="w-9 h-9 p-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-2 3h4a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z"/>
                    </svg>
                </x-slot>
                
                <ul class="gap-y-2">
                    <li>
                        <a href="{{ route('profile.show') }}"
                                class="w-full flex px-4 py-2 hover:bg-card-title-border focus:outline-none">
                            {{ __('Profile') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class=" w-full flex px-4 py-2 hover:bg-card-title-border focus:outline-none">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </x-pt.dropdown>
            
            
            <x-pt.dialog-modal wire:model="showNewPlayerModal" maxWidth="lg">
                <x-slot name="title">Link new player account</x-slot>
                <x-slot name="content">
                    @if ($errors->any())
                        <x-pt.alert type="danger">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </x-pt.alert>
                    @endif
                    
                    <div class="relative z-0 w-full group">
                        <x-pt.input name="playerTag" id="playerTag" text="Player Tag" wire:model="newPlayer.playerTag"
                                required/>
                    </div>
                    <div class="relative z-0 w-full group pb-6">
                        <x-pt.input name="apiToken" id="apiToken" text="API Token" wire:model="newPlayer.apiToken"
                                required/>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <button wire:click="linkNewPlayer()" class="btn-primary py-1.5 w-20 mr-2">
                        Add
                    </button>
                    <button x-on:click="show = false" class="btn-secondary py-1.5 w-20">
                        Cancel
                    </button>
                </x-slot>
            </x-pt.dialog-modal>
        @endauth
    </div>
</header>




