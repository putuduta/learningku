@if (auth()->user()->role->name == 'Student')
<x-app title="Scores - Learningku">
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
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('score.index', $classSubject->id ) }}">Scores</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view', $classSubject->id ) }}">Attendances</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('class-view-student', $classSubject->id ) }}">Students</a></li>
                        @endif
        
                        @if (auth()->user()->role->name == 'Student')
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forums</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('score.index', $classSubject->id ) }}">Scores</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view', $classSubject->id ) }}">Attendances</a></li>
                        @endif
                    </ul>
                {{-- </div> --}}
            </nav>
        </div>
    </section>
    <div id="content" class="container my-3">
        
        <h5 class="modal-title pb-2 px-3" id="staticBackdropLabel">Assignment Scores</h5>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">No</th>
                    <th class="align-middle text-center">Assignment Name</th>
                    <th class="align-middle text-center">Score</th>
                    <th class="align-middle text-center">Notes/Feedback</th>
                </thead>
                <tbody>
                    @php $score = 0; $count = 0; $isAllAsgNotScored = true; @endphp
                    @foreach ($assignmentScores as $s)
                        @if($s->assignmentHeader->class_subject_id == $classSubject->id)
                            @if (!(strtotime($s->assignmentHeader->end_time) > time()) && $s->score !== null)
                                @php $score += $s->score; $count += 1; @endphp
                                <tr>
                                    <td class="align-middle text-center">{{ $count }}</td>
                                    <td class="align-middle text-center">{{ $s->assignmentHeader->title }}</td>
                                    <td class="align-middle text-center">{{ $s->score }}</td>
                                    <td class="align-middle text-center">
                                        <button type="button" class="btn btn-primary text-white justify-content-between" data-bs-toggle="modal"
                                        data-bs-target="#notes{{ $s->id }}">
                                            Show
                                        </button>
                                    </td>
                                </tr>
                            @endif
                            @if ($s->score === null)
                                @php $score += $s->score; $count += 1; $isAllAsgNotScored = false; @endphp
                                <tr>
                                    <td class="align-middle text-center">{{ $count }}</td>
                                    <td class="align-middle text-center">{{ $s->assignmentHeader->title }}</td>
                                    <td class="align-middle text-center">-</td>
                                    <td class="align-middle text-center">
                                        -
                                    </td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <h5 class="modal-title pb-2 px-3" id="staticBackdropLabel">Exam Scores</h5>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">No</th>
                    <th class="align-middle text-center">Exam Name</th>
                    <th class="align-middle text-center">Score</th>
                </thead>
                <tbody>
                    @php $countExam = 0; $isUTS = false; $isUAS = false; @endphp
                    @foreach ($examScores as $s)
                        @php $score += $s->score; $count += 1; $countExam += 1; @endphp
                        @if ($s->name == "UTS")
                            @php $isUTS = true; @endphp
                        @endif
                        @if ($s->name == "UAS")
                            @php $isUAS = true; @endphp
                        @endif
                        <tr>
                            <td class="align-middle text-center">{{ $countExam }}</td>
                            <td class="align-middle text-center">{{ $s->name }}</td>
                            <td class="align-middle text-center">{{ $s->score }}</td>
                        </tr>
                    @endforeach                
                   
                    @if ($countExam === 0)
                    <tr>
                        <td class="align-middle text-center">1</td>
                        <td class="align-middle text-center">UTS</td>
                        <td class="align-middle text-center">-</td>
                    </tr>
                    <tr>
                        <td class="align-middle text-center">2</td>
                        <td class="align-middle text-center">UAS</td>
                        <td class="align-middle text-center">-</td>
                    </tr>   
                    @endif

                    @if ($countExam > 0)
                        @if (!$isUTS)
                            <tr>
                                <td class="align-middle text-center">1</td>
                                <td class="align-middle text-center">UTS</td>
                                <td class="align-middle text-center">-</td>
                            </tr> 
                        @endif

                        @if (!$isUAS)
                        <tr>
                            <td class="align-middle text-center">2</td>
                            <td class="align-middle text-center">UAS</td>
                            <td class="align-middle text-center">-</td>
                        </tr> 
                        @endif
                    @endif

                </tbody>
            </table>
        </div>
        <h5 class="modal-title pb-2 px-3" id="staticBackdropLabel">Overall Score</h5>
        <div class="table-responsive-sm">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">Overall Score</th>
                    <th class="align-middle text-center">Minimum Score</th>
                </thead>
                <tbody>
                    @if ($countExam === 2 && $isAllAsgNotScored)
                        @if ( $score/$count > $classSubject->minimum_score)
                        <td class="align-middle text-center bg-success">  
                        @else
                        <td class="align-middle text-center bg-danger">
                        @endif
                            {{ round($score/$count) }}</td>
                        <td class="align-middle text-center">
                            {{ $classSubject->minimum_score }}</td></td>  
                    @else
                        <td class="align-middle text-center">
                        
                                -</td>
                            <td class="align-middle text-center">
                                {{ $classSubject->minimum_score }}</td></td>  
                    @endif
                </tbody>
            </table>
        </div>

    </div>

    @foreach($assignmentScores as $score)
    @if (!(strtotime($score->assignmentHeader->end_time) > time()))
    <div class="modal fade" id="notes{{ $score->id }}" tabindex="-1" aria-labelledby="notesModal"
        aria-hidden="true" data-bs-focus="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    @if ($score->notes == null) 
                    <h5>No Notes/Feedback</h5>
                    @else
                    {!! $score->notes !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</x-app>
@else
<x-app title="Scores - Learningku">
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
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('score.index', $classSubject->id ) }}">Scores</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view', $classSubject->id ) }}">Attendances</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('class-view-student', $classSubject->id ) }}">Students</a></li>
                        @endif
        
                        @if (auth()->user()->role->name == 'Student')
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forums</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('score.index', $classSubject->id ) }}">Scores</a></li>
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
                                        <a href="{{ route('score.show', ['classSubjectId' => $classSubject->id, 'studentId' => $student->studentId]) }}"
                                            class="btn btn-primary text-white">
                                            Show Scores
                                        </a>
                                    </td>
                                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>
@endif

