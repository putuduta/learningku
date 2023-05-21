@if (auth()->user()->role->name == 'Student')
@if(empty($attendances))
<x-app title="Attendances - Learningku">

    <style>
        .title-line {
            width: 80px;
            height: 3px;
            background: black;
            margin: 0 auto;
        }
        .classSubject:hover {
            cursor: pointer;
            background: lightgray !important;
        }
        .fa-stack.small { font-size: 0.5em; }
        i { vertical-align: middle; }
    </style>

    <div id="content" class="container py-5 my-5">
        <div class="">
            <div class="col-md-6">
                <h2 class="fw-bold">Attendances</h2>
                <form id="formChooseSchoolYear" method="GET">
                    <div class="my-3">
                            <label for="class_id" class="form-label">Class - School Year</label>
                            <select id="class_id" name="class_id" class="form-select" required>

                                @foreach ($classSubjects->unique('schoolYearId') as $class)
                                    <option value="{{$class->classId}}">{{$class->name}} - {{$class->schoolYear}} {{$class->semester}}</option>
                                @endforeach
                            </select>
                    </div>
                </form>
            </div>
        </div>
        <hr>

        <div id="classAndSubjetTable" class="row">
            @foreach ($classSubjects->where('classId', $classSubjects->first()->classId) as $subject)
            <div class="col-md-4">
                <div class="classSubject card shadow-sm border-0 mb-3 bg-white" data-id="{{$subject->subjectId}}">
                    <div class="card-body">
                            <h3 class="fw-bold">{{ $subject->subjectName }}</h3>
                            <h5 class="pb-3">Teacher: {{ $subject->teacherName }} - {{ $subject->teacherNuptk }}</h5>
                            <h8><span class="fa-stack small"><i class="fas fa-circle fa-stack-2x text-orange"></i><i class="fas fa-home fa-stack-1x fa-2xs fa-inverse text-white"></i></span> {{ $classSubjects->first()->name }}
                            <br><span class="fa-stack small"><i class="fas fa-circle fa-stack-2x text-orange"></i><i class="fas fa-user fa-stack-1x fa-2xs fa-inverse text-white"></i></span> Homeroom Teacher: {{ $classSubjects->first()->homeroomTeacherName }} - {{ $classSubjects->first()->homeRoomTeacherNuptk }}</h8>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app>

<script>

    $(".classSubject").on('click', function (e) {
         event.preventDefault(); 
         window.location.href = "/attendance/student/" + $(this).attr("data-id");
    });
    
    $("#class_id").on('change', function (e) {
         // Stop form from submitting normally
         event.preventDefault();

         $classId = $('#class_id').val();

         if ($classId != "" && $classId != null) {
              $.ajax({
                   type:"GET",
                   dataType: "json",
                   url:"/class-student/get-list/" + $classId,
                   success:function(data)
                   {

                        var body = '';
                        data.forEach(function(item) {
                             body = '<div class="col-md-4">' +
                                       '<div class="classSubject card shadow-sm border-0 mb-3 bg-white" data-id="' + item.id + '">' +
                                            '<div class="card-body">' +
                                                 '<h3 class="fw-bold">' + item.name + '</h3>' +
                                                 '<h5 class="pb-3">Teacher: ' + item.teacherName + ' - ' + item.teacherNuptk + '</h5>' +
                                                 '<h8><span class="fa-stack small"><i class="fas fa-circle fa-stack-2x text-orange"></i><i class="fas fa-home fa-stack-1x fa-2xs fa-inverse text-white"></i></span>' + item.className + '<br><span class="fa-stack small"><i class="fas fa-circle fa-stack-2x text-orange"></i><i class="fas fa-user fa-stack-1x fa-2xs fa-inverse text-white"></i></span> Homeroom Teacher: ' + item.homeRoomTeacherName + ' - ' + item.homeRoomTeacherNuptk + '</h8>'
                                            '</div>' +
                                       '</div>' +
                                    '</div>';                 
                        });               

                        $("#classAndSubjetTable").html(body);
                   }
              });                    
         }

    });
