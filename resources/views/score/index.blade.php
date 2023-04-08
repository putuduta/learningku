@if (auth()->user()->role->name == 'Student')
<x-app title="Assignment Scores - Learningku">
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
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('score.index', $classSubject->id ) }}">Assignment Scores</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view', $classSubject->id ) }}">Attendances</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('class-view-student', $classSubject->id ) }}">Students</a></li>
                        @endif
        
                        @if (auth()->user()->role->name == 'Student')
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forums</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('score.index', $classSubject->id ) }}">Assignment Scores</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view', $classSubject->id ) }}">Attendances</a></li>
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
                    <th class="align-middle text-center">No</th>
                    <th class="align-middle text-center">Assignment Name</th>
                    <th class="align-middle text-center">Score</th>
                </thead>
                <tbody>
                    @php $score = 0; $count = 0; @endphp
                    @foreach ($scores as $index => $s)
                        @if (!(strtotime($s->assignment_header->end_time) > time()))
                        <tr>
                            <td class="align-middle text-center">{{ $index + 1 }}</td>
                            <td class="align-middle text-center">{{ $s->assignment_header->title }}</td>
                            <td class="align-middle text-center">{{ $s->score }}</td>
                        </tr>
                        @php $score += $s->score; $count += 1; @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="table-responsive-sm">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">Overall Score</th>
                    <th class="align-middle text-center">Minimum Score</th>
                </thead>
                <tbody>
                    @if ( $score/$count > $classSubject->minimum_score)
                    <td class="align-middle text-center bg-success">  
                    @else
                    <td class="align-middle text-center bg-danger">
                    @endif
                        {{ $score/$count }}</td>
                    <td class="align-middle text-center">
                        {{ $classSubject->minimum_score }}</td></td>                         
                </tbody>
            </table>
        </div>
    </div>
</x-app>
@else
<x-app title="Assignment Scores - Learningku">
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
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('score.index', $classSubject->id ) }}">Assignment Scores</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view', $classSubject->id ) }}">Attendances</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('class-view-student', $classSubject->id ) }}">Students</a></li>
                        @endif
        
                        @if (auth()->user()->role->name == 'Student')
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forums</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('score.index', $classSubject->id ) }}">Assignment Scores</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view', $classSubject->id ) }}">Attendances</a></li>
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
                    <th class="align-middle text-center">No</th>
                    <th class="align-middle text-center">NISN</th>
                    <th class="align-middle text-center">Student Name</th>
                    <th class="align-middle text-center">Action</th>
                </thead>
                <tbody>
                    @foreach($class_details as $index => $student)
                                <tr>
                                    <td class="align-middle text-center">{{ $index+1 }}</td>
                                    <td class="align-middle text-center">{{ $student->studentNisn }}</td>
                                    <td class="align-middle text-center">{{ $student->studentName }}</td>
                                    <td class="align-middle text-center">
                                        <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                                        data-bs-target="#detail-{{ $student->studentId }}">
                                            Show Assignment Scores
                                        </button>
                                    </td>
                                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>

@foreach($class_details as $student)
<div class="modal fade" id="detail-{{ $student->studentId }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Assignment Scores -  ({{ $student->studentName }} - {{ $student->studentNisn }})</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                            <th class="align-middle text-center">No</th>
                            <th class="align-middle text-center">Assignment Name</th>
                            <th class="align-middle text-center">Score</th>
                        </thead>
                        <tbody>
                            @php $score = 0; $count = 0; @endphp
                            @foreach ($scores as $s)
                                @if ($s->student_user_id == $student->studentId)
                                    @if (!(strtotime($s->assignment_header->end_time) > time()))
                                    @php $score += $s->score; $count += 1; @endphp
                                    <tr>
                                        <td class="align-middle text-center">{{ $count }}</td>
                                        <td class="align-middle text-center">{{ $s->assignment_header->title }}</td>
                                        <td class="align-middle text-center">{{ $s->score }}</td>
                                    </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                            <th class="align-middle text-center">Overall Score</th>
                            <th class="align-middle text-center">Minimum Score</th>
                        </thead>
                        <tbody>
                            @if ( $score/$count > $classSubject->minimum_score)
                            <td class="align-middle text-center bg-success">  
                            @else
                            <td class="align-middle text-center bg-danger">
                            @endif
                                {{ $score/$count }}</td>
                            <td class="align-middle text-center">
                                {{ $classSubject->minimum_score }}</td></td>                         
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