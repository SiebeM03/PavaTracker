<x-pava-tracker-layout >
    <x-slot name="description">Test description</x-slot>
    <x-slot name="title">Home</x-slot>
    
    <div class="sm:flex flex-row gap-2 lg:gap-4">
        <!-- Members & CWL & raid card -->
        <div class="sm:basis-2/3">
            <!-- Members card -->
            <x-pt.section class="pr-4 p-2">
                <div class="flex">
                    <img class="w-20 h-20"
                            src="https://api-assets.clashofclans.com/badges/200/ueT7vZDg9TiX_BLzhPUwu-FKKERJR4NRFwgB_yMHjNo.png"/>
                    <div class="w-max ml-3 flex flex-col">
                        <h1 class="text-xl text-white font-bold">Pava X</h1>
                        <span class="text-sm text-gray-400 mt-0 font-medium">Members: 49/50</span> <span
                                class="text-sm text-gray-400 mt-0 font-medium">Invite Only</span>
                        <div class="flex lg:hidden flex-wrap">
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
                <div class="desc -mr-1">
                    <div class="text-sm text-gray-400 m-2 mb-0 mr-0 overflow-y-auto max-h-20 pr-2 pb-3">
                        Welkom! Constant oorlog in deze clan⚔️ Daarom zoeken we ook nieuwe actieve oorlogdeelnemers! doe
                        je graag CW en val je altijd 2 keer aan? Join dan zeker onze clan! Groen schild: in war 2x
                        aanvallen! Veel plezier! P.S. te lage th? Join PAVA Y!
                    </div>
                    <b></b>
                </div>
            </x-pt.section>
            <div class="flex mt-2 lg:mt-4 gap-2 lg:gap-4">
                <!-- Raids card -->
                <x-pt.section class="basis-1/2 h-40 p-2">
                    <div class="text-lg text-white font-bold border-b-2 border-[#5e5e8b] text-center">Clan Capital
                        Raids
                    </div>
                </x-pt.section>
                <!-- CG card -->
                <x-pt.section class="basis-1/2 h-40 p-2">
                    <div class="text-lg text-white font-bold border-b-2 border-[#5e5e8b] text-center">Clan Games</div>
                </x-pt.section>
            </div>
        </div>
        <!-- CW card -->
        <x-pt.section class="sm:basis-1/3 mt-2 sm:mt-0 text-sm p-2">
            <div class="text-lg text-white font-bold border-b-2 border-[#5e5e8b] text-center">Clan War</div>
            <div class="mt-2 mx-1 sm:max-md:mx-0">
                <div class="flex">
                    <span class="block sm:max-md:hidden">Frequency: Always</span> <span class="hidden sm:max-md:block">Freq. : Always</span>
                </div>
                <div>Win Streak: 4</div>
                <div class="flex flex-no-wrap leading-4 align-middle">
                    
                    <div class="flex">
                        <span class="block sm:max-md:hidden">Average destruction: 92.17%</span> <span
                                class="hidden sm:max-md:block">Avg. destruction: 92.17%</span>
                    </div>
                </div>
            </div>
            <div>
                <div class="flex flex-wrap text-white gap-x-4 gap-y-1 justify-center sm:max-lg:justify-start mt-2 mx-1 sm:max-md:mx-0">
                    <div class="flex flex-no-wrap leading-4">
                        <div class="w-4 h-4 bg-green-400 rounded-lg mr-2"></div>
                        Win
                    </div>
                    <div class="flex flex-no-wrap leading-4">
                        <div class="w-4 h-4 bg-yellow-400 rounded-lg mr-2"></div>
                        Tie
                    </div>
                    <div class="flex flex-no-wrap leading-4">
                        <div class="w-4 h-4 bg-red-400 rounded-lg mr-2"></div>
                        Loss
                    </div>
                </div>
                <div class="flex w-full mt-2 h-5 rounded-full overflow-hidden divide-x divide-white border-4 border-[#5e5e8b]">
                    <div class="w-[69%] bg-green-400 hover:bg-green-500"></div>
                    <div class="w-[8%] bg-yellow-400 hover:bg-yellow-500"></div>
                    <div class="w-[23%] bg-red-400 hover:bg-red-500"></div>
                </div>
            </div>
        </x-pt.section>
    </div>
    
    <!-- Table card -->
    <x-pt.section class="mt-4 p-0 relative overflow-hidden">
        <div class="mb-0 mt-0 -px-4 overflow-x-auto table-div ">
            <table class="w-full text-sm text-left text-gray-400">
                <thead class="text-xs text-cyan-300 uppercase bg-[#1e1e2c] sticky top-0">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Donations/received
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Trophies
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Trophies
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="border-b odd:bg-[#383852] even:bg-[#2c2c40] border-[#41415f]">
                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white hover:cursor-pointer"
                            onclick="copyText('#9YUV80C2')">
                        N_Lena
                        <div class="text-xs text-gray-400 -mt-1">Leader</div>
                    </th>
                    <td class="px-6 py-4">
                        <div class="flex">
                            <svg class="w-4 h-4 text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m7 10 2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <div class="leading-4 pl-1">8029 / 11775</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex">
                            <img class="w-8 h-8"
                                    src="https://api-assets.clashofclans.com/leagues/36/R2zmhyqQ0_lKcDR5EyghXCxgyC9mm_mVMIjAbmGoZtw.png"/>
                            <div class="leading-8 pl-1">5388</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex">
                            <img class="w-6 h-6"
                                    src="https://static.wikia.nocookie.net/clashofclans/images/6/63/TrophyB.png"/>
                            <div class="leading-6 pl-1">4746</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-cyan-300 hover:underline">Edit</a>
                    </td>
                </tr>
                <tr class="border-b odd:bg-[#383852] even:bg-[#2c2c40] border-[#41415f]">
                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white hover:cursor-pointer"
                            onclick="copyText('#LUUCLV28Q')">
                        Hulsstart
                        <div class="text-xs text-gray-400 -mt-1">Co-leader</div>
                    </th>
                    <td class="px-6 py-4">
                        <div class="flex">
                            <svg class="w-4 h-4 text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m7 10 2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <div class="leading-4 pl-1">2773 / 3888</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex">
                            <img class="w-8 h-8"
                                    src="https://api-assets.clashofclans.com/leagues/36/R2zmhyqQ0_lKcDR5EyghXCxgyC9mm_mVMIjAbmGoZtw.png"/>
                            <div class="leading-8 pl-1">5313</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex">
                            <img class="w-6 h-6"
                                    src="https://static.wikia.nocookie.net/clashofclans/images/6/63/TrophyB.png"/>
                            <div class="leading-6 pl-1">5005</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-cyan-300 hover:underline">Edit</a>
                    </td>
                </tr>
                <tr class="border-b odd:bg-[#383852] even:bg-[#2c2c40] border-[#41415f]">
                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white hover:cursor-pointer"
                            onclick="copyText('#L9VL28Q90')">
                        Lena
                        <div class="text-xs text-gray-400 -mt-1">Co-leader</div>
                    </th>
                    <td class="px-6 py-4">
                        <div class="flex">
                            <svg class="w-4 h-4 text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m7 10 2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <div class="leading-4 pl-1">6651 / 2509</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex">
                            <img class="w-8 h-8"
                                    src="https://api-assets.clashofclans.com/leagues/36/R2zmhyqQ0_lKcDR5EyghXCxgyC9mm_mVMIjAbmGoZtw.png"/>
                            <div class="leading-8 pl-1">5054</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex">
                            <img class="w-6 h-6"
                                    src="https://static.wikia.nocookie.net/clashofclans/images/6/63/TrophyB.png"/>
                            <div class="leading-6 pl-1">3499</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-cyan-300 hover:underline">Edit</a>
                    </td>
                </tr>
                <tr class="border-b odd:bg-[#383852] even:bg-[#2c2c40] border-[#41415f]">
                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white hover:cursor-pointer"
                            onclick="copyText('#2R0QL0VLQ')">
                        Missey
                        <div class="text-xs text-gray-400 -mt-1">Elder</div>
                    </th>
                    <td class="px-6 py-4">
                        <div class="flex">
                            <svg class="w-4 h-4 text-red-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <div class="leading-4 pl-1">483 / 1345</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex">
                            <img class="w-8 h-8"
                                    src="https://api-assets.clashofclans.com/leagues/36/9v_04LHmd1LWq7IoY45dAdGhrBkrc2ZFMZVhe23PdCE.png"/>
                            <div class="leading-8 pl-1">4048</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex">
                            <img class="w-6 h-6"
                                    src="https://static.wikia.nocookie.net/clashofclans/images/6/63/TrophyB.png"/>
                            <div class="leading-6 pl-1">5510</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-cyan-300 hover:underline">Edit</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </x-pt.section>
</x-pava-tracker-layout>