@if (auth()->user()->role->name == 'Student')
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
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index', $classSubject->id ) }}">Assignment Scores</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('attendance.view', $classSubject->id ) }}">Attendances</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('class-view-student', $classSubject->id ) }}">Students</a></li>
                        @endif
        
                        @if (auth()->user()->role->name == 'Student')
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forums</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index', $classSubject->id ) }}">Assignment Scores</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('attendance.view', $classSubject->id ) }}">Attendances</a></li>
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
                    <td class="align-middle text-center">
                        {{ count($attendances->where("status", "Present")) }}</td>
                    <td class="align-middle text-center">
                        {{ count($attendances->where("status", "Sick")) }}</td></td>
                    <td class="align-middle text-center">
                        {{ count($attendances->where("status", "Absence Permit")) }}</td></td>
                    <td class="align-middle text-center">
                        {{ count($attendances->where("status", "Absent")) }}</td></td>                            
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>
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
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index', $classSubject->id ) }}">Assignment Scores</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('attendance.view', $classSubject->id ) }}">Attendances</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('class-view-student', $classSubject->id ) }}">Students</a></li>
                        @endif
        
                        @if (auth()->user()->role->name == 'Student')
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forums</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index', $classSubject->id ) }}">Assignment Scores</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('attendance.view', $classSubject->id ) }}">Attendances</a></li>
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
                            @foreach($students as $student)
                            @if ($student->studentId == $detail->student->id)
                            <tr>
                                <td class="align-middle text-center">
                                    {{ $index+1 }}</td>
                                <td class="align-middle text-center">
                                        {{ $student->studentNisn }}</td>
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
                            @endif
                            @endforeach
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