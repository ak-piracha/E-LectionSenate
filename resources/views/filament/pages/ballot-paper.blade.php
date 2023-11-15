<x-filament-panels::page>
    <div class="flex flex-row">
        <div class="w-full">
            <ul class="flex border-b">
                <li class="-mb-px mr-1">
                    <a class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold" href="#" wire:click.prevent="setTab('above')">Above The Line</a>
                </li>
                <li class="mr-1">
                    <a class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold" href="#" wire:click.prevent="setTab('below')">Below The Line</a>
                </li>
            </ul>
            <div class="mt-4">
                @if ($activeTab === 'above')
                    @livewire('above-the-line')
                @elseif ($activeTab === 'below')
                    @livewire('below-the-line')
                @endif
            </div>
        </div>
    </div>
</x-filament-panels::page>
