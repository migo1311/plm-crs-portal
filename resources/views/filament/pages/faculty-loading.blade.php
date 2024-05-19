<x-filament-panels::page>

    <h1 class="text-xl font-bold text-gray-900 text-center">Faculty Loading</h1>
    <h3 class="text-xl font-semibold text-gray-500 text-center">College of Information Systems and Technology Management</h3>

    <div class="p-6 rounded-md shadow-sm">
        <form wire:submit.prevent="printReport">
            {{ $this->form }}
            <div class="p-3 rounded-md shadow-sm">
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