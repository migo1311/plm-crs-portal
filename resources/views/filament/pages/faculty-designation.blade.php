<x-filament-panels::page>
    <div class="border-4 border-yellow-500 bg-transparent p-6 rounded-md shadow-sm">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="save">
            
            {{ $this->form }}

            <div class="mt-12">
                <button type="submit" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600" style="background-color: gold;">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-filament-panels::page>