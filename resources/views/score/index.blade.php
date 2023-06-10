@if (auth()->user()->role->name == 'Student')
@if(empty($assignmentScores))
<x-app title="Scores - Learningku">

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
                <h2 class="fw-bold">Scores</h2>
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
         window.location.href = "/score/student/" + $(this).attr("data-id");
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
<x-app title="Scores - Learningku">
    <style>
        .fa-stack.small { font-size: 0.5em; }
        i { vertical-align: middle; }
    </style>
    <x-slot name="navbar"></x-slot>

    <section id="headerClassSubject">
        <div id="content" class="container pt-5 mt-5">
            <div class="mb-3">
                <span class="fa-stack fa-md ms-n1">
                    <i class="fas fa-circle fa-stack-2x text-orange"></i>
                    <a href="javascript:history.back()" class="fas fa-arrow-left fa-stack-1x fa-inverse text-light" style="text-decoration: none;"></a>
                </span>
            </div>
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
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('score.index-teacher', $classSubject->id ) }}">Scores</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view-teacher', $classSubject->id ) }}">Attendances</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('class-view-student', $classSubject->id ) }}">Students</a></li>
                        @endif
        
                        @if (auth()->user()->role->name == 'Student')
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forums</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('score.index-student', $classSubject->id ) }}">Scores</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view-student', $classSubject->id ) }}">Attendances</a></li>
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
                        @if($s->assignment->class_subject_id == $classSubject->id)
                        @if (!(strtotime($s->assignment->end_time) > time()) && $s->score !== null)
                                @php $score += $s->score; $count += 1; @endphp
                                <tr>
                                    <td class="align-middle text-center">{{ $count }}</td>
                                    <td class="align-middle text-center">{{ $s->assignment->title }}</td>
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
                                    <td class="align-middle text-center">{{ $s->assignment->title }}</td>
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
    @if (!(strtotime($score->assignment->end_time) > time()))
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
@endif
@else
@if(empty($classDetails))
<x-app  title="Scores - Learningku">
     
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
                    <h2 class="fw-bold">Scores</h2>
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
                             <h8 class="pt-3">Teacher: {{ $classSubject->teacherName }} - {{ $classSubject->teacherNuptk }}</h8>
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
         window.location.href = "/score/teacher/" + $(this).attr("data-id");
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
                                                 '<h8 class="pt-3">Teacher: ' + item.teacherName + ' - ' + item.teacherNuptk + '</h8>' +
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
<x-app title="Scores - Learningku">
    <style>
        .fa-stack.small { font-size: 0.5em; }
        i { vertical-align: middle; }
    </style>
    <x-slot name="navbar"></x-slot>

    <section id="headerClassSubject">
        <div id="content" class="container pt-5 mt-5">
            <div class="mb-3">
                <span class="fa-stack fa-md ms-n1">
                    <i class="fas fa-circle fa-stack-2x text-orange"></i>
                    <a href="javascript:history.back()" class="fas fa-arrow-left fa-stack-1x fa-inverse text-light" style="text-decoration: none;"></a>
                </span>
            </div>
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
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('score.index-teacher', $classSubject->id ) }}">Scores</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view-teacher', $classSubject->id ) }}">Attendances</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('class-view-student', $classSubject->id ) }}">Students</a></li>
                        @endif
        
                        @if (auth()->user()->role->name == 'Student')
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forums</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('score.index-student', $classSubject->id ) }}">Scores</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view-student', $classSubject->id ) }}">Attendances</a></li>
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
                    @foreach($classDetails as $index => $student)
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
@endif
