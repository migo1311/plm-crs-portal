<div>
    <div id="1st-year-tables">
        <h1>1st Year 1st Semester</h1>
        <div class="card">
            <div class="card-body" style="background-color: #f8f8f8; overflow-y: auto; max-height: 60%;">
                <table class="table" style="background-color: white">
                    <thead style="background-color: #f8f8f8">
                        <tr>
                            <th>Course Name</th>
                            <th>Units</th>
                            <th>Grade</th>
                            <th>Pre(Co)-Requisites</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody11">
                    @foreach ($grades as $grade)
                        @if ($grade->class->course->aysem->academic_year_id === 1 &&
                        $grade->class->course->aysem->semester_index === 1)
                        <tr id="row_{{ $grade->id }}">
                        <td>{{ $grade->class->course->course_number }}</td>
                        <td>{{ $grade->class->course->units }}</td>
                        <td>{{ $grade->initial_grade }}</td>
                        <td>{{ $grade->class->course->pre_requisites }}</td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td> <!-- Empty columns to reach the 3rd column -->
                            <td><strong>Total Units: {{ $totalUnits11 }}</strong></td>
                            <td></td> <!-- Empty column to reach the 5th column -->
                            <td><strong>GWA: {{ $totalGrades11 }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>


        <h1>1st Year 2nd Semester</h1>

        <div class="card">
            <div class="card-body" style="background-color: #f8f8f8; overflow-y: auto; max-height: 60%;">
                <table class="table" style="background-color: white">
                    <thead style="background-color: #f8f8f8">
                        <tr>
                            <th>Course Name</th>
                            <th>Units</th>
                            <th>Grade</th>
                            <th>Pre(Co)-Requisites</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody22">
                    @foreach ($grades as $grade)
                        @if ($grade->class->course->aysem->academic_year_id === 1 &&
                        $grade->class->course->aysem->semester_index === 2)
                        <tr id="row_{{ $grade->id }}">
                        <td>{{ $grade->class->course->course_number }}</td>
                        <td>{{ $grade->class->course->units }}</td>
                        <td>{{ $grade->initial_grade }}</td>
                        <td>{{ $grade->class->course->pre_requisites }}</td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td> <!-- Empty columns to reach the 3rd column -->
                            <td><strong>Total Units: {{ $totalUnits12 }}</strong></td>
                            <td></td> <!-- Empty column to reach the 5th column -->
                            <td ><strong>GWA: {{ $totalGrades12 }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div id="2nd-year-tables">
        <h1>2nd Year 1st Semester</h1>
        <div class="card">
            <div class="card-body" style="background-color: #f8f8f8; overflow-y: auto; max-height: 60%;">
                <table class="table" style="background-color: white">
                    <thead style="background-color: #f8f8f8">
                        <tr>
                            <th>Course Name</th>
                            <th>Units</th>
                            <th>Grade</th>
                            <th>Pre(Co)-Requisites</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody21">
                    @foreach ($grades as $grade)
                        @if ($grade->class->course->aysem->academic_year_id === 2 &&
                        $grade->class->course->aysem->semester_index === 1)
                        <tr id="row_{{ $grade->id }}">
                        <td>{{ $grade->class->course->course_number }}</td>
                        <td>{{ $grade->class->course->units }}</td>
                        <td>{{ $grade->initial_grade }}</td>
                        <td>{{ $grade->class->course->pre_requisites }}</td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td> <!-- Empty columns to reach the 3rd column -->
                            <td><strong>Total Units: {{ $totalUnits21 }}</strong></td>
                            <td></td> <!-- Empty column to reach the 5th column -->
                            <td><strong>GWA: {{ $totalGrades21 }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>


        <h1>2nd Year 2nd Semester</h1>

        <div class="card">
            <div class="card-body" style="background-color: #f8f8f8; overflow-y: auto; max-height: 60%;">
                <table class="table" style="background-color: white">
                    <thead style="background-color: #f8f8f8">
                        <tr>
                            <th>Course Name</th>
                            <th>Units</th>
                            <th>Grade</th>
                            <th>Pre(Co)-Requisites</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody22">
                    @foreach ($grades as $grade)
                        @if ($grade->class->course->aysem->academic_year_id === 2 &&
                        $grade->class->course->aysem->semester_index === 2)
                        <tr id="row_{{ $grade->id }}">
                        <td>{{ $grade->class->course->course_number }}</td>
                        <td>{{ $grade->class->course->units }}</td>
                        <td>{{ $grade->initial_grade }}</td>
                        <td>{{ $grade->class->course->pre_requisites }}</td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td> <!-- Empty columns to reach the 3rd column -->
                            <td><strong>Total Units: {{ $totalUnits22 }}</strong></td>
                            <td></td> <!-- Empty column to reach the 5th column -->
                            <td ><strong>GWA: {{ $totalGrades22 }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    
    <div id="3rd-year-tables">
        <h1>3rd Year 1st Semester</h1>
        <div class="card">
            <div class="card-body" style="background-color: #f8f8f8; overflow-y: auto; max-height: 60%;">
                <table class="table" style="background-color: white">
                    <thead style="background-color: #f8f8f8">
                        <tr>
                            <th>Course Name</th>
                            <th>Units</th>
                            <th>Grade</th>
                            <th>Pre(Co)-Requisites</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody31">
                    @foreach ($grades as $grade)
                        @if ($grade->class->course->aysem->academic_year_id === 3 &&
                        $grade->class->course->aysem->semester_index === 1)
                        <tr id="row_{{ $grade->id }}">
                        <td>{{ $grade->class->course->course_number }}</td>
                        <td>{{ $grade->class->course->units }}</td>
                        <td>{{ $grade->initial_grade }}</td>
                        <td>{{ $grade->class->course->pre_requisites }}</td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td> <!-- Empty columns to reach the 3rd column -->
                            <td><strong>Total Units: {{ $totalUnits31 }}</strong></td>
                            <td></td> <!-- Empty column to reach the 5th column -->
                            <td><strong>GWA: {{ $totalGrades31 }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>


        <h1>3rd Year 2nd Semester</h1>

        <div class="card">
            <div class="card-body" style="background-color: #f8f8f8; overflow-y: auto; max-height: 60%;">
                <table class="table" style="background-color: white">
                    <thead style="background-color: #f8f8f8">
                        <tr>
                            <th>Course Name</th>
                            <th>Units</th>
                            <th>Grade</th>
                            <th>Pre(Co)-Requisites</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody22">
                    @foreach ($grades as $grade)
                        @if ($grade->class->course->aysem->academic_year_id === 3 &&
                        $grade->class->course->aysem->semester_index === 2)
                        <tr id="row_{{ $grade->id }}">
                        <td>{{ $grade->class->course->course_number }}</td>
                        <td>{{ $grade->class->course->units }}</td>
                        <td>{{ $grade->initial_grade }}</td>
                        <td>{{ $grade->class->course->pre_requisites }}</td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td> <!-- Empty columns to reach the 3rd column -->
                            <td><strong>Total Units: {{ $totalUnits32 }}</strong></td>
                            <td></td> <!-- Empty column to reach the 5th column -->
                            <td ><strong>GWA: {{ $totalGrades32 }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div id="4th-year-tables">
        <h1>4th Year 1st Semester</h1>
        <div class="card">
            <div class="card-body" style="background-color: #f8f8f8; overflow-y: auto; max-height: 60%;">
                <table class="table" style="background-color: white">
                    <thead style="background-color: #f8f8f8">
                        <tr>
                            <th>Course Name</th>
                            <th>Units</th>
                            <th>Grade</th>
                            <th>Pre(Co)-Requisites</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody41">
                    @foreach ($grades as $grade)
                        @if ($grade->class->course->aysem->academic_year_id === 4 &&
                        $grade->class->course->aysem->semester_index === 1)
                        <tr id="row_{{ $grade->id }}">
                        <td>{{ $grade->class->course->course_number }}</td>
                        <td>{{ $grade->class->course->units }}</td>
                        <td>{{ $grade->initial_grade }}</td>
                        <td>{{ $grade->class->course->pre_requisites }}</td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td> <!-- Empty columns to reach the 3rd column -->
                            <td><strong>Total Units: {{ $totalUnits41 }}</strong></td>
                            <td></td> <!-- Empty column to reach the 5th column -->
                            <td><strong>GWA: {{ $totalGrades41 }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>


        <h1>4th Year 2nd Semester</h1>

        <div class="card">
            <div class="card-body" style="background-color: #f8f8f8; overflow-y: auto; max-height: 60%;">
                <table class="table" style="background-color: white">
                    <thead style="background-color: #f8f8f8">
                        <tr>
                            <th>Course Name</th>
                            <th>Units</th>
                            <th>Grade</th>
                            <th>Pre(Co)-Requisites</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody22">
                    @foreach ($grades as $grade)
                        @if ($grade->class->course->aysem->academic_year_id === 4 &&
                        $grade->class->course->aysem->semester_index === 2)
                        <tr id="row_{{ $grade->id }}">
                        <td>{{ $grade->class->course->course_number }}</td>
                        <td>{{ $grade->class->course->units }}</td>
                        <td>{{ $grade->initial_grade }}</td>
                        <td>{{ $grade->class->course->pre_requisites }}</td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td> <!-- Empty columns to reach the 3rd column -->
                            <td><strong>Total Units: {{ $totalUnits42 }}</strong></td>
                            <td></td> <!-- Empty column to reach the 5th column -->
                            <td ><strong>GWA: {{ $totalGrades42 }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>