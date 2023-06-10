@if(empty($classDetails))
    <x-app  title="Students - Learningku">
     
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
                        <h2 class="fw-bold">Students</h2>
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
             window.location.href = "/student/" + $(this).attr("data-id");
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
    <x-app title="Students - Learningku">
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
                                <h2 class="fw-bold">Subject {{ $classDetails->first()->name }}</h2>
                                <h5 class="pb-2">Teacher: {{ $classDetails->first()->teacherName }} - {{ $classDetails->first()->teacherNuptk }}</h5>
                                <h5><span class="fa-stack small pb-4"><i class="fas fa-circle fa-stack-2x text-orange"></i><i class="fas fa-home fa-stack-1x fa-2xs fa-inverse text-white"></i></span> {{ $classDetails->first()->className }} - {{ $classDetails->first()->schoolYear }} {{ $classDetails->first()->semester }} <span class="fa-stack small pb-4"><i class="fas fa-circle fa-stack-2x text-orange"></i><i class="fas fa-user fa-stack-1x fa-2xs fa-inverse text-white"></i></span> Homeroom Teacher: {{ $classDetails->first()->homeRoomTeacherName }} - {{ $classDetails->first()->homeRoomTeacherNuptk }}</h5>
                            </div>           
                        </div>
                    </div>
                </div>
            </section>
    
            <nav class="" style="font-size:1.25rem">
                {{-- <div class="container"> --}}
                    <ul class="nav nav-tabs">
                        @if (auth()->user()->role->name == 'Teacher')
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.index', $classDetails->first()->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classDetails->first()->id ) }}">Forums</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classDetails->first()->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index-teacher', $classDetails->first()->id ) }}">Scores</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view-teacher', $classDetails->first()->id ) }}">Attendances</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('class-view-student', $classDetails->first()->id ) }}">Students</a></li>
                        @endif
        
                        @if (auth()->user()->role->name == 'Student')
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.index', $classDetails->first()->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classDetails->first()->id ) }}">Forum Discussions</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classDetails->first()->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index-student', $classDetails->first()->id ) }}">Scores</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view-student', $classDetails->first()->id ) }}">Attendances</a></li>
                        @endif
                    </ul>
                {{-- </div> --}}
            </nav>
        </div>
    </section>
 
     <div id="content" class="container my-3">
          <div class="table-responsive pt-2">
               <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                         <th class="align-middle text-center">No</th>
                         <th class="align-middle text-center">NISN</th>
                         <th class="align-middle text-center">Student Name</th>
                    </thead>
                    <tbody>
                         @foreach ($classDetails->unique('studentId') as $index=>$student)
                              <tr>
                                   <td class="align-middle text-center">{{$index+1}}</td>
                                   <td class="align-middle text-center">{{$student->nisn}}</td>
                                   <td class="align-middle text-center">{{$student->studentName}}</td>
                              </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div>
 

 </x-app>
 @endif