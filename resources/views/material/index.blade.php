@if(empty($materials))
@if (auth()->user()->role->name == 'Student')
<x-app title="Materials - Learningku">

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
                <h2 class="fw-bold">Materials</h2>
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
         window.location.href = "/material/" + $(this).attr("data-id");
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
<x-app  title="Materials - Learningku">
     
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
                    <h2 class="fw-bold">Materials</h2>
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
         window.location.href = "/material/" + $(this).attr("data-id");
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
@endif
@else
<x-app title="Materials - Learningku">
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
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forums</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index-teacher', $classSubject->id ) }}">Scores</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view-teacher', $classSubject->id ) }}">Attendances</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('class-view-student', $classSubject->id ) }}">Students</a></li>
                        @endif
        
                        @if (auth()->user()->role->name == 'Student')
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forums</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index-student', $classSubject->id ) }}">Scores</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view-student', $classSubject->id ) }}">Attendances</a></li>
                        @endif
                    </ul>
                {{-- </div> --}}
            </nav>
        </div>
    </section>

    <div id="content" class="container my-3">
        {{-- <h3 class="fw-bold">Material List</h3>
        <hr> --}}
        @if (auth()->user()->role->name == 'Teacher')
            <div class="text-end">
                <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
                    data-bs-target="#newMaterial">
                    Create New Material
                </button>
            </div>
            @foreach($materials as $material)
            <div class="card mb-2" style="width: 100%">
                <div class="card-body">
                    <h5 class="card-title">{{ $material->title }}</h5>
                    <p class="card-text">{!! $material->description !!}</p>
                    <div class="left d-flex justify-content-between">
                        <div>
                            @if ($material->resource != null || $material->resource != "")                       
                                <div><a class="btn btn-success text-white" href="/storage/material/{{ $material->resource }}" target="_blank">Download File</a></div>
                            @endif
                        </div>
                        <div class="d-flex">
                            <div class="me-2">
                                <button type="button" class="btn btn-primary text-white justify-content-between" data-bs-toggle="modal"
                                data-bs-target="#updateMaterial{{ $material->material_id }}">
                                    Update
                                </button>
                            </div>
                            <div>
                                <button type="button" class="btn btn-danger text-white"
                                    data-bs-toggle="modal"
                                    data-bs-target="#delete-{{ $material->material_id }}">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif

        @foreach ($materials as $material)
            <div class="modal fade show pr-0" style="z-index: 9999;" id="delete-{{ $material->material_id }}"
            tabindex="-1" role="dialog" aria-labelledby="alertTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content rounded-20 border-0">
                        <div class="modal-header border-bottom-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-12 mb-3 text-center">
                                    <span class="fa-stack fa-4x">
                                        <i class="fas fa-circle fa-stack-2x text-danger"></i>
                                        <i class="fas fa-exclamation-triangle fa-stack-1x fa-inverse"></i>
                                    </span>
                                    </div>
                                    <div class="col-12 my-2 text-center">
                                    <h4 class="font-weight-bold">Are you sure want to delete this data?</h4>

                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-light text-dark justify-content-between mx-2"
                                            data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                        <form action="{{ route('material.delete', $material->material_id) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger text-white justify-content-between">
                                                    Yes, delete it
                                            </button>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach

        @if (auth()->user()->role->name == 'Student')
            @foreach($materials as $material)
            <div class="card mb-2" style="width: 100%">
                <div class="card-body">
                    <h2 class="card-title pb-3">{{ $material->title }}</h2>
                    {!! $material->description !!}
                    @if ($material->resource != null || $material->resource != "") 
                        <div class="pt-3"><a class="btn btn-primary text-white" href="/storage/material/{{ $material->resource }}" target="_blank">Download File</a></div>
                    @endif
                </div>
            </div>
            @endforeach
        @endif
    </div>
</x-app>

<div class="modal fade" id="newMaterial" tabindex="-1" aria-labelledby="newMaterialLabel"
    aria-hidden="true" data-bs-focus="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitLabel">Create New Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('material.create') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="my-3">
                        <label for="class_subject_id" class="form-label" hidden>Class Id</label>
                        <input value="{{ $classSubject->id }}" type="text" class="form-control" name="class_subject_id" id="class_subject_id" readonly required hidden>
                    </div>
                    <div class="my-3">
                        <label for="title" class="form-label">Title <span class="required">*</span></label>
                        <input type="text" class="form-control" name="title" id="title" required>
                    </div>
                    <div class="my-3">
                        <label for="description" class="form-label">Description <span class="required">*</span></label>
                        <textarea id="createDescription" name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="my-3">
                        <label for="resource" class="form-label">Resource</label>
                        <input type="file" class="form-control" name="file" id="file">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach($materials as $material)
    <div class="modal fade" id="updateMaterial{{ $material->material_id }}" tabindex="-1" aria-labelledby="updateMaterial"
        aria-hidden="true" data-bs-focus="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submitLabel">Update Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('material.update', $material) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="my-3">
                            <label for="class_subject_id" class="form-label" hidden>Class Id</label>
                            <input value="{{ $classSubject->id }}" type="text" class="form-control" name="class_subject_id" id="class_subject_id" readonly required hidden>
                        </div>
                        <div class="my-3">
                            <label for="title" class="form-label">Title <span class="required">*</span></label>
                            <input type="text" value="{{ $material->title }}" class="form-control" name="title" id="title" required>
                        </div>
                        <div class="my-3">
                            <label for="description" class="form-label">Description <span class="required">*</span></label>
                            <textarea id="updateDescription-{{ $material->material_id }}" name="description" value="{{ $material->description }}" cols="30" rows="10" class="form-control">{{ $material->description }}</textarea>
                        </div>
                        <div class="my-3">
                            <label for="resource" class="form-label">Resource</label>
                            <input type="file" class="form-control" name="file" id="file">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    ClassicEditor
        .create( document.querySelector( '#createDescription' ) )
        .catch( error => {
            console.error( error );
        } );

    var materials = {!! json_encode($materials->toArray()) !!};
    materials.forEach(function(item) {
        ClassicEditor
            .create(document.querySelector('#updateDescription-' + item.material_id))
            .catch(error => {
                console.error(error);
        });
    });

    $('.modal').modal( {
        focus: false
    });
    
</script>

@endif