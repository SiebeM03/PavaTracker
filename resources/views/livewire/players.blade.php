<div>
    <x-tmk.section>
        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 pb-0">
            @foreach($players as $player)
                <li class="mr-2" wire:key="{{ $player->id }}">
                    <button wire:click="setActivePlayer({{ $player->id }})"
                            class="inline-block p-4 rounded-t-lg {{ $player->id === $activePlayer->id ? 'text-blue-600 bg-gray-100 active dark:bg-gray-800 dark:text-blue-500' : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300' }}">{{ $player->name }}
                    </button>
                </li>
            @endforeach
            <li class="mr-2" wire:key="-1">
                <button wire:click="$set('newPlayerModal', true)"
                        class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">
                    <x-phosphor-plus class="inline w-4 h-4 mx-0.5"/>
                </button>
            </li>
        </ul>
        
        @if($players->first() !== null)
            <p>{{ $activePlayer->name }}</p>
        @endif
    </x-tmk.section>
    
    <x-dialog-modal id="playerModal"
            wire:model="newPlayerModal">
        <x-slot name="title">
            <h2>Add new player</h2>
        </x-slot>
        <x-slot name="content">
            @if ($errors->any())
                <x-tmk.alert type="danger">
                    <x-tmk.list>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </x-tmk.list>
                </x-tmk.alert>
            @endif
            <x-label for="tag" value="Playertag" class="mt-4"/>
            <x-input id="tag" type="text"
                    wire:model.defer="newPlayer.tag"
                    class="w-full shadow-md"/>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('newPlayerModal', false)">Cancel</x-secondary-button>
            <x-button
                    wire:click="addPlayer()"
                    wire:loading.attr="disabled"
                    class="ml-2">Add player
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>

