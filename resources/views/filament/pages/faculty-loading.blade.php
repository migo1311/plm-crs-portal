<x-filament-panels::page>

    <div class="text-center">
        <h2 class="text-xl font-semibold mb-4">Faculty Loading</h2>
        <h3 class="text-xl font-semibold mb-4" style="color: #434343;">College of Information Systems and Technology Management</h3>
    </div>

    {{-- Flex container for form and button --}}
    <div class="flex justify-center items-center h-full">
        {{-- Form --}}
        <div>
            {{ $this->form }}
        </div>
        {{-- Button --}}
        <div>
            <button type="button" wire:click="printReport" class="px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600 focus:ring-yellow-500" style="background-color: gold; margin-top: 30px">
                Submit
            </button>
        </div>
    </div>

    {{-- Display the table if showTable is true --}}
    @if ($showTable)
        <div class="mt-8">
            {{ $this->table }}
        </div>
    @endif

</x-filament-panels::page>
