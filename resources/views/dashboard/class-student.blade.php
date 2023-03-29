<x-app title="{{ $class->name }} - Learningku">

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
    </style>

    <div id="content" class="container pt-5 mt-5">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <h1 class="fw-bold">{{ $class->name }} - {{ $class->semester }}</h1>
                        <p>{{ $class->description }}</p>
                        <p>Wali Kelas: {{ $class->homeroomTeacherName }} - {{ $class->teacherNuptk }}</p>
                    </div>           
                </div>
            </div>
        </div>

        <div class="pt-2 pb-2">
            <h2 class="text-dark text-center pb-3 pt-2">Class Subjects</h2>
            <div class="title-line"></div>
        </div>


        <div id="classAndSubjetTable" class="pt-3">
            <div class="row">
                 @foreach ($subjects as $subject)
                 <div class="col-md-4">
                      <div class="classSubject card shadow-sm border-0 mb-3 bg-white" data-id="{{$subject->id}}">
                           <div class="card-body">
                                <h3 class="fw-bold">{{ $subject->name }}</h3>
                                <p>Guru: {{ $subject->teacherName }} - {{ $subject->teacherNuptk }}</p>
                           </div>
                      </div>
                 </div>
                 @endforeach
            </div>
       </div>
    </div>
</x-app>

<script>

    $(".classSubject").on('click', function (e) {
         event.preventDefault();
         window.location.href = "/material/index/" + $(this).attr("data-id");
    });
</script>