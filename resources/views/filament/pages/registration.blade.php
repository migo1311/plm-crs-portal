<x-filament::page>

<div class="flex justify-center items-center h-full">
    {{ $this->form }}
</div>

        <div class="p-6 mt-6">
            <div>
            <div>
            <table class="max-w-screen-sm border">
                <tbody>
                    <th>
                        <h2 class="text-xl font-semibold mb-4">Student Profile</h2>
                    </th>
                    <tr>
                        <th class="px-4 text-left text-sm">Student Number:</th>
                        <td class="px-4"></td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Last Name:</th>
                        <td class="px-4 text-left text-sm"></td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">First Name:</th>
                        <td class="px-4 text-left text-sm"></td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Middle Name:</th>
                        <td class="px-4 text-left text-sm"></td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Program:</th>
                        <td class="px-4 text-left text-sm"></td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Registration Code:</th>
                        <td class="px-4 text-left text-sm"></td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Block Assignment:</th>
                        <td class="px-4 text-left text-sm"></td>
                    </tr>
                </tbody>
            </table>
            </div>

            </div>
        </div>

    {{-- Button to trigger the print report method --}}
    <div class="flex justify-center items-center h-full">
        <button type="button" wire:click="printReport" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" style="background-color: gold;">
            Submit
        </button>
    </div>

    {{-- Display the table if showTable is true --}}
    @if ($this->showTable)
    <div class="flex justify-center items-center h-full">
            {{ $this->table }}
        </div>
    @endif
</x-filament::page>
