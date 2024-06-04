<x-filament-panels::page>
    @if (!$showStudentGradesTable)
        <form wire:submit="submit">
            {{ $this->form }}

            <div class="p-3 rounded-md shadow-sm">
                <button type="submit" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" style="background-color: gold;">
                    Submit
                </button>
            </div>
            <div wire:loading class="mt-2 text-sm text-gray-600">
                    Loading...
                </div>
        </form>
    @endif

    @if ($showTable)
        <div class="p-6">
            {{ $this->table }}
        </div>
    @endif

    @if ($showStudentGradesTable)
        <div class="p-6 rounded-md shadow-sm">
            <form wire:submit.prevent="saveGrades">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Number</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grades</th>
                            </tr>
                        </thead>
                        <tbody class="bg-tansparent divide-y divide-blue-200">
                            @foreach($this->getStudentGradeSchema() as $classStudentId => $input)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $input->student_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $input->student_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="text" wire:model="grades.{{ $classStudentId }}" class="border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-3">
                    <button type="submit" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" style="background-color: blue;">
                        Save Grades
                    </button>
                </div>
            </form>
        </div> 
    @endif
</x-filament-panels::page>
