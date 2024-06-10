<x-filament::page>
    <div>
         <div style="margin-top: -1rem; margin-bottom: 1rem; display: flex; gap: 0.5rem;">
          <button wire:click="setYearLevel(1)" style="background-color: #F59E0B; color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; cursor: pointer; outline: none; border: none; transition: background-color 0.2s ease-in-out; font-weight: bold; {{ $selectedYearLevel === 1 ? 'background-color: #D97706;' : '' }}" onmouseover="this.style.backgroundColor='#D97706'" onmouseout="this.style.backgroundColor='{{ $selectedYearLevel === 1 ? '#D97706' : '#F59E0B' }}'">First Year</button>
          <button wire:click="setYearLevel(2)" style="background-color: #F59E0B; color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; cursor: pointer; outline: none; border: none; transition: background-color 0.2s ease-in-out; font-weight: bold; {{ $selectedYearLevel === 2 ? 'background-color: #D97706;' : '' }}" onmouseover="this.style.backgroundColor='#D97706'" onmouseout="this.style.backgroundColor='{{ $selectedYearLevel === 2 ? '#D97706' : '#F59E0B' }}'">Second Year</button>
          <button wire:click="setYearLevel(3)" style="background-color: #F59E0B; color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; cursor: pointer; outline: none; border: none; transition: background-color 0.2s ease-in-out; font-weight: bold; {{ $selectedYearLevel === 3 ? 'background-color: #D97706;' : '' }}" onmouseover="this.style.backgroundColor='#D97706'" onmouseout="this.style.backgroundColor='{{ $selectedYearLevel === 3 ? '#D97706' : '#F59E0B' }}'">Third Year</button>
          <button wire:click="setYearLevel(4)" style="background-color: #F59E0B; color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; cursor: pointer; outline: none; border: none; transition: background-color 0.2s ease-in-out; font-weight: bold; {{ $selectedYearLevel === 4 ? 'background-color: #D97706;' : '' }}" onmouseover="this.style.backgroundColor='#D97706'" onmouseout="this.style.backgroundColor='{{ $selectedYearLevel === 4 ? '#D97706' : '#F59E0B' }}'">Fourth Year</button>
      </div>

        {{ $this->table }}

        <!-- Student Details Section -->
        <div x-data="{ showDetails: @entangle('showDetails') }">
            <template x-if="showDetails">
                <div class="details-container bg-white dark:bg-gray-800 text-black dark:text-white p-4 mt-4 rounded shadow-lg">
                    <h5 class="font-bold mb-2">Student Details</h5>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="student_id">Student ID</label>
                            <input type="text" id="student_id" x-model="view_student_no" disabled class="mt-1 block w-full">
                        </div>
                        <div>
                            <label for="full_name">Student Name</label>
                            <input type="text" id="full_name" x-model="view_full_name" class="mt-1 block w-full">
                        </div>
                        <div>
                            <label for="student_type">Student Type</label>
                            <input type="text" id="student_type" x-model="view_student_type" class="mt-1 block w-full">
                        </div>
                        <div>
                            <label for="block_id">Block</label>
                            <select id="block_id" x-model="view_student_block" class="mt-1 block w-full">
                               @php
                                  $currentAYSem = App\Models\Aysem::latest('date_start')->first();
                                  $studentProgram = App\Models\Program::where('program_code', $view_program_code)->first();
                                  $blocks = $currentAYSem && $studentProgram 
                                      ? App\Models\Block::where('program_id', $studentProgram->id)
                                          ->where('year_level', $view_year_level)
                                          ->where('aysem_id', $currentAYSem->id)
                                          ->pluck('section', 'id') 
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
                    <button @click="$wire.call('updateStudentDetails')" class="mt-4 btn btn-primary">Update</button>
                    <button @click="showDetails = false" class="mt-4 btn btn-secondary">Close</button>
                </div>
            </template>
        </div>
    </div>
</x-filament::page>
