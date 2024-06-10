<x-filament-panels::page>

    <div class="text-center">
        <h2 class="text-xl font-semibold mb-4">Faculty Loading</h2>
        <h3 class="text-xl font-semibold mb-4" style="color: #434343;">College of Information Systems and Technology Management</h3>
    </div>

    {{-- Display the table if showTable is true --}}
    @if ($showTable)
        <div class="mt-8">
            {{ $this->table }}
        </div>
    @endif

</x-filament-panels::page>