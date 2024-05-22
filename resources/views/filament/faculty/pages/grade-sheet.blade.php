<x-filament-panels::page>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        
        <div class="p-3 rounded-md shadow-sm">
            <button type="submit" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" style="background-color: gold;">
                Submit
            </button>
        </div>
    </form>

    @if ($showTable)
        <div class="p-6 rounded-md shadow-sm">
            {{ $this->table }}
        </div>
    @endif
    
</x-filament-panels::page>
