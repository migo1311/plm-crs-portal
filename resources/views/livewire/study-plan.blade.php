<div>
        @if ($hasYear2)
        <div id="2nd-year-tables" >
            <h1>2nd Year 1st Semester</h1>
            <div class="card">
            <!-- /.card-header -->
            <div class="card-body" style="background-color: #f8f8f8; overflow-y: auto; max-height: 60%;">
                <table class="table " style="background-color: white">
        
                <thead style="background-color: #f8f8f8">
                    <tr>
                    <th>Course Code</th>
                     
                    <th>Units</th>
                    <th>Pre(Co)-Requisites</th>
                    </tr>
                </thead>  
                <tbody id="tableBody">
                @foreach ($courses as $course)
                    @if (in_array(trim($course->course_id), $allowedCourseCodes))
                        @php
                            // Fetch the corresponding aysem record
                            $aysem = \App\Models\Aysem::find($course->aysem_id);
                        @endphp

                        @if ($aysem->academic_year_id === 2 && $aysem->semester_index === 1)
                            <tr id="row_{{ $course->id }}">
                                <td>{{ $course->course_number }}</td>
                                <td>{{ $course->units }}</td>
                                <td>{{ $course->pre_requisites }}</td>
                            </tr>
                        @endif
                    @endif
                @endforeach
                </tbody>
                </table>
            </div>
            </div>
            <span id="totalUnits21">
                {{ $totalUnits21 }}
                @if ($totalUnits21 < 10)
                    <span class="badge badge-success">Underload</span>
                @elseif ($totalUnits21 >= 10 && $totalUnits21 <= 13)
                    <span class="badge badge-primary">Normal Load</span>
                @else
                    <span class="badge badge-danger">Overload</span>
                @endif
            </span>
        
            <h1>2nd Year 2nd Semester</h1>
        
            <div class="card">
            <!-- /.card-header -->
            <div class="card-body" style="background-color: #f8f8f8; overflow-y: auto; max-height: 60%;">
                <table class="table " style="background-color: white">
        
                <thead style="background-color: #f8f8f8">
                    <th>Course Code</th>
                    <th>Units</th>
                    <th>Pre(Co)-Requisites</th>
                    </tr>
                </thead>  
                <tbody id="tableBody22">
                @foreach ($courses as $course)
                    @if (in_array(trim($course->course_id), $allowedCourseCodes))
                        @php
                            // Fetch the corresponding aysem record
                            $aysem = \App\Models\Aysem::find($course->aysem_id);
                        @endphp

                        @if ($aysem->academic_year_id === 2 && $aysem->semester_index === 2)
                            <tr id="row_{{ $course->id }}">
                                <td>{{ $course->course_number }}</td>
                                <td>{{ $course->units }}</td>
                                <td>{{ $course->pre_requisites }}</td>
                                <td>{{ $aysem->semester_index }}</td>
                            </tr>
                        @endif
                    @endif
                @endforeach

                </tbody>
                </table>
            </div>
            </div>
            <span id="totalUnits22">
                {{ $totalUnits22 }}
                @if ($totalUnits22 < 10)
                    <span class="badge badge-success">Underload</span>
                @elseif ($totalUnits22 >= 10 && $totalUnits22 <= 13)
                    <span class="badge badge-primary">Normal Load</span>
                @else
                    <span class="badge badge-danger">Overload</span>
                @endif
            </span>
        </div>
        @endif
        
        @if ($hasYear3)
        <div id="3rd-year-tables" >
            <h1>3rd Year 1st Semester</h1>
            <div class="card">
            <!-- /.card-header -->
            <div class="card-body" style="background-color: #f8f8f8; overflow-y: auto; max-height: 60%;">
                <table class="table " style="background-color: white">
        
                <thead style="background-color: #f8f8f8">
                    <th>Course Code</th>
                     
                    <th>Units</th>
                    <th>Pre(Co)-Requisites</th>
                    </tr>
                </thead> 
                @foreach ($courses as $course)
                    @if (in_array(trim($course->course_id), $allowedCourseCodes))
                        @php
                            // Fetch the corresponding aysem record
                            $aysem = \App\Models\Aysem::find($course->aysem_id);
                        @endphp

                        @if ($aysem->academic_year_id === 3 && $aysem->semester_index === 1)
                            <tr id="row_{{ $course->id }}">
                                <td>{{ $course->course_number }}</td>
                                <td>{{ $course->units }}</td>
                                <td>{{ $course->pre_requisites }}</td>
                            </tr>
                        @endif
                    @endif
                @endforeach
                </tbody>
                </table>
            </div>
            </div>
            <span id="totalUnits32">
                {{ $totalUnits32 }}
                @if ($totalUnits32 < 10)
                    <span class="badge badge-success">Underload</span>
                @elseif ($totalUnits32 >= 10 && $totalUnits32 <= 13)
                    <span class="badge badge-primary">Normal Load</span>
                @else
                    <span class="badge badge-danger">Overload</span>
                @endif
            </span>
                    
            <h1>3rd Year 2nd Semester</h1>
        
            <div class="card">
            <!-- /.card-header -->
            <div class="card-body" style="background-color: #f8f8f8; overflow-y: auto; max-height: 60%;">
                <table class="table " style="background-color: white">
                <thead style="background-color: #f8f8f8">
                    <tr>
                    <th>Course Code</th>
                     
                    <th>Units</th>
                    <th>Pre(Co)-Requisites</th>
                    </tr>
                </thead>  
                <tbody id="tableBody42">
                @foreach ($courses as $course)
                    @if (in_array(trim($course->course_id), $allowedCourseCodes))
                        @php
                            // Fetch the corresponding aysem record
                            $aysem = \App\Models\Aysem::find($course->aysem_id);
                        @endphp

                        @if ($aysem->academic_year_id === 3 && $aysem->semester_index === 2)
                            <tr id="row_{{ $course->id }}">
                                <td>{{ $course->course_number }}</td>
                                <td>{{ $course->units }}</td>
                                <td>{{ $course->pre_requisites }}</td>
                            </tr>
                        @endif
                    @endif
                @endforeach
                </tbody>
                </table>
            </div>
            </div>
            <span id="totalUnits42">
                {{ $totalUnits42 }}
                @if ($totalUnits42 < 10)
                    <span class="badge badge-success">Underload</span>
                @elseif ($totalUnits42 >= 10 && $totalUnits42 <= 13)
                    <span class="badge badge-primary">Normal Load</span>
                @else
                    <span class="badge badge-danger">Overload</span>
                @endif
            </span>
        </div>
        @endif

        @if ($hasYear4)
        <div id="4th-year-tables" >
            <h1>4th Year 1st Semester</h1>
        
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body" style="background-color: #f8f8f8; overflow-y: auto; max-height: 60%;">
                    <table class="table " style="background-color: white">
                        <thead style="background-color: #f8f8f8">
                            <tr>
                                <th>Course Code</th>
                                 
                                <th>Units</th>
                                <th>Pre(Co)-Requisites</th>
                            </tr>
                        </thead>  
                        <tbody id="tableBody72">
                        @foreach ($courses as $course)
                            @if (in_array(trim($course->course_id), $allowedCourseCodes))
                                @php
                                    // Fetch the corresponding aysem record
                                    $aysem = \App\Models\Aysem::find($course->aysem_id);
                                @endphp

                                @if ($aysem->academic_year_id === 4 && $aysem->semester_index === 1)
                                    <tr id="row_{{ $course->id }}">
                                        <td>{{ $course->course_number }}</td>
                                        <td>{{ $course->units }}</td>
                                        <td>{{ $course->pre_requisites }}</td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <span id="totalUnits72">
                {{ $totalUnits72 }}
                @if ($totalUnits72 < 10)
                    <span class="badge badge-success">Underload</span>
                @elseif ($totalUnits72 >= 10 && $totalUnits72 <= 13)
                    <span class="badge badge-primary">Normal Load</span>
                @else
                    <span class="badge badge-danger">Overload</span>
                @endif
            </span>
        

            <h1>4th Year 2nd Semester</h1>
        
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body" style="background-color: #f8f8f8; overflow-y: auto; max-height: 60%;">
                    <table class="table " style="background-color: white">
                        <thead style="background-color: #f8f8f8">
                            <tr>
                                <th>Course Code</th>
                                 
                                <th>Units</th>
                                <th>Pre(Co)-Requisites</th>
                            </tr>
                        </thead>  
                        <tbody id="tableBody62">
                        @foreach ($courses as $course)
                            @if (in_array(trim($course->course_id), $allowedCourseCodes))
                                @php
                                    // Fetch the corresponding aysem record
                                    $aysem = \App\Models\Aysem::find($course->aysem_id);
                                @endphp

                                @if ($aysem->academic_year_id === 4 && $aysem->semester_index === 2)
                                    <tr id="row_{{ $course->id }}">
                                        <td>{{ $course->course_number }}</td>
                                        <td>{{ $course->units }}</td>
                                        <td>{{ $course->pre_requisites }}</td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <span id="totalUnits62">
                {{ $totalUnits62 }}
                @if ($totalUnits62 < 10)
                    <span class="badge badge-success">Underload</span>
                @elseif ($totalUnits62 >= 10 && $totalUnits62 <= 13)
                    <span class="badge badge-primary">Normal Load</span>
                @else
                    <span class="badge badge-danger">Overload</span>
                @endif
            </span>
        </div>
        @endif

        <br>
        <button wire:click="pushApprove"  class="btn btn-success" data-dismiss="modal">Approve</button>
        <button wire:click="pushReject" type="button" class="btn btn-danger" data-dismiss="modal">Reject</button>
        <br>
</div>
