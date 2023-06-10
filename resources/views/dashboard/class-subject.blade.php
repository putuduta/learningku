@if (auth()->user()->role->name == 'Student')
<x-app title="Class and Subject - Learningku">

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
                <h2 class="fw-bold">Class and Subject</h2>
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
<x-app  title="Class and Subject - Learningku">
     
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
                    <h2 class="fw-bold">Class and Subject</h2>
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