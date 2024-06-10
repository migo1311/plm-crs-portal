<x-filament-panels::page>
    <div class="p-6 rounded-md shadow-sm">
        <button class="btn btn-primary" wire:click="printTable">Print Table</button>

        @if ($showTable)
            <div class="p-6 rounded-md shadow-sm">
                {{ $this->table }}
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('printTable', () => {
                window.print();
            });
        });
    </script>
</x-filament-panels::page>
