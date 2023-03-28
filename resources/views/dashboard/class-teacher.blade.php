<x-app title="Teacher Classes - Learningku">
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
                   <h3>Classes</h3>
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

         <div id="classAndSubjetTable" class="row">
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
         </div>
    </div>
</x-app>

<script>

    $(".classSubject").on('click', function (e) {
         event.preventDefault();
         window.location.href = "/material/index/" + $(this).attr("data-id");
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
                             body = '<div class="col-md-4">' +
                                       '<div class="classSubject card shadow-sm border-0 mb-3 bg-light" data-id="' + item.id + '">' +
                                            '<div class="card-body">' +
                                                 '<h3 class="fw-bold">' + item.className + ' - ' + item.name + '</h3>' +
                                                 '<p>Guru: ' + item.teacherName + '</p>' +
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