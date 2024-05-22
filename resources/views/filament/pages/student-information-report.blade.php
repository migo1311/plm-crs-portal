<x-filament-panels::page>
    <div class="p-6 rounded-md shadow-sm">
        <form wire:submit.prevent="printReport">
            {{ $this->form }}
            <div class="p-3 rounded-md shadow-sm">
                <button type="submit" class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" style="background-color: gold;">
                    Print
                </button>
            </div>
        </form>
    </div>

    <div class="mt-4 text-center font-bold text-2xl">
        <p>Student Information</p>
    </div>

    @if ($SelectedStudentId)
    <div class="p-6 mt-6 flex">
        <div class="mr-6">
            <table class="max-w-screen-sm border">
                <tbody>
                    <tr>
                        <th class="px-4 text-left text-sm">Student Number:</th>
                        <td class="px-4">{{ $selectedStudent->student_id ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Student Name:</th>
                        <td class="px-4 text-left text-sm">{{ $selectedStudent->lastname ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Address:</th>
                        <td class="px-4 text-left text-sm">{{ $selectedStudent->firstname ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Telephone No:</th>
                        <td class="px-4 text-left text-sm">{{ $selectedStudent->telephone_num ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Cellphone No:</th>
                        <td class="px-4 text-left text-sm">{{ $selectedStudent->mobile_num ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Date of Birth:</th>
                        <td class="px-4 text-left text-sm">{{ $selectedStudent->birth_date ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Birth Place:</th>
                        <td class="px-4 text-left text-sm">{{ $selectedStudent->birth_place ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Sex:</th>
                        <td class="px-4 text-left text-sm">{{ $selectedStudent->gender ?? '' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mr-6">
            <table class="max-w-screen-sm border">
                <tbody>
                    <tr>
                        <th class="px-4 text-left text-sm">Course:</th>
                        <td class="px-4 text-left text-sm">{{ $selectedStudent->block_id ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">College:</th>
                        <td class="px-4 text-left text-sm">{{ $college->college_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Year Level:</th>
                        <td class="px-4 text-left text-sm">{{ $blockStats->year_level ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Scholastic Level:</th>
                        <td class="px-4 text-left text-sm">{{ $selectedStudent->block_id ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Student Type:</th>
                        <td class="px-4 text-left text-sm">{{ $selectedStudent->block_id ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Scholarship Status:</th>
                        <td class="px-4 text-left text-sm">{{ $selectedStudent->block_id ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Enrollment Status:</th>
                        <td class="px-4 text-left text-sm">{{ $selectedStudent->block_id ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Academic Status:</th>
                        <td class="px-4 text-left text-sm">{{ $selectedStudent->block_id ?? '' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <table class="max-w-screen-sm border">
                <tbody>
                    <tr>
                        <th class="px-4 text-left text-sm">Mother's Name:</th>
                        <td class="px-4 text-left text-sm">{{ $selectedStudentFamily->guardian_last_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Occupation:</th>
                        <td class="px-4 text-left text-sm">{{ $selectedStudentFamily->occupation ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Employer:</th>
                        <td class="px-4 text-left text-sm">{{ $selectedStudentFamily->employer ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Father's Name:</th>
                        <td class="px-4 text-left text-sm">{{ $selectedStudentFamily->guardian_last_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Occupation:</th>
                        <td class="px-4 text-left text-sm">{{ $selectedStudentFamily->occupation ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 text-left text-sm">Employer:</th>
                        <td class="px-4 text-left text-sm">{{ $selectedStudentFamily->employer ?? '' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif



    @if ($showTable)
        <div class="p-6 rounded-md shadow-sm">
            {{ $this->table }}
        </div>
    @endif
</x-filament-panels::page>
