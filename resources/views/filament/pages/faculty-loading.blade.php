<x-filament-panels::page>
    <h1 class="text-xl font-bold text-gray-900 text-center">Faculty Loading</h1>
    <h3 class="text-xl font-semibold text-gray-500 text-center">College of Information Systems and Technology Management</h3>

    <div class="p-1 rounded-md shadow-sm">
        <form wire:submit.prevent>
            {{ $this->form }}
            <button type="submit" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" style="background-color: gold;">
                Submit
            </button>
        </form>
    </div>

    <div class="bg-white p-6 rounded-md shadow-sm mt-4">
        {{ $this->table }}
    </div>
</x-filament-panels::page>
