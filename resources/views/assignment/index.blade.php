<x-app title="Assignment List - Learningku">
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
        </nav>
    </div>

    <div id="content" class="container my-5">
        <h3 class="fw-bold">Assignment List</h3>
        <hr>
        @if (auth()->user()->role == 'Teacher')
            <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
                data-bs-target="#newAssignment">
                Create New Assignment
            </button>
        @endif
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">No</th>
                    <th class="align-middle text-center">Title</th>
                    <th class="align-middle text-center">Deadline</th>
                    @if (auth()->user()->role == 'Student')
                        <th class="align-middle text-center">Status</th>
                    @endif
                    <th class="align-middle text-center">Action</th>
                </thead>
                <tbody>
                    @foreach ($assignments as $index => $assignment)
                        <tr>
                            <td class="align-middle text-center">{{ $index + 1 }}</td>
                            <td class="align-middle text-center">{{ $assignment->title }}</td>
                            <td class="align-middle text-center">
                                {{ date_format(date_create($assignment->end_time), 'd F Y H:i') }}
                            </td>
                            @if (auth()->user()->role == 'Student')
                                @if (count($assignment->submissionUser) > 0)
                                    <td class="align-middle text-center bg-success text-white">Submitted</td>
                                @else
                                    <td class="align-middle text-center bg-danger text-white">Not Submitted</td>
                                @endif
                            @endif
                            <td class="align-middle text-center">
                                <a href="/storage/assignment/{{ $assignment->file }}" download
                                    class="btn btn-success text-white">
                                    Download
                                </a>
                                @if (auth()->user()->role == 'Student')
                                    @if (strtotime($assignment->end_time) > time())
                                        <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                                            data-bs-target="#submit-{{ $assignment->id }}">
                                            Add Submission
                                        </button>
                                    @endif
                                    <button type="button" class="btn btn-dark text-white" data-bs-toggle="modal"
                                        data-bs-target="#history-{{ $assignment->id }}">
                                        History
                                    </button>
                                @elseif(auth()->user()->role == 'Teacher')
                                    <a href="{{ route('assignment.showDetails', ['assignmentId' => $assignment->id, 'classId' => $class->id]) }}"
                                        class="btn btn-primary text-white">
                                        Show Detail
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>

<!-- Modal -->
@if (auth()->user()->role == 'Teacher')
    <div class="modal fade" id="newAssignment" tabindex="-1" aria-labelledby="newAssignmentLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newAssignmentLabel">Create New Assignment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('assignment.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="my-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>
                        <div class="my-3">
                            <label for="body" class="form-label">Deadline</label>
                            <input type="datetime-local" class="form-control" name="end_time" id="end_time" required>
                        </div>
                        <div class="my-3">
                            <label for="file" class="form-label">Assignment File</label>
                            <input class="form-control" name="file" type="file" id="file">
                        </div>
                        <div class="d-grid">
                            <input type="hidden" name="class_id" value="{{ $class->id }}">
                            <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

@if (auth()->user()->role == 'Student')
    @foreach ($assignments as $assignment)
        <div class="modal fade" id="submit-{{ $assignment->id }}" tabindex="-1" aria-labelledby="submitLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="submitLabel">Submit Assignment - {{ $assignment->title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('assignment.submit', $assignment) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="my-3">
                                <label for="file" class="form-label">Submission File</label>
                                <input class="form-control" name="file" type="file" id="file">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="history-{{ $assignment->id }}" tabindex="-1" aria-labelledby="historyLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="historyLabel">Submission History - {{ $assignment->title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (count($assignment->submissionUser) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="table-dark">
                                        <th class="align-middle text-center">No</th>
                                        <th class="align-middle text-center">File Name</th>
                                        <th class="align-middle text-center">Submission Time</th>
                                        <th class="align-middle text-center">Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($assignment->submissionUser as $index => $submission)
                                            <tr>
                                                <td class="align-middle text-center">{{ $index + 1 }}</td>
                                                <td class="align-middle text-center">{{ $submission->file }}</td>
                                                <td class="align-middle text-center">
                                                    {{ date_format(date_create($submission->created_at), 'd F Y H:i') }}
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="/storage/assignment/{{ $submission->file }}" download
                                                        class="btn btn-success text-white">
                                                        Download
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <h5 class="text-center">No Data</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
