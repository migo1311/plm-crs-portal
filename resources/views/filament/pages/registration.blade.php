<x-filament::page>
    <div class="flex justify-center items-center h-full">
        {{ $this->form }}
    </div>

    

    <div>
    @if ($SelectedStudentId)
                <table class="max-w-screen-sm border">
                    <tbody>
                        <tr>
                            <th colspan="2">
                                <h2 class="text-xl font-semibold mb-4 text-center">STUDENT PROFILE</h2>
                            </th>
                        </tr>
                        <tr>
                            <th class="px-4 text-left text-sm">Student Number:</th>
                            <td class="px-4">{{ $selectedStudent->student_id ?? '' }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 text-left text-sm">Last Name:</th>
                            <td class="px-4 text-left text-sm">{{ $selectedStudent->lastname ?? '' }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 text-left text-sm">First Name:</th>
                            <td class="px-4 text-left text-sm">{{ $selectedStudent->firstname ?? '' }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 text-left text-sm">Middle Name:</th>
                            <td class="px-4 text-left text-sm">{{ $selectedStudent->middlename ?? '' }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 text-left text-sm">Program:</th>
                            <td class="px-4 text-left text-sm">{{ $selectedStudent->program_id ?? '' }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 text-left text-sm">Registration Code:</th>
                            <td class="px-4 text-left text-sm">{{ $selectedStudent->registration_status ?? '' }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 text-left text-sm">Block Assignment:</th>
                            <td class="px-4 text-left text-sm">{{ $selectedStudent->block_id ?? '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif

        <div>
        @if ($SelectedStudentId)
        <table class="max-w-screen-sm border">
                    <tbody>
                        <tr>
                            <th colspan="2">
                                <h2 class="text-xl font-semibold mb-4 text-center">BLOCK STATS</h2>
                            </th>
                        </tr>
                        <tr>
                            <span> 
                                <th class="px-4 text-left text-sm">Block:</th>
                                <td class="px-4">{{ $blockStats->block_name ?? '' }}</td>
                                <th class="px-4 text-left text-sm">Slots:</th>
                                <td class="px-4">{{ $blockStats->slots ?? '' }}</td>
                                <th class="px-4 text-left text-sm">Enlisted:</th>
                                <td class="px-4"></td>
                            </span>
                        </tr>
                        <tr>
                            <span>
                                <th class="px-4 text-left text-sm">Class (Section)</th>
                                <th class="px-4 text-left text-sm">Slots</th>
                                <th class="px-4 text-left text-sm">Taken</th>
                            </span>
                        </tr>
                        <tr></tr>
                            <span>
                                <td class="px-4 text-left text-sm">{{ $blockStats->section ?? '' }}</td>
                                <td class="px-4 text-left text-sm"></td>
                                <td class="px-4 text-left text-sm"></td>
                            </span>
                        </tr>
                    </tbody>
                </table>
        </div>
        @endif

    

    @if ($showTable)
    <div class="flex justify-center items-center h-full">
        {{ $this->table }}
    </div>
    @endif
</x-filament::page>