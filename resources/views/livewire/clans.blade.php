<div>
    <x-tmk.section>
        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 pb-0">
            @foreach($clans as $clan)
                <li class="mr-2" wire:key="{{ $clan->id }}">
                    <button wire:click="setActiveClan({{ $clan->id }})"
                            class="inline-block p-4 rounded-t-lg {{ $clan->id === $activeClan->id ? 'text-blue-600 bg-gray-100 active dark:bg-gray-800 dark:text-blue-500' : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300' }}">{{ $clan->name }}
                    </button>
                </li>
            @endforeach
        </ul>
        
        @if($clans->first() !== null)
            <p>{{ $activeClan->name }}</p>
        @endif
    </x-tmk.section>
</div>
