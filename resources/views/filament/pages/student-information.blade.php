<x-filament-panels::page>
    <div class="p-6 rounded-md shadow-sm">
        <form wire:submit.prevent="printReport">
            {{ $this->form }}
            <div class="p-3 rounded-md shadow-sm">
                <div class="flex justify-center items-center mb-4"> <!-- Centering the button -->
                    <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" style="background-color: gold;">
                        Generate Data
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if (!empty($studentsData))
        <div class="bg-white p-6 mt-6 rounded-md shadow-sm">
            <h2 class="text-xl font-semibold mb-4">Student Records</h2>
            <div style="overflow-x: auto;">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            @foreach($selectedFields as $field)
                                <th class="px-4 py-2 border">{{ ucwords(str_replace('_', ' ', $field)) }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($studentsData as $student)
                            <tr>
                                @foreach($selectedFields as $field)
                                    <td class="px-4 py-2 border">{{ $student[$field] }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</x-filament-panels::page>