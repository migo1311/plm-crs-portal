<x-filament::page>
    <div>
        {{ $this->table }}

        <!-- Student Details Section -->
        <div x-data="{ showDetails: @entangle('showDetails') }">
            <template x-if="showDetails">
                <div class="details-container bg-white dark:bg-gray-800 text-black dark:text-white p-4 mt-4 rounded shadow-lg">
                    <h5 class="font-bold mb-2">Student Details</h5>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="student_id">Student ID</label>
                            <input type="text" id="student_id" x-model="view_student_id" disabled class="mt-1 block w-full">
                        </div>
                        <div>
                            <label for="lastname">Student Name</label>
                            <input type="text" id="lastname" x-model="view_lastname" class="mt-1 block w-full">
                        </div>
                        <div>
                            <label for="student_type">Student Type</label>
                            <input type="text" id="student_type" x-model="view_student_type" class="mt-1 block w-full">
                        </div>
                        <div>
                            <label for="block_id">Block</label>
                            <select id="block_id" x-model="view_student_block" class="mt-1 block w-full">
                                @php
                                    $program = App\Models\Program::where('program_code', $view_program_code)->first();
                                    $currentAYSem = App\Models\Aysem::latest('date_start')->first();
                                    $blocks = $program 
                                        ? App\Models\Block::where('program_id', $program->program_id)
                                            ->where('year_level', $view_year_level)
                                            ->where('aysem_id', $currentAYSem->aysem_id)
                                            ->pluck('section', 'block_id') 
                                        : [];
                                @endphp
                                @foreach ($blocks as $block_id => $section)
                                    <option value="{{ $block_id }}">{{ $section }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="year_level">Year Level</label>
                            <input type="text" id="year_level" x-model="view_year_level" disabled class="mt-1 block w-full">
                        </div>
                    </div>
                    <button @click="updateStudentDetails" class="mt-4 btn btn-primary">Update</button>
                    <button @click="showDetails = false" class="mt-4 btn btn-secondary">Close</button>
                </div>
            </template>
        </div>
    </div>
</x-filament::page>
