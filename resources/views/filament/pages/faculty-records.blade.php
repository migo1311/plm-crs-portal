<x-filament-panels::page>
<div class="bg-white p-6 rounded-md shadow-sm">
    <forms wire:submit="create">
    <h1 class="text-2xl pb-4 font-semibold text-gray-900">Personal Details</h1>
    
    {{ $this->form }}

    </forms>

</div>

<div class=" p-3 rounded-md shadow-sm">
<button type="submit" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600" style="background-color: gold;">
Update</button>
<button type="submit" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-black border border-transparent rounded-md shadow-sm" style="background-color: white;">
Reset</button>

</div>
    

</x-filament-panels::page>