</script>
@else
<x-app title="Attendances - Learningku">
    <style>
        .fa-stack.small { font-size: 0.5em; }
        i { vertical-align: middle; }
    </style>
    <x-slot name="navbar"></x-slot>

    <section id="headerClassSubject">
        <div id="content" class="container pt-5 mt-5">
            <section id="headerClassDetail">
    
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-10">
                                <h2 class="fw-bold">Subject {{ $classSubject->name }}</h2>
                                <h5 class="pb-2">Teacher: {{ $classSubject->teacherName }} - {{ $classSubject->teacherNuptk }}</h5>
                                <h5><span class="fa-stack small pb-4"><i class="fas fa-circle fa-stack-2x text-orange"></i><i class="fas fa-home fa-stack-1x fa-2xs fa-inverse text-white"></i></span> {{ $classSubject->className }} - {{ $classSubject->schoolYear }} {{ $classSubject->semester }} <span class="fa-stack small pb-4"><i class="fas fa-circle fa-stack-2x text-orange"></i><i class="fas fa-user fa-stack-1x fa-2xs fa-inverse text-white"></i></span> Homeroom Teacher: {{ $classSubject->homeRoomTeacherName }} - {{ $classSubject->homeRoomTeacherNuptk }}</h5>
                            </div>           
                        </div>
                    </div>
                </div>
            </section>
    
    
            <nav class="" style="font-size:1.25rem">
                {{-- <div class="container"> --}}
                    <ul class="nav nav-tabs">
                        @if (auth()->user()->role->name == 'Teacher')
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forums</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index-teacher', $classSubject->id ) }}">Scores</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('attendance.view-teacher', $classSubject->id ) }}">Attendances</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('class-view-student', $classSubject->id ) }}">Students</a></li>
                        @endif
        
                        @if (auth()->user()->role->name == 'Student')
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forums</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index-student', $classSubject->id ) }}">Scores</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('attendance.view-student', $classSubject->id ) }}">Attendances</a></li>
                        @endif
                    </ul>
                {{-- </div> --}}
            </nav>
        </div>
    </section>

    <div id="content" class="container my-3">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">Total Present</th>
                    <th class="align-middle text-center">Total Sick</th>
                    <th class="align-middle text-center">Total Absence Permit</th>
                    <th class="align-middle text-center">Total Absent</th>
                </thead>
                <tbody>
                    @if ($attendances->first()->header->class_subject_id === $classSubject->id) 
                    <td class="align-middle text-center">
                        {{ count($attendances->where("status", "Present")) }} </td>
                    <td class="align-middle text-center">
                        {{ count($attendances->where("status", "Sick")) }}</td></td>
                    <td class="align-middle text-center">
                        {{ count($attendances->where("status", "Absence Permit")) }}</td></td>
                    <td class="align-middle text-center">
                        {{ count($attendances->where("status", "Absent")) }}</td></td>       
                    @endif                     
                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">No</th>
                    <th class="align-middle text-center">Date</th>
                    <th class="align-middle text-center">Status</th>
                </thead>
                <tbody>
                    @foreach($attendances as $index=>$attendance)
                    @if ($attendance->header->class_subject_id === $classSubject->id)
                    <tr>
                        <td class="align-middle text-center">{{ $index+1 }}</td>
                        <td class="align-middle text-center">
                            {{ date_format(date_create($attendance->header->date),"d F Y") }}
                        </td>
                        @if($attendance->status == 'Present')
                        <td class="align-middle text-center bg-success text-white">
                            Present
                        </td>
                        @elseif ($attendance->status == 'Sick')
                        <td class="align-middle text-center text-white" style="background-color: orange;">
                            Sick
                        </td>  
                        @elseif ($attendance->status == 'Absence Permit')
                        <td class="align-middle text-center text-white" style="background-color: orange;">
                            Absence Permit
                        </td>
                        @else 
                        <td class="align-middle text-center bg-danger text-white">
                            Absent
                        </td>
                        @endif
                    </tr>                        
                    @endif

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>
@endif
@else
@if(empty($attendances))
<x-app  title="Attendances - Learningku">
     
    <x-slot name="navbar"></x-slot>

    <style>
         .classSubject:hover {
              cursor: pointer;
              background: lightgray !important;
         }
    </style>

    <div id="content" class="container py-5 my-5">
         <div class="">
              <div class="col-md-6">
                    <h2 class="fw-bold">Attendances</h2>
                   <form id="formChooseSchoolYear" method="GET">
                        <div class="my-3">
                             <label for="school_year_id" class="form-label">School Year</label>
                             <select id="school_year_id" name="school_year_id" class="form-select" required>

                                  @foreach ($classSubjects->unique('schoolYearId') as $classSubject)
                                      <option value="{{$classSubject->schoolYearId}}">{{$classSubject->schoolYear}} - {{$classSubject->semester}}</option>
                                  @endforeach
                             </select>
                        </div>
                   </form>
              </div>
         </div>
         <hr>

         <div id="classAndSubjetTable" class="row">
              @foreach ($classSubjects as $classSubject)
              <div class="col-md-4">
                   <div class="classSubject card shadow-sm border-0 mb-3 bg-white" data-id="{{$classSubject->id}}">
                        <div class="card-body">
                             <h3 class="fw-bold">{{ $classSubject->className }} - {{ $classSubject->name }}</h3>
                             <h8 class="pt-3">Homeroom Teacher: {{ $classSubject->homeroomTeacherName }} - {{ $classSubject->homeroomTeacherNuptk }}</h8>
                        </div>
                   </div>
              </div>
              @endforeach
         </div>
    </div>
