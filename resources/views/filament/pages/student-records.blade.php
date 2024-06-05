<x-filament-panels::page>
    <form wire:submit.prevent="create">
        {{ $this->form }}
        <div class="p-3 rounded-md shadow-sm">
            <button type="submit" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600" style="background-color: gold;">
                Update
            </button>
            <button type="button" wire:click="resetForm" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-black border border-transparent rounded-md shadow-sm" style="background-color: white;">
                Reset
            </button>
        </div>
    </form>

    @if ($data)
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">Student Records</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Number</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Birth Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mobile Number</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Personal Email</th>
                        <!-- Add other table headers as needed -->
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($data as $student)
                        @if (is_array($student))
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $student['student_no'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $student['first_name'] }} {{ $student['last_name'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $student['birthdate'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $student['mobile_no'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $student['personal_email'] }}</td>
                                
                                <!-- Add other table cells as needed -->
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-filament-panels::page>