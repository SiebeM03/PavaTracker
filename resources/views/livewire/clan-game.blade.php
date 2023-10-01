@if($showingOverview)
    <x-pt.section class="basis-1/2 h-40 p-2">
        <x-slot name="title">Clan Games</x-slot>
        <p>Total points: {{ $totalPointsLastClanGame }}</p>
    </x-pt.section>
@else
    <x-pt.section>
        <x-slot name="title">Clan Games</x-slot>
    
        <div class="mb-0 mt-0 -px-4 flex-grow">
            <table class="w-full text-sm text-left text-card-gray-400 table-fixed">
                <thead class="text-xs text-accent uppercase bg-table-header sticky top-0 z-20">
                <tr>
                    <th>Player</th>
                    @foreach($playerWithMostClanGames->clanGames->slice(1) as $clanGame)
                        <th class="text-right px-2 py-3">{{ (new DateTime($clanGame->date))->format('M Y') }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($players as $player)
                    <tr class="odd:bg-table-odd even:bg-table-even border-b border-table-border">
                        <td>{{ $player->name }}</td>
                    
                        @foreach($playerWithMostClanGames->clanGames->slice(1) as $clanGame)
                            <td class="text-right">{{ $this->getClanGamePerformance($player, $clanGame->clanGameNumber) ?? '.' }}</td>
                        @endforeach
                    </tr>
            
                @endforeach
                </tbody>
            </table>
        </div>
    </x-pt.section>
@endif