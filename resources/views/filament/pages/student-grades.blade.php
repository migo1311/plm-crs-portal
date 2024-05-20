<x-filament-panels::page>
    <div class="p-6 rounded-md shadow-sm">
        <form wire:submit.prevent="printReport">
            {{ $this->form }}
            <div class="p-3 rounded-md shadow-sm">
                <button type="submit" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" style="background-color: gold;">
                    Print
                </button>
            </div>
        </form>
    </div>

    <div class="mt-4 text-center font-bold text-2xl">
        <p>College of Information Systems and Technology Management</p>
        <p>Bachelor of Science in Computer Science</p>
    </div>

    @if ($showTable)
        <div class="p-6 rounded-md shadow-sm">
            {{ $this->table }}
        </div>
    @endif
</x-filament-panels::page>
