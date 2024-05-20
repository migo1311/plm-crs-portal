<x-filament-panels::page>


        {{-- Success message --}}
        @if (session()->has('success'))
            <div class="alert alert-success flex justify-center items-center h-full">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-center items-center h-full">
        <form wire:submit.prevent="save">
            {{ $this->form }}
            </div>

            <div class="flex justify-center items-center h-full">
                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600" style="background-color: gold;">
                    Update
                </button>
            </div>
        </form>
    

</x-filament-panels::page>
