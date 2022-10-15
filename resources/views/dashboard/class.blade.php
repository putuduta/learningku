<x-app title="{{ $class->name }} - Learningku">

    <div id="content" class="container pt-5 mt-5">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body m-3">
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <h1 class="fw-bold">{{ $class->name }}</h1>
                        <p>{{ $class->description }}</p>
                        <hr>
                    </div>           
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-dark main-nav">
            <div class="container">
                <ul class="nav navbar-nav mx-auto">
                    @if (auth()->user()->role == 'Teacher')
                        <li class="nav-item"><a class="nav-link" href="#">Material</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('attendance.view-teacher-list') }}">Daily Attendance</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('thread.index') }}">Forum</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('assignment.index') }}">Assignment</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('score.manage', 0) }}">Score</a></li>
                    @endif

                    @if (auth()->user()->role == 'Student')
                        <li class="nav-item"><a class="nav-link" href="#">Material</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('attendance.view-student-list') }}">Attendances</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('thread.index') }}">Forum Discussion</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('assignment.index') }}">Assignment</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('score.index') }}">Score</a></li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>

    

</x-app>
