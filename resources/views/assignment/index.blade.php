@if(empty($assignments))
@if (auth()->user()->role->name == 'Student')
<x-app title="Assignments - Learningku">

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
                <h2 class="fw-bold">Assignments</h2>
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
         window.location.href = "/assignment/" + $(this).attr("data-id");
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
<x-app  title="Assignments - Learningku">
     
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
                    <h2 class="fw-bold">Assignments</h2>
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
                             <h8 class="pt-3">Teacher: {{ $classSubject->teacherName }} - {{ $classSubject->teacherNuptk }}</h8><br>
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
         window.location.href = "/assignment/" + $(this).attr("data-id");
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
                                                 '<h8 class="pt-3">Teacher: ' + item.teacherName + ' - ' + item.teacherNuptk + '</h8><br>' +
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
@endif
@else
<x-app title="Assignments - Learningku">
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
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index-teacher', $classSubject->id ) }}">Scores</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view-teacher', $classSubject->id ) }}">Attendances</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('class-view-student', $classSubject->id ) }}">Students</a></li>
                        @endif
        
                        @if (auth()->user()->role->name == 'Student')
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forums</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index-student', $classSubject->id ) }}">Scores</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view-student', $classSubject->id ) }}">Attendances</a></li>
                        @endif
                    </ul>
                {{-- </div> --}}
            </nav>
        </div>
    </section>

    <div id="content" class="container my-3">
        @if (auth()->user()->role->name == 'Teacher')
        <div class="text-end">
            <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
                data-bs-target="#newAssignment">
                Create New Assignment
            </button>
        </div>
        @endif
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">No</th>
                    <th class="align-middle text-center">Title</th>
                    <th class="align-middle text-center">Deadline</th>
                    @if (auth()->user()->role->name == 'Student')
                        <th class="align-middle text-center">Status</th>
                    @endif
                    <th class="align-middle text-center">Action</th>
                </thead>
                <tbody>
                    @foreach ($assignments as $index => $assignment)
                        <tr>
                            <td class="align-middle text-center">{{ $index + 1 }}</td>
                            <td class="align-middle text-center">{{ $assignment->title }}</td>
                            <td class="align-middle text-center">
                                {{ date_format(date_create($assignment->end_time), 'd F Y H:i') }}
                            </td>
                            @if (auth()->user()->role->name == 'Student')
                                @if (count($assignment->submissionUser) > 0)
                                    <td class="align-middle text-center bg-success text-white">Submitted</td>
                                @else
                                    <td class="align-middle text-center bg-danger text-white">Not Submitted</td>
                                @endif
                            @endif
                            <td class="align-middle text-center">
                                <a href="/storage/assignment/{{ $assignment->file }}" download
                                    class="btn btn-success text-white">
                                    Download Assignment
                                </a>
                                @if (auth()->user()->role->name == 'Student')
                                    @if (strtotime($assignment->end_time) > time())
                                        <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                                            data-bs-target="#submit-{{ $assignment->assignment_header_id }}">
                                            Submit
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                                            data-bs-target="#submit-{{ $assignment->assignment_header_id }}" disabled>
                                            Submit
                                        </button>
                                    @endif
                                    <button type="button" class="btn btn-dark text-white" data-bs-toggle="modal"
                                        data-bs-target="#history-{{ $assignment->assignment_header_id }}">
                                        Submission History
                                    </button>
                                @elseif(auth()->user()->role->name == 'Teacher')
                                    @if (!(strtotime($assignment->end_time) > time()))
                                    <a href="{{ route('assignment.showDetails', ['assignmentId' => $assignment->assignment_header_id]) }}"
                                        class="btn btn-primary text-white">
                                        Show Submissions
                                    </a>
                                    <button type="button" class="btn btn-primary text-white justify-content-between" data-bs-toggle="modal"
                                    data-bs-target="#updateAssignment{{ $assignment->assignment_header_id }}" disabled>
                                        Update
                                    </button>
                                    @else 
                                    <button type="button" class="btn btn-primary text-white justify-content-between" disabled>
                                        Show Submissions
                                    </button>
                                    <button type="button" class="btn btn-primary text-white justify-content-between" data-bs-toggle="modal"
                                    data-bs-target="#updateAssignment{{ $assignment->assignment_header_id }}">
                                        Update
                                    </button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>

