<x-filament-panels::page>
<div id="left-card" class="card" style="height: 500%; width: 300px; overflow-y: auto;">
        <div class="year-container" id="first-year-container">
            <p style="font-size: 28px; font-family: Inter; font-weight: bold; display: inline-block; vertical-align: middle;">
                First Year
            </p>
            <img src="{{ asset('backend/dist/img/add.png') }}" 
                style="margin-left: 10px; height: 20px; width: 20px; cursor: pointer; display: inline-block; vertical-align: middle;" 
                wire:click="addAccordion(1)">

                @foreach($blocks as $yearLevel => $sections)
                    @if($yearLevel == 1)
                        @foreach($sections as $section => $count)
                            <div class="button" onclick="displayBlockInfo('{{ $yearLevel }}', '{{ $section }}')">
                                Block {{ $section }}
                            </div>
                        @endforeach
                    @endif
                @endforeach
        </div>

        <div class="year-container" id="second-year-container">
            <p style="font-size: 28px; font-family: Inter; font-weight: bold; display: inline-block; vertical-align: middle;">
                Second Year
            </p>
            <img src="{{ asset('backend/dist/img/add.png') }}" 
                style="margin-left: 10px; height: 20px; width: 20px; cursor: pointer; display: inline-block; vertical-align: middle;" 
                wire:click="addAccordion(2)">
                @foreach($blocks as $yearLevel => $sections)
                    @if($yearLevel == 2)
                        @foreach($sections as $section => $count)
                            <div class="accordion-button" onclick="displayBlockInfo('{{ $yearLevel }}', '{{ $section }}')">
                                Block {{ $section }}
                            </div>
                        @endforeach
                    @endif
                @endforeach
        </div>

        <div class="year-container" id="third-year-container">
            <p style="font-size: 28px; font-family: Inter; font-weight: bold; display: inline-block; vertical-align: middle;">
                Third Year
            </p>
            <img src="{{ asset('backend/dist/img/add.png') }}" 
                style="margin-left: 10px; height: 20px; width: 20px; cursor: pointer; display: inline-block; vertical-align: middle;" 
                wire:click="addAccordion(3)">
                @foreach($blocks as $yearLevel => $sections)
                    @if($yearLevel == 3)
                        @foreach($sections as $section => $count)
                            <div class="accordion-button" onclick="displayBlockInfo('{{ $yearLevel }}', '{{ $section }}')">
                                Block {{ $section }}
                            </div>
                        @endforeach
                    @endif
                @endforeach
        </div>

        <div class="year-container" id="fourth-year-container">
        <p style="font-size: 28px; font-family: Inter; font-weight: bold; display: inline-block; vertical-align: middle;">
                Fourth Year
            </p>
            <img src="{{ asset('backend/dist/img/add.png') }}" 
                style="margin-left: 10px; height: 20px; width: 20px; cursor: pointer; display: inline-block; vertical-align: middle;" 
                wire:click="addAccordion(4)">
                @foreach($blocks as $yearLevel => $sections)
                    @if($yearLevel == 4)
                        @foreach($sections as $section => $count)
                            <div class="accordion-button" onclick="displayBlockInfo('{{ $yearLevel }}', '{{ $section }}')">
                                Block {{ $section }}
                            </div>
                        @endforeach
                    @endif
                @endforeach
        </div>
    </div>
    
    <div style="position:absolute; top:130%; left:25%">
        <p id="displayBlockInfo" style="font-size: 40px; font-weight:bold"></p>
    </div>

    <div id="addBlockModal" class="modal @if($showModal) show @endif" style="display: @if($showModal) block @else none @endif;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Blocks</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="$set('showModal', false)">&times;</button>
                </div>
                <div class="modal-body">
                    <label for="blockCount">Number of Blocks:</label>
                    <input type="number" id="blockCount" wire:model="blockCount" min="0" value="0">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click="createBlocks">Add Blocks</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="$set('showModal', false)">Close</button>

                    @if (session()->has('message'))
                        <div>{{ session('message') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="blockTable" style="position:absolute; top:175%; left:25%; display:none">
        <table class="table-auto w-full" style="width: 125%;">
            <thead>
                <tr>
                    <th class="px-4 py-2">Class</th>
                    <th class="px-4 py-2">Class Name</th>
                    <th class="px-4 py-2">Section</th>
                    <th class="px-4 py-2">Units
                        <button class="btn btn-sm btn-link" wire:click="sortUnits('units', 'asc')" wire:loading.attr="disabled">
                            <i class="fa fa-arrow-up"></i>
                        </button>
                        <button class="btn btn-sm btn-link" wire:click="sortUnits('units', 'desc')" wire:loading.attr="disabled">
                            <i class="fa fa-arrow-down"></i>
                        </button>
                    </th>
                    <th class="px-4 py-2">Schedule</th>
                    <th class="px-4 py-2">Slots</th>
                </tr>
            </thead>
            <tbody>
                @php $scheduleCount = 0; @endphp
                @foreach ($schedules as $schedule)
                        @php $scheduleCount++; @endphp
                        <tr>

                            <td class="border px-4 py-2">{{ $schedule->day }}</td>

                            <td class="border px-4 py-2">
                                @php
                                    $daysArray = explode(',', $schedule->days);
                                    $abbreviations = [
                                        'Monday' => 'M',
                                        'Tuesday' => 'T',
                                        'Wednesday' => 'W',
                                        'Thursday' => 'Th',
                                        'Friday' => 'F',
                                        'Saturday' => 'S',
                                    ];
                                    $abbreviatedDays = array_map(function($day) use ($abbreviations) {
                                        return $abbreviations[trim($day)] ?? $day;
                                    }, $daysArray);
                                @endphp
                                {{ implode(' ', $abbreviatedDays) }}
                                {{ $schedule->start_time }}
                                {{ $schedule->end_time }}
                                {{ $schedule->mode }}
                                {{ $schedule->room }}
                            </td>
                            
                        </tr>
                @endforeach
                @unless($scheduleCount)
                    <tr>
                        <td class="border px-4 py-2" colspan="6">No schedules found for section 2</td>
                    </tr>
                @endunless
            </tbody>
        </table>
        <p style="font-size: 25px; font-weight:bold">Total # of Records: {{ $scheduleCount }}</p>
    </div>

    <div id="blockTable3_2" style="position:absolute; top:175%; left:25%; display:none">
        <table class="table-auto w-full" style="width: 125%;">
            <thead>
                <tr>
                    <th class="px-4 py-2">Class</th>
                    <th class="px-4 py-2">Class Name</th>
                    <th class="px-4 py-2">Section</th>
                    <th class="px-4 py-2">Units
                        <button class="btn btn-sm btn-link" wire:click="sortUnits('units', 'asc')" wire:loading.attr="disabled">
                            <i class="fa fa-arrow-up"></i>
                        </button>
                        <button class="btn btn-sm btn-link" wire:click="sortUnits('units', 'desc')" wire:loading.attr="disabled">
                            <i class="fa fa-arrow-down"></i>
                        </button>
                    </th>
                    <th class="px-4 py-2">Schedule</th>
                    <th class="px-4 py-2">Slots</th>
                </tr>
            </thead>
            <tbody>
                @php $scheduleCount = 0; @endphp
                @foreach ($schedules as $schedule)
                    @if ($schedule->day === 2)
                        @php $scheduleCount++; @endphp
                        <tr>

                            <td class="border px-4 py-2">{{ $schedule->day }}</td>

                            <td class="border px-4 py-2">
                                @php
                                    $daysArray = explode(',', $schedule->days);
                                    $abbreviations = [
                                        'Monday' => 'M',
                                        'Tuesday' => 'T',
                                        'Wednesday' => 'W',
                                        'Thursday' => 'Th',
                                        'Friday' => 'F',
                                        'Saturday' => 'S',
                                    ];
                                    $abbreviatedDays = array_map(function($day) use ($abbreviations) {
                                        return $abbreviations[trim($day)] ?? $day;
                                    }, $daysArray);
                                @endphp
                                {{ implode(' ', $abbreviatedDays) }}
                                {{ $schedule->start_time }}
                                {{ $schedule->end_time }}
                                {{ $schedule->mode }}
                                {{ $schedule->room }}
                            </td>
                            
                        </tr>
                    @endif
                @endforeach
                @unless($scheduleCount)
                    <tr>
                        <td class="border px-4 py-2" colspan="6">No schedules found for section 2</td>
                    </tr>
                @endunless
            </tbody>
        </table>
        <p style="font-size: 25px; font-weight:bold">Total # of Records: {{ $scheduleCount }}</p>
    </div>

    <div id="blockTable2_1" style="position:absolute; top:175%; left:25%; display:none">
        <table class="table-auto w-full" style="width: 125%;">
            <thead>
                <tr>
                    <th class="px-4 py-2">Class</th>
                    <th class="px-4 py-2">Class Name</th>
                    <th class="px-4 py-2">Section</th>
                    <th class="px-4 py-2">Units
                        <button class="btn btn-sm btn-link" wire:click="sortUnits('units', 'asc')" wire:loading.attr="disabled">
                            <i class="fa fa-arrow-up"></i>
                        </button>
                        <button class="btn btn-sm btn-link" wire:click="sortUnits('units', 'desc')" wire:loading.attr="disabled">
                            <i class="fa fa-arrow-down"></i>
                        </button>
                    </th>
                    <th class="px-4 py-2">Schedule</th>
                    <th class="px-4 py-2">Slots</th>
                </tr>
            </thead>
            <tbody>
                @php $scheduleCount = 0; @endphp
                @foreach ($schedules as $schedule)
                        @php $scheduleCount++; @endphp
                        <tr>

                            <td class="border px-4 py-2">{{ $schedule->day }}</td>

                            <td class="border px-4 py-2">
                                @php
                                    $daysArray = explode(',', $schedule->days);
                                    $abbreviations = [
                                        'Monday' => 'M',
                                        'Tuesday' => 'T',
                                        'Wednesday' => 'W',
                                        'Thursday' => 'Th',
                                        'Friday' => 'F',
                                        'Saturday' => 'S',
                                    ];
                                    $abbreviatedDays = array_map(function($day) use ($abbreviations) {
                                        return $abbreviations[trim($day)] ?? $day;
                                    }, $daysArray);
                                @endphp
                                {{ implode(' ', $abbreviatedDays) }}
                                {{ $schedule->start_time }}
                                {{ $schedule->end_time }}
                                {{ $schedule->mode }}
                                {{ $schedule->room }}
                            </td>
                            
                        </tr>
                @endforeach
                @unless($scheduleCount)
                    <tr>
                        <td class="border px-4 py-2" colspan="6">No schedules found for section 2</td>
                    </tr>
                @endunless
            </tbody>
        </table>
        <p style="font-size: 25px; font-weight:bold">Total # of Records: {{ $scheduleCount }}</p>
    </div>
    
    <!-- Modal for Maximum Blocks -->
    <div id="maxBlockLimitModal" class="modal" style="display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5);">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error</h5>
                    <button type="button" class="close" onclick="closeModal()" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>The maximum limit of four blocks for the <span id="modalYear"></span> has been reached.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Close</button>
                </div>
            </div>
        </div>
</x-filament-panels::page>
