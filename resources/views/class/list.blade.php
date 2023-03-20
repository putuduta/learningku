<x-app title="Class and Subject List - Learningku">
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
                    <h3>Classes and Subjects</h3>
                    <form id="formChooseSchoolYear" method="GET">
                         <div class="my-3">
                              <label for="school_year_id" class="form-label">School Year/Tahun Ajaran</label>
                              <select id="school_year_id" name="school_year_id" class="form-select" required>
                                   @foreach ($schoolYears as $schoolYear)
                                       <option value="{{$schoolYear->id}}">{{$schoolYear->year}} - {{$schoolYear->semester}}</option>
                                   @endforeach
                              </select>
                         </div>
                    </form>
               </div>
          </div>
          <hr>

          <div id="classAndSubjetTable" class="">
               <div class="row">
                    @foreach ($classAndSubjects as $classAndSubject)
                    <div class="col-md-4">
                         <div class="classSubject card shadow-sm border-0 mb-3 bg-light" data-id="{{$classAndSubject->id}}">
                              <div class="card-body">
                                   <h3 class="fw-bold">{{ $classAndSubject->className }} - {{ $classAndSubject->name }}</h3>
                                   <p>Guru: {{ $classAndSubject->teacherName }}</p>
                              </div>
                         </div>
                    </div>
                    @endforeach
                    <div class="col-md-4">
                         <div class="classSubject card shadow-sm border-0 mb-3 bg-light"  data-id="1">
                              <div class="card-body">
                                   <h3 class="fw-bold">Test</h3>
                                   <p>Guru: Tes</p>
                              </div>
                         </div>
                    </div>
                    <div class="col-md-4">
                         <div class="classSubject card shadow-sm border-0 mb-3 bg-light" data-id="1">
                              <div class="card-body">
                                   <h3 class="fw-bold">Test</h3>
                                   <p>Guru: Tes</p>
                              </div>
                         </div>
                    </div>
                    <div class="col-md-4">
                         <div class="classSubject card shadow-sm border-0 mb-3 bg-light" data-id="1">
                              <div class="card-body">
                                   <h3 class="fw-bold">Test</h3>
                                   <p>Guru: Tes</p>
                              </div>
                         </div>
                    </div>
     
               </div>
          </div>
     </div>
</x-app>

<script>

     $(".classSubject").on('click', function (e) {
          event.preventDefault();
          window.location.href = "/material/teacher-material/" + $(this).attr("data-id");
     });
     
     $("#school_year_id").on('change', function (e) {
          // Stop form from submitting normally
          event.preventDefault();

          $schoolYearId = $('#school_year_id').val();

          if ($schoolYearId != "" && $schoolYearId != null) {
               $.ajax({
                    type:"GET",
                    dataType: "json",
                    url:"/class/get-list/" + $schoolYearId,
                    success:function(data)
                    {

                         var body = '';
                         data.forEach(function(item) {
                              body = '<td class="align-middle text-center">' + item.id + '</td>' +
                              '<td class="align-middle text-center">' + item.className + '</td>' +
                              '<td class="align-middle text-center">' + item.name + '</td>' +
                              '<td class="align-middle text-center">' + item.teacherName + '</td>' +
                              '<td class="align-middle text-center"><a href="/class/student/' + item.classId +'" class="btn btn-success">Student List</a> <a href="/material/teacher-material/' + item.id +'" class="btn btn-warning">View Dashboard</a></td>'
                         });               

                          var table = '<table class="table table-hover table-bordered">'
                          + '<thead class="table-dark">'
                          + '<th class="align-middle text-center">ID</th>'
                          + ' <th class="align-middle text-center">Class</th>'
                          + ' <th class="align-middle text-center">Subject</th>'
                          + '  <th class="align-middle text-center">Teacher</th>'
                          + '    <th class="align-middle text-center" colspan="2">Action</th>'
                          + '</thead>'
                          + '<tbody> '
                          + '<tr>' + body + '</tr></tbody></table>';

                         $("#classAndSubjetTable").html(table);
                    }
               });                    
          }

     });
</script>