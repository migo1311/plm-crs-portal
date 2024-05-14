<x-filament-panels::page>

<h1 class="text-xl font-bold text-gray-900 text-center">Faculty Loading</h1>
<h3 class="text-xl font-semibold text-gray-500 text-center">College of Information Systems and Technology Management</h3>

<div class=" p-1 rounded-md shadow-sm">
    <forms wire:submit="create">
    
    {{ $this->form }}

    <button type="submit" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" style="background-color: gold;">Submit</button>
    </forms>
    
</div>

<div class="bg-white p-6 rounded-md shadow-sm">
    <forms wire:submit="create">
    <h1 class="text-2xl pb-4 font-semibold text-blue-500">SEM: 20232</h1>
    
    {{ $this->table }}

    </forms>

</div>


<div class=" p-3 rounded-md shadow-sm">


</div>
    

</x-filament-panels::page>
