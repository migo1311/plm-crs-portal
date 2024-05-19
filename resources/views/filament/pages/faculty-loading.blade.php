<x-filament-panels::page>
<div class="text-center">
    <h2 class="text-xl font-semibold mb-4">Faculty Loading</h2>
    <h3 class="text-xl font-semibold mb-4" style="color: #434343;">College of Information Systems and Technology Management</h3>
</div>

    
<div class="flex justify-center items-center h-full">
    <form wire:submit.prevent="printReport" class="w-full max-w-md p-3 rounded-md shadow-sm">
        {{ $this->form }}
        <div class="p-3">
        <button type="submit" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" style="background-color: gold;">
        Submit
        </button>
    </div>
    </form>
</div>

  

    @if ($showTable)
        <div class="p-6 rounded-md shadow-sm">
            {{ $this->table }}
        </div>
    @endif
</x-filament-panels::page>