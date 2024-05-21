<x-filament-panels::page>
    <form wire:submit="search">
        {{ $this->first }}
        <div class="flex justify-center">
            <div class="p-3 rounded-md shadow-sm">
                <button type="submit" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-blue-600" style="background-color: blue;">
                    Search
                </button>
            </div>

            <div class="p-3 rounded-md shadow-sm">
                <button wire:click="addStudent" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-green-600" style="background-color: green;">
                    Add Student
                </button>
            </div>
    </div>
    </form>

    @if($showForms)
        <form wire:submit="create" class="mt-5">
            {{ $this->personal }}
            <div class=" h-5"></div>    
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
    @endif
</x-filament-panels::page>
