<x-filament::page>

<div class="flex justify-center items-center h-full">
    {{ $this->form }}
</div>
    {{-- Display the selected student profile --}}
    @if ($selectedStudent)
        <div class="mb-4 p-4 bg-white shadow rounded">
            <h2 class="text-xl font-bold mb-2">Student Profile</h2>
            <p><strong>Student Number:</strong> {{ $selectedStudent->student_id }}</p>
            <p><strong>Last Name:</strong> {{ $selectedStudent->last_name }}</p>
            <p><strong>First Name:</strong> {{ $selectedStudent->first_name }}</p>
            <p><strong>Middle Name:</strong> {{ $selectedStudent->middle_name }}</p>
            <p><strong>Program:</strong> {{ $selectedStudent->program }}</p>
            <p><strong>Registration Code:</strong> {{ $selectedStudent->registration_code }}</p>
            <p><strong>Block Assignment:</strong> {{ $selectedStudent->block_assignment }}</p>
        </div>
    @endif

    {{-- Button to trigger the print report method --}}
    <div class="flex justify-center items-center h-full">
        <button type="button" wire:click="printReport" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" style="background-color: gold;">
            Submit
        </button>
    </div>

    {{-- Display the table if showTable is true --}}
    @if ($showTable)
    <div class="flex justify-center items-center h-full">
            {{ $this->table }}
        </div>
    @endif
</x-filament::page>
