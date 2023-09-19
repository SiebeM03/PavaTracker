@php use App\Helpers\PlayerAPI; @endphp
<div class="sm:flex flex-row gap-2 lg:gap-4" wire:init="updateClanData">
    <!-- Members & CWL & raid card -->
    <div class="sm:basis-2/3">
        <!-- Members card -->
        <x-pt.section class="pr-4 p-2">
            <div class="flex">
                <img class="w-20 h-20" src="{{ $clan->badge_url_m }}" alt="{{ $clan->name }}"/>
                <div class="w-max ml-3 flex flex-col">
                    <h1 class="text-xl text-card-title font-bold">{{ $clan->name }}</h1>
                    <span class="text-sm text-card-gray-400 mt-0 font-medium">Members: {{ $clan->players()->count() }}/50</span>
                    <span
                            class="text-sm text-card-gray-400 mt-0 font-medium">{{ ucfirst(preg_replace('/(?<!\ )[A-Z]/', ' $0', $clan->type)) }}</span>
                    <div class="flex lg:hidden flex-wrap">
                        {{-- TODO make automatic --}}
                        <img class="h-10 w-10 sm:max-md:h-7 sm:max-md:w-7 opacity-90"
                                src="https://api-assets.clashofclans.com/labels/64/lXaIuoTlfoNOY5fKcQGeT57apz1KFWkN9-raxqIlMbE.png"/>
                        <img class="h-10 w-10 sm:h-7 sm:w-7 md:h-10 md:w-10 opacity-90"
                                src="https://api-assets.clashofclans.com/labels/64/7qU7tQGERiVITVG0CPFov1-BnFldu4bMN2gXML5bLIU.png"/>
                        <img class="h-10 w-10 sm:h-7 sm:w-7 md:h-10 md:w-10 opacity-90"
                                src="https://api-assets.clashofclans.com/labels/64/DhBE-1SSnrZQtsfjVHyNW-BTBWMc8Zoo34MNRCNiRsA.png"/>
                    </div>
                </div>
                <div class="hidden lg:flex flex-no-wrap my-auto ml-auto">
                    <img class="h-10 w-10 sm:h-7 sm:w-7 md:h-10 md:w-10 opacity-90"
                            src="https://api-assets.clashofclans.com/labels/64/lXaIuoTlfoNOY5fKcQGeT57apz1KFWkN9-raxqIlMbE.png"/>
                    <img class="h-10 w-10 sm:h-7 sm:w-7 md:h-10 md:w-10 opacity-90"
                            src="https://api-assets.clashofclans.com/labels/64/7qU7tQGERiVITVG0CPFov1-BnFldu4bMN2gXML5bLIU.png"/>
                    <img class="h-10 w-10 sm:h-7 sm:w-7 md:h-10 md:w-10 opacity-90"
                            src="https://api-assets.clashofclans.com/labels/64/DhBE-1SSnrZQtsfjVHyNW-BTBWMc8Zoo34MNRCNiRsA.png"/>
                </div>
            </div>
            <div class="desc relative -mr-1">
                <div class="text-sm text-card-gray-400 m-2 mb-0 mr-0 overflow-y-auto max-h-20 pr-2 pb-3">
                    {{ $clan->description }}
                </div>
                <b class="absolute bottom-0 left-0 h-0 w-full after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-full after:h-5"></b>
            </div>
        </x-pt.section>
        <div class="flex mt-2 lg:mt-4 gap-2 lg:gap-4">
            <!-- Raids card -->
            <x-pt.section class="basis-1/2 h-40 p-2">
                <x-slot name="title">Clan Capital Raids</x-slot>
            </x-pt.section>
            <!-- CG card -->
            <x-pt.section class="basis-1/2 h-40 p-2">
                <x-slot name="title">Clan Games</x-slot>
            </x-pt.section>
        </div>
    </div>
    <!-- CW card -->
    <x-pt.section class="sm:basis-1/3 mt-2 sm:mt-0 text-sm p-2">
        <x-slot name="title">Clan War</x-slot>
        <div class="mt-2 mx-1 sm:max-md:mx-0">
            <div class="flex">
                <span class="block sm:max-md:hidden">Frequency: Always</span> <span class="hidden sm:max-md:block">Freq. : Always</span>
            </div>
            <div>Win Streak: {{ $clan->war_win_streak }}</div>
            <div class="flex flex-no-wrap leading-4 align-middle">
                <div class="flex">
                    <div class="block sm:max-md:hidden">Average destruction: 92.17%</div>
                    <div class="hidden sm:max-md:block">Avg. destruction: 92.17%</div>
                </div>
            </div>
        </div>
        <div>
            <div class="flex flex-wrap text-white gap-x-4 gap-y-1 justify-center sm:max-lg:justify-start mt-2 mx-1 sm:max-md:mx-0">
                <div class="flex flex-no-wrap leading-4">
                    <div class="w-4 h-4 bg-alert-success-400 rounded-lg mr-2"></div>
                    Win
                </div>
                <div class="flex flex-no-wrap leading-4">
                    <div class="w-4 h-4 bg-alert-warning-400 rounded-lg mr-2"></div>
                    Tie
                </div>
                <div class="flex flex-no-wrap leading-4">
                    <div class="w-4 h-4 bg-alert-danger-400 rounded-lg mr-2"></div>
                    Loss
                </div>
            </div>
            
            @if($clan->public_war_log)
                <div class="flex w-full mt-2 h-5 rounded-full overflow-hidden divide-x divide-white border-4 border-card-title-border cw">
                    <div class="bg-alert-success-400 hover:bg-alert-success-500"
                            data-tippy-content="<header>Wins</header><p>Total wars: {{ $clan->war_wins + $clan->war_ties + $clan->war_losses }}</p><p>Total won: {{ $clan->war_wins }}</p><p>Relative: {{ round($clan->war_wins / ($clan->war_wins + $clan->war_ties + $clan->war_losses) * 100, 0) }}%</p>"
                            style="width: {{ round($clan->war_wins / ($clan->war_wins + $clan->war_ties + $clan->war_losses) * 100, 0) }}%"></div>
                    <div class="bg-alert-warning-400 hover:bg-alert-warning-500"
                            data-tippy-content="<header>Ties</header><p>Total wars: {{ $clan->war_wins + $clan->war_ties + $clan->war_losses }}</p><p>Total tied: {{ $clan->war_ties }}</p><p>Relative: {{ round($clan->war_ties / ($clan->war_wins + $clan->war_ties + $clan->war_losses) * 100, 0) }}%</p>"
                            style="width: {{ round($clan->war_ties / ($clan->war_wins + $clan->war_ties + $clan->war_losses) * 100, 0) }}%"></div>
                    <div class="bg-alert-danger-400 hover:bg-alert-danger-500"
                            data-tippy-content="<header>Losses</header><p>Total wars: {{ $clan->war_wins + $clan->war_ties + $clan->war_losses }}</p><p>Total lost: {{ $clan->war_losses }}</p><p>Relative: {{ round($clan->war_losses / ($clan->war_wins + $clan->war_ties + $clan->war_losses) * 100, 0) }}%</p>"
                            style="width: {{ round($clan->war_losses / ($clan->war_wins + $clan->war_ties + $clan->war_losses) * 100, 0) }}%"></div>
                </div>
            @endif
        </div>
    </x-pt.section>
</div>

<!-- Table card -->
@livewire('members', ['visibleOnOverview' => false])