<x-filament-panels::page>

    
    <div class="flex justify-center items-center h-full px-36">
        
        <div class="flex items-center">
            {{ $this->form }}
        </div>
        
        <div class="flex items-center ml-8 p-4">
            <button type="button" wire:click="submit" class="px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600 focus:ring-yellow-500" style="background-color: gold;">
                Submit
            </button>
        </div>
    </div>

    @if ($showTable)
        <div class="mt-8">
            {{ $this->table }}
        </div>
    @endif

</x-filament-panels::page>