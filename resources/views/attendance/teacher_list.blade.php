<x-app title="Attendance List - Teacher">
    <x-slot name="navbar"></x-slot>

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
    
        <nav class="navbar navbar-expand-md navbar-fixed-top navbar-light main-nav card shadow-sm border-0 mb-3" style="background-color: #fff;">
            <div class="container">
                <ul class="nav navbar-nav mx-auto">
                    @if (auth()->user()->role == 'Teacher')
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.index', $class->id)}}">Material</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view-teacher-list', $class->id ) }}">Daily Attendance</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('thread.index', $class->id ) }}">Forum</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $class->id ) }}">Assignment</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.manage', $class->id ) }}">Score</a></li>
                    @endif
    
                    @if (auth()->user()->role == 'Student')
                        <li class="nav-item"><a class="nav-link" style="color: black" href="#">Material</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view-student-list', $class->id ) }}">Attendances</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('thread.index', $class->id ) }}">Forum Discussion</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $class->id ) }}">Assignment</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index', $class->id ) }}">Score</a></li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>

    <div id="content" class="container my-5">
        <h3 class="fw-bold">Attendance List - {{ $class->name }}</h3>
        <a href="{{ route('attendance.view-create',$class->id) }}" class="btn btn-primary text-white mb-3">Add Today
            Attendance</a>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">ID</th>
                    <th class="align-middle text-center">Date</th>
                    <th class="align-middle text-center">Class</th>
                    <th class="align-middle text-center">Actions</th>
                </thead>
                <tbody>
                    @foreach($attendances as $attendance)
                    <tr>
                        <td class="align-middle text-center">{{ $attendance->id }}</td>
                        <td class="align-middle text-center">{{ date_format(date_create($attendance->date),"d F Y") }}
                        </td>
                        <td class="align-middle text-center">{{ $attendance->class->name }}</td>
                        <td class="align-middle text-center">
                            <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                                data-bs-target="#detail-{{ $attendance->id }}">
                                Details
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>

@foreach($attendances as $attendance)
<div class="modal fade" id="detail-{{ $attendance->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Attendance Detail - {{ $attendance->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                            <th class="align-middle text-center">No</th>
                            <th class="align-middle text-center">Student Name</th>
                            <th class="align-middle text-center">Status</th>
                        </thead>
                        <tbody>
                            <h5>Date: {{ date_format(date_create($attendance->date),"d F Y") }}</h5>
                            @foreach($attendance->details as $index => $detail)
                            <tr>
                                <td class="align-middle text-center">
                                    {{ $index+1 }}</td>
                                <td class="align-middle text-center">
                                    {{ $detail->student->name }}</td>

                                @if($detail->is_attend == 1)
                                <td class="align-middle text-center bg-success text-white">
                                    Present
                                </td>
                                @else
                                <td class="align-middle text-center bg-danger text-white">
                                    Absent
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
