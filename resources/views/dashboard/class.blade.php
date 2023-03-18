<x-app title="{{ $class->name }} - Learningku">

    <style>
        .title-line {
            width: 80px;
            height: 3px;
            background: black;
            margin: 0 auto;
        }
    </style>

    <div id="content" class="container pt-5 mt-5">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body m-3">
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <h1 class="fw-bold">{{ $class->name }} - {{ $class->semester }}</h1>
                        <p>{{ $class->description }}</p>
                        <p>Wali Kelas {{ $class->homeroomTeacherName }}</p>
                    </div>           
                </div>
                <hr>
            </div>
        </div>

        <div class="pt-2 pb-2">
            <h2 class="text-dark text-center pb-3 pt-2">Class Subjects</h2>
            <div class="title-line"></div>
        </div>


        <div class="row justify-content-md-start mt-3 row-cols-sm-auto" style="margin-left: 0 !important;margin-right: 0 !important;">
            @foreach ($subjects as $subject)
                <div class="card shadow-sm border-0">
                    <a href="{{ route('material.view-student', $subject->id)}}" style="text-decoration:none;">
                        <div class="card-body m-2">
                            <div class="row align-items-center">
                                <div class="col-md-20">
                                    <h3 class="fw-bold">{{ $subject->name }}</h3>
                                    <p>Guru: {{ $subject->teacherName }}</p>
                                </div>           
                            </div>
                        </div>
                    </a>       
                </div>     
            @endforeach
        </div>
    
        {{-- <nav class="navbar navbar-expand-md navbar-fixed-top navbar-light main-nav card shadow-sm border-0 mb-3" style="background-color: #fff;">
            <div class="container">
                <ul class="nav navbar-nav mx-auto">
                    @if (auth()->user()->role == 'Teacher')
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.view-teacher', $class->id)}}">Material</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view-teacher-list', $class->id ) }}">Daily Attendance</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('thread.index', $class->id ) }}">Forum</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $class->id ) }}">Assignment</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.manage', $class->id ) }}">Score</a></li>
                    @endif
    
                    @if (auth()->user()->role == 'Student')
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.view-student', $class->id)}}">Material</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view-student-list', $class->id ) }}">Attendances</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('thread.index', $class->id ) }}">Forum Discussion</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $class->id ) }}">Assignment</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index', $class->id ) }}">Score</a></li>
                    @endif
                </ul>
            </div>
        </nav> --}}
    </div>
</x-app>