</x-app>

<script>

    $(".classSubject").on('click', function (e) {
         event.preventDefault(); 
         window.location.href = "/attendance/teacher/" + $(this).attr("data-id");
    });
    
    $("#school_year_id").on('change', function (e) {
         // Stop form from submitting normally
         event.preventDefault();

         $schoolYearId = $('#school_year_id').val();

         if ($schoolYearId != "" && $schoolYearId != null) {
              $.ajax({
                   type:"GET",
                   dataType: "json",
                   url:"/class-teacher/get-list/" + $schoolYearId,
                   success:function(data)
                   {

                        var body = '';
                        data.forEach(function(item) {
                             body = '<div class="col-md-4">' +
                                       '<div class="classSubject card shadow-sm border-0 mb-3 bg-white" data-id="' + item.id + '">' +
                                            '<div class="card-body">' +
                                                 '<h3 class="fw-bold">' + item.className + ' - ' + item.name + '</h3>' +
                                                 '<h8 class="pt-3">Teacher: ' + item.homeroomTeacherName + ' - ' + item.homeroomTeacherNuptk + '</h8>' +
                                            '</div>' +
                                       '</div>' +
                                    '</div>';                 
                        });               

                        $("#classAndSubjetTable").html(body);
                   }
              });                    
         }

    });
