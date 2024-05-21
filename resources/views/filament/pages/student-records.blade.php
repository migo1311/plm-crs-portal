<x-filament-panels::page>
    <form wire:submit.prevent="create">
        {{ $this->personal }}
        <div class=" h-5">
        
        </div>    
        {{ $this->form }}
        <div class="p-3 rounded-md shadow-sm">
            <button type="submit" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600" style="background-color: gold;">
                Update
            </button>
            <button type="reset" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-black border border-transparent rounded-md shadow-sm" style="background-color: white;">
                Reset
            </button>
        </div>
    </form>

</x-filament-panels::page>