<!-- Modal -->
@if (auth()->user()->role->name == 'Teacher')
    <div class="modal fade" id="newAssignment" tabindex="-1" aria-labelledby="newAssignmentLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newAssignmentLabel">Create New Assignment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('assignment.add', $classSubject->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="my-3">
                            <input type="text" class="form-control" name="class_subject_id" id="class_subject_id" value={{$classSubject->id}} hidden>
                            <label for="title" class="form-label">Title <span class="required">*</span></label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>
                        <div class="my-3">
                            <label for="body" class="form-label">Deadline <span class="required">*</span></label>
                            <input type="datetime-local" class="form-control" name="end_time" id="end_time" min="<?=date('Y-m-d\Th:i')?>" required>
                        </div>
                        <div class="my-3">
                            <label for="file" class="form-label">Assignment File <span class="required">*</span></label>
                            <input class="form-control" name="file" type="file" id="file" required>
                        </div>
                        <div class="d-grid">
                            <input type="hidden" name="class_subject_id" value="{{ $classSubject->id }}">
                            <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($assignments as $assignment)
    <div class="modal fade" id="updateAssignment{{ $assignment->assignment_header_id }}" tabindex="-1" aria-labelledby="updateAssignmentLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateAssignmentLabel">Update Assignment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('assignment.update', $assignment) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="my-3">
                            <label for="title" class="form-label">Title <span class="required">*</span></label>
                            <input type="text" class="form-control" name="title" value="{{$assignment->title}}" id="title" required>
                        </div>
                        <div class="my-3">
                            <label for="body" class="form-label">Deadline <span class="required">*</span></label>
                            <input type="datetime-local" class="form-control" name="end_time" value="{{$assignment->end_time}}" id="end_time" min="<?=date('Y-m-d\Th:i')?>" required>
                        </div>
                        <div class="my-3">
                            <label for="file" class="form-label">Assignment File</label>
                            <input class="form-control" name="file" type="file" id="file">
                            <input class="form-control" name="assignment_file" type="text" id="assignment_file" value="{{$assignment->file}}" hidden>
                        </div>
                        <div class="d-grid">
                            <input type="hidden" name="class_subject_id" value="{{ $classSubject->id }}">
                            <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif

@if (auth()->user()->role->name == 'Student')
    @foreach ($assignments as $assignment)
        <div class="modal fade" id="submit-{{ $assignment->assignment_header_id }}" tabindex="-1" aria-labelledby="submitLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="submitLabel">Submit Assignment - {{ $assignment->title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('assignment.submit') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="my-3">
                                <label for="file" class="form-label">Submission File</label>
                                <input class="form-control" name="file" type="file" id="file">
                                <input class="form-control" name="assignment_header_id" type="text" id="assignment_header_id" value="{{ $assignment->assignment_header_id }}" hidden>
                                <input class="form-control" name="assignment_title" type="text" id="assignment_title" value="{{ $assignment->title }}" hidden>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="history-{{ $assignment->assignment_header_id }}" tabindex="-1" aria-labelledby="historyLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="historyLabel">Assignment Submission History - {{ $assignment->title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (count($assignment->submissionUser) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="table-dark">
                                        <th class="align-middle text-center">No</th>
                                        <th class="align-middle text-center">File Name</th>
                                        <th class="align-middle text-center">Submission Time</th>
                                        <th class="align-middle text-center">Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($assignment->submissionUser as $index => $submission)
                                            <tr>
                                                <td class="align-middle text-center">{{ $index + 1 }}</td>
                                                <td class="align-middle text-center">{{ $submission->file }}</td>
                                                <td class="align-middle text-center">
                                                    {{ date_format(date_create($submission->created_at), 'd F Y H:i') }}
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="/storage/assignment/submission/{{ $submission->file }}" download
                                                        class="btn btn-success text-white">
                                                        Download
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <h5 class="text-center">No Data</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

<script>
    function checkEndTime(id) {
        if (id == 1) {
            alert("The deadline is not over yet!");
            return false;
        } else {
            return true;
        }
    }
</script>
@endif