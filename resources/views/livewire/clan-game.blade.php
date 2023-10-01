<x-pt.section class="basis-1/2 h-40 p-2">
    <x-slot name="title">Clan Games</x-slot>
    
    <div class="mb-0 mt-0 -px-4 flex-grow">
        <button wire:click="getPlayersData">Retrieve TH</button>
        <table class="w-full text-sm text-left text-card-gray-400 table-fixed">
            <thead class="text-xs text-accent uppercase bg-table-header sticky top-0 z-20">
            <tr>
                <th>Player</th>
                @for($n = $firstClanGame->clanGameNumber; $n <= $lastClanGame->clanGameNumber; $n++)
                    <th>{{ DateTime::createFromFormat('Y-m-d H:i:s', $firstClanGame->date)->modify('+'. ($n - $firstClanGame->clanGameNumber) . ' month')->format('M Y') }}</th>
                @endfor
            </tr>
            </thead>
            <tbody>
                @foreach($players as $player)
                    <tr class="odd:bg-table-odd even:bg-table-even border-b border-table-border [&>td]:border-r">
                        <td>{{ $player->name }}</td>
                        @for($n = $firstClanGame->clanGameNumber; $n <= $lastClanGame->clanGameNumber; $n++)
                            <td>{{ $this->getClanGamePerformance($player, $n) }}</td>
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-pt.section>