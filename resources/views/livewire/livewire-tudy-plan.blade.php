


<div>        
    <div class="container mt-5"  >
        <div class="row">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header">
                    <h5 style="float: left;">Total <strong>#</strong> of Records: {{ $totalStudents }}</h5>

                        <button type="button" class="btn btn-primary"style="float: right;" data-toggle="modal" data-target="#bulkEditStudentModal" wire:click="selectStudentsForBatchUpdate">Batch Update</button>
                    </div>
                    <div class="card-body" style="background-color: #F6F6F6;">
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center">{{ session('message') }}</div>
                        @endif
                        <div class="table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                               <th></th>
                                <th style="text-align: center;">Student ID</th>
                                <th>Student Name
                                <button class="btn btn-sm btn-link" wire:click="sortStudents('lastname', 'asc')" wire:loading.attr="disabled">
                                        <i class="fa fa-arrow-up"></i>
                                    </button>
                                    <button class="btn btn-sm btn-link" wire:click="sortStudents('lastname', 'desc')" wire:loading.attr="disabled">
                                        <i class="fa fa-arrow-down"></i>
                                    </button>
                                </th>
                                <th>Year Level
                                <button class="btn btn-sm btn-link" wire:click="sortStudents('year_level')" wire:loading.attr="disabled">
                                    <i class="fa fa-arrow-up"></i>
                                </button>
                                <button class="btn btn-sm btn-link" wire:click="sortStudents('year_level', 'desc')" wire:loading.attr="disabled">
                                    <i class="fa fa-arrow-down"></i>
                                </button>
                                </th>
                                <th style="text-align: center;">Date Request</th>
                                <th style="text-align: center;">Status</th>
                                
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($students->count() > 0)
                                @foreach ($students as $student)
                                    <tr>
                                        <td><input type="checkbox" wire:model="selectedStudents" value="{{ $student->id }}"></td>
                                        
                                            <td>{{ $student->student_id }}</td>
                                            <td>{{ $student->lastname }}</td>
                                            <td>{{ $student->year_level }}</td>
                                            <td>{{ $student->date_of_request }}</td>
                                            <td>{{ $student->status }}</td>
                                          
                                            <td style="text-align: center;">
                                            <button class="btn btn-sm btn-primary" wire:click="editStudents({{ $student->student_id }})">View Student</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" style="text-align: center;"><small>No Student Found</small></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
</div>
            <!-- Pagination Controls -->
    
            <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
        <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
            <a class="page-link" href="#" wire:click.prevent="previousPage" tabindex="-1">Previous</a>
        </li>
        @for ($page = 1; $page <= $lastPage; $page++)
            <li class="page-item {{ $currentPage == $page ? 'active' : '' }}">
                <a class="page-link" href="#" wire:click.prevent="getPaginatedStudents({{ $page }})">{{ $page }}</a>
            </li>
        @endfor
        <li class="page-item {{ $currentPage == $lastPage ? 'disabled' : '' }}">
            <a class="page-link" href="#" wire:click.prevent="nextPage">Next</a>
        </li>
    </ul>
</nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <div wire:ignore.self class="modal fade" id="editStudentModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width:80%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeBatchUpdateModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-9">
                        <span id="lastname" style="font-weight: bold; font-size: 200%;">{{ $lastname }}</span>
                        @error('lastname')
                            <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="student_id" class="col-3" style="color: darkred;">Student ID:</label>
                    <span id="student_id">{{ $student_id }}</span>
                    @error('student_id')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="year_level" class="col-3" style="color: darkred;">Year Level:</label>
                    <span id="year_level">{{ $year_level }}</span>
                    @error('year_level')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="date_of_request" class="col-3" style="color: darkred;">Date Request:</label>
                    <span id="date_of_request">{{ $date_of_request }}</span>
                    @error('date_of_request')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="status" class="col-3" style="color: darkred;">Status:</label>
                    <span id="status">{{ $status }}</span>
                    @error('status')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror
                </div>
                <hr style="color: #333; background-color: grey; height: .5px; margin: 20px 0;">
                <div class="form-group row justify-content-center">
                    <button wire:click="changeColor('checklist')" class="btn btn-sm @if($activeButton === 'checklist') btn-primary @else btn-outline-dark @endif font-weight-bold mr-2">Review Student Checklist</button>
                    <button wire:click="changeColor('plan')" class="btn btn-sm @if($activeButton === 'plan') btn-primary @else btn-outline-dark @endif font-weight-bold mr-2">Review Study Plan</button>
                </div>

                @if ($selectedStudentId && $hasStudyPlan)
                <livewire:study-plan :student_id="$selectedStudentId" />
                @endif

                @if ($selectedStudentId && $hasChecklist)
                    <div>
                        @livewire('b-s-c-sgrades', ['studentId' => $selectedStudentId], key('bscs-grades-' . $selectedStudentId))
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
    <!-- Batch Update Modal -->
    <div wire:ignore.self class="modal fade" id="bulkEditStudentModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Batch Update Students</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeBatchUpdateModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                            @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @elseif (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        <!-- Input field for batch assigning of status -->
                <div class="form-group">
                    <label for="bulk_student_status">Status</label>
                    <input type="text" class="form-control" id="bulk_student_status" wire:model="bulk_student_status">
                    @error('bulk_student_status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="closeBatchUpdateModal">Close</button>
                <button type="button" class="btn btn-primary" wire:click="applyBatchUpdate">Apply Changes</button>
            </div>
        </div>
    </div>
    </div>
</div>