</script>
@else
<x-app title="Attendances - Learningku">
    <style>
        .fa-stack.small { font-size: 0.5em; }
        i { vertical-align: middle; }
    </style>
    <x-slot name="navbar"></x-slot>

    <section id="headerClassSubject">
        <div id="content" class="container pt-5 mt-5">
            <section id="headerClassDetail">
    
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-10">
                                <h2 class="fw-bold">Subject {{ $classSubject->name }}</h2>
                                <h5 class="pb-2">Teacher: {{ $classSubject->teacherName }} - {{ $classSubject->teacherNuptk }}</h5>
                                <h5><span class="fa-stack small pb-4"><i class="fas fa-circle fa-stack-2x text-orange"></i><i class="fas fa-home fa-stack-1x fa-2xs fa-inverse text-white"></i></span> {{ $classSubject->className }} - {{ $classSubject->schoolYear }} {{ $classSubject->semester }} <span class="fa-stack small pb-4"><i class="fas fa-circle fa-stack-2x text-orange"></i><i class="fas fa-user fa-stack-1x fa-2xs fa-inverse text-white"></i></span> Homeroom Teacher: {{ $classSubject->homeRoomTeacherName }} - {{ $classSubject->homeRoomTeacherNuptk }}</h5>
                            </div>           
                        </div>
                    </div>
                </div>
            </section>
    
            <nav class="" style="font-size:1.25rem">
                {{-- <div class="container"> --}}
                    <ul class="nav nav-tabs">
                        @if (auth()->user()->role->name == 'Teacher')
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forums</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index-teacher', $classSubject->id ) }}">Scores</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('attendance.view-teacher', $classSubject->id ) }}">Attendances</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('class-view-student', $classSubject->id ) }}">Students</a></li>
                        @endif
        
                        @if (auth()->user()->role->name == 'Student')
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forums</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index-student', $classSubject->id ) }}">Scores</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('attendance.view-student', $classSubject->id ) }}">Attendances</a></li>
                        @endif
                    </ul>
                {{-- </div> --}}
            </nav>
        </div>
    </section>



    <div id="content" class="container my-3">
        <div class="text-end">
            <a href="{{ route('attendance.view-create',$classSubject->id) }}" class="btn btn-primary text-white mb-3">Do Student
                Attendance</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">No</th>
                    <th class="align-middle text-center">Date</th>
                    <th class="align-middle text-center">Class</th>
                    <th class="align-middle text-center">Subject</th>
                    <th class="align-middle text-center">Actions</th>
                </thead>
                <tbody>
                    @foreach($attendances as $index=>$attendance)
                    <tr>
                        <td class="align-middle text-center">{{ $index+1 }}</td>
                        <td class="align-middle text-center">{{ date_format(date_create($attendance->date),"d F Y") }}
                        </td>
                        <td class="align-middle text-center">{{ $attendance->className }}</td>
                        <td class="align-middle text-center">{{ $attendance->subjectName }}</td>
                        <td class="align-middle text-center">
                            <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                                data-bs-target="#detail-{{ $attendance->id }}">
                                Details
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>

@foreach($attendances as $attendance)
<div class="modal fade" id="detail-{{ $attendance->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Attendance Detail - {{ $attendance->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Date: {{ date_format(date_create($attendance->date),"d F Y") }}</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                            <th class="align-middle text-center">Total Present</th>
                            <th class="align-middle text-center">Total Sick</th>
                            <th class="align-middle text-center">Total Absence Permit</th>
                            <th class="align-middle text-center">Total Absent</th>
                        </thead>
                        <tbody>
                            <td class="align-middle text-center">
                                {{ count($attendance->details->where("status", "Present")) }}</td>
                            <td class="align-middle text-center">
                                {{ count($attendance->details->where("status", "Sick")) }}</td></td>
                            <td class="align-middle text-center">
                                {{ count($attendance->details->where("status", "Absence Permit")) }}</td></td>
                            <td class="align-middle text-center">
                                {{ count($attendance->details->where("status", "Absent")) }}</td></td>                            
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                            <th class="align-middle text-center">No</th>
                            <th class="align-middle text-center">NISN</th>
                            <th class="align-middle text-center">Student Name</th>
                            <th class="align-middle text-center">Status</th>
                        </thead>
                        <tbody>
                            @foreach($attendance->details as $index => $detail)
                            <tr>
                                <td class="align-middle text-center">
                                    {{ $index+1 }}</td>
                                <td class="align-middle text-center">
                                    {{ $detail->student->user_code }}</td>
                                <td class="align-middle text-center">
                                    {{ $detail->student->name }}</td>

                                    @if($detail->status == 'Present')
                                    <td class="align-middle text-center bg-success text-white">
                                        Present
                                    </td>
                                    @elseif ($detail->status == 'Sick')
                                    <td class="align-middle text-center text-white" style="background-color: orange;">
                                        Sick
                                    </td>  
                                    @elseif ($detail->status == 'Absence Permit')
                                    <td class="align-middle text-center text-white" style="background-color: orange;">
                                        Absence Permit
                                    </td>
                                    @else 
                                    <td class="align-middle text-center bg-danger text-white">
                                        Absent
                                    </td>
                                    @endif
                            </tr>      
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif
@endif