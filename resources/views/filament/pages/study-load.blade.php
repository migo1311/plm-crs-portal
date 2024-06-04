<x-filament-panels::page>

<div class="flex justify-center items-center h-full">
    
<forms wire:submit="create">
    <h1 class="text-2xl pb-4 font-semibold text-blue-500">Faculty Load</h1>
    
    {{ $this->form }}

</forms>
</div>

<div class="flex justify-center items-center h-full">
    <button type="submit" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" style="background-color: gold;">Submit</button>
</div>
    

</x-filament-panels::page>
