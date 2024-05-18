<x-filament-panels::page>
    <div class="bg-white p-6 rounded-md shadow-sm">
        <form wire:submit.prevent="update">
            <!-- Your form components -->
            {{ $this->form }}
            
            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600" style="background-color: gold;">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-filament-panels::page>
