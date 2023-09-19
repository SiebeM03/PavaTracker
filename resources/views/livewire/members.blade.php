@if($visibleOnOverview)
    <x-pt.section wire:init="updateMembersData">Filter</x-pt.section>
@endif

<x-pt.section class="mt-4 p-0 relative overflow-auto bg-transparent" wire:init="updateMembersData">
    {{-- TODO fix preloader constantly showing --}}
    <div class="mb-0 mt-0 -px-4 flex-grow">
        <table class="w-full text-sm text-left text-card-gray-400 table-fixed">
            <thead class="text-xs text-accent uppercase bg-table-header sticky top-0 z-20">
            <tr class="[&>th]:border-t-2 odd:[&>th]:border-red-500 even:[&>th]:border-white"> {{--[&>th]:border-t-2 odd:[&>th]:border-red-500 even:[&>th]:border-white --}}
                <th scope="col" class="px-6 py-3 sticky top-0 left-0 z-20 bg-table-header min-w-0 md:w-1/3 lg:1/4">
                    Name
                </th>
                <th scope="col" class="w-16 text-center">
                    TH
                </th>
                <th scope="col" class="px-6 py-3">
                    Donations/received
                </th>
                <th scope="col" class="px-3 py-3">
                    Trophies
                </th>
                <th scope="col" class="px-3 py-3">
                    Trophies
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            {{-- TODO doesnt work in Members page (page loads faster than value is assigned to $error i think) --}}
            @if(isset($error['reason']))
                <tr class="bg-table-odd border-b border-table-border">
                    <td colspan="5" class="text-center h-10">{{ $error["message"] }}</td>
                </tr>
            @endif
            @if(isset($clan))
                @foreach($clan->players as $member)
                    <tr class="odd:bg-table-odd even:bg-table-even border-b border-table-border">
                        <th scope="row"
                                class="px-6 py-4 font-medium whitespace-nowrap text-card-title hover:cursor-pointer sticky left-0 z-10 bg-inherit flex md:w-1/3 lg:1/4"
                                onclick="copyTag('{{ $member->tag }}')">
                            <div class="">
                                {{ $member->name }}
                                <div class="text-xs text-card-gray-400 -mt-1">{{ ucfirst(preg_replace('/(?<!\ )[A-Z]/', ' $0', $member->role)) }}</div>
                            </div>
                        </th>
                        <td class="px-2">
                            <x-pt.icons.th :member="$member"/>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex">
                                <x-pt.icons.donationsRatio size="4"
                                        positive="{{ $member->donations_received / 4 <= $member->donations }}"/>
                                <div class="leading-4 pl-1">{{ $member->donations }}
                                    / {{ $member->donations_received }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex">
                                <img class="w-8 h-8" alt="trophies"
                                        src="https://api-assets.clashofclans.com/leagues/36/R2zmhyqQ0_lKcDR5EyghXCxgyC9mm_mVMIjAbmGoZtw.png"/>
                                {{-- TODO make lable change --}}
                                <div class="leading-8 pl-1">{{ $member->trophies }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex">
                                <img class="w-6 h-6" alt="versus trophies"
                                        src="https://static.wikia.nocookie.net/clashofclans/images/6/63/TrophyB.png"/>
                                <div class="leading-6 pl-1">{{ $member->versus_trophies }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-accent hover:underline">Edit</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="bg-table-odd border-b border-table-border">
                    <td colspan="5" class="text-center h-10">EMPTY</td>
                </tr>
            @endif
            
            </tbody>
        </table>
    </div>
    
    @push('script')
        <script type="text/javascript">
            function copyTag(tag) {
                navigator.clipboard.writeText(tag);
            }
        </script>
    @endpush
</x-pt.section>