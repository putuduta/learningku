<x-app title="Attendance List - Teacher">
    <x-slot name="navbar"></x-slot>

    <section id="headerClassSubject">
        <div id="content" class="container pt-5 mt-5">
            <div class="mb-3">
                <span class="fa-stack fa-md ms-n1">
                    <i class="fas fa-circle fa-stack-2x text-orange"></i>
                    <a href="{{ url()->previous() }}" class="fas fa-arrow-left fa-stack-1x fa-inverse text-light" style="text-decoration: none;"></a>
                </span>
            </div>

            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-10">
                            <h1 class="fw-bold">Mata Pelajaran {{ $classSubject->name }}</h1>
                            <h3>Kelas {{ $classSubject->className }} - {{ $classSubject->schoolYear }} {{ $classSubject->semester }}</h3>
                            <h5>Guru Pengajar {{ $classSubject->teacherName }} </h5>
                        </div>           
                    </div>
                </div>
            </div>
    
            <nav class="" style="font-size:1.25rem">
                {{-- <div class="container"> --}}
                    <ul class="nav nav-tabs">
                        @if (auth()->user()->role->name == 'Teacher')
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.view-teacher', $classSubject->id)}}">Material</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('thread.index', $classSubject->id ) }}">Forum</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignment</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.manage', $classSubject->id ) }}">Score</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('attendance.view-teacher-list', $classSubject->id ) }}">Daily Attendance</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('class-view-student', $classSubject->id ) }}">Students</a></li>
                        @endif
        
                        @if (auth()->user()->role->name == 'Student')
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.view-student', $classSubject->id)}}">Material</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('thread.index', $classSubject->id ) }}">Forum Discussion</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignment</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index', $classSubject->id ) }}">Score</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('attendance.view-student-list', $classSubject->id ) }}">Attendances</a></li>
                        @endif
                    </ul>
                {{-- </div> --}}
            </nav>
        </div>
    </section>



    <div id="content" class="container my-3">
        <div class="text-end">
            <a href="{{ route('attendance.view-create',$classSubject->id) }}" class="btn btn-primary text-white mb-3">Add Today
                Attendance</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">ID</th>
                    <th class="align-middle text-center">Date</th>
                    <th class="align-middle text-center">Class</th>
                    <th class="align-middle text-center">Subject</th>
                    <th class="align-middle text-center">Actions</th>
                </thead>
                <tbody>
                    @foreach($attendances as $attendance)
                    <tr>
                        <td class="align-middle text-center">{{ $attendance->id }}</td>
                        <td class="align-middle text-center">{{ date_format(date_create($attendance->date),"d F Y") }}
                        </td>
                        <td class="align-middle text-center">{{ $attendance->className }}</td>
                        <td class="align-middle text-center">{{ $attendance->subjectName }}</td>
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
