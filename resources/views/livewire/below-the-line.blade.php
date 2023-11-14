<div class="block mt-4 p-4 border border-gray-200 rounded shadow-sm">
    <label for="voteForm" class="text-lg font-bold">Below The Line</label>
    <form id="voteForm" wire:submit.prevent="submit" class="flex flex-col">
        <div class="table-responsive">
            {{-- {{ $this->form }} --}}
        </div>
        <div class="ml-auto mt-4">
            <x-secondary-button wire:click="submit" wire:loading.attr="disabled">
                {{ __('Vote') }}
            </x-secondary-button>
        </div>
    </form>
</div>
