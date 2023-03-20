<x-app title="Forum Thread List - Learningku">
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
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('thread.index', $classSubject->id ) }}">Forum</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignment</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.manage', $classSubject->id ) }}">Score</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view-teacher-list', $classSubject->id ) }}">Daily Attendance</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('class-view-student', $classSubject->id ) }}">Students</a></li>
                        @endif
        
                        @if (auth()->user()->role->name == 'Student')
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.view-student', $classSubject->id)}}">Material</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('thread.index', $classSubject->id ) }}">Forum Discussion</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignment</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index', $classSubject->id ) }}">Score</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view-student-list', $classSubject->id ) }}">Attendances</a></li>

                        @endif
                    </ul>
                {{-- </div> --}}
            </nav>
        </div>
    </section>

    <div id="content" class="container my-3">
        <div class="text-end">
            <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                Create New Thread
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">No</th>
                    <th class="align-middle text-center">Title</th>
                    <th class="align-middle text-center">Created by</th>
                    <th class="align-middle text-center">Created at</th>
                    <th class="align-middle text-center">Total Replies</th>
                    <th class="align-middle text-center">Status</th>
                    <th class="align-middle text-center">Action</th>
                </thead>
                <tbody>
                    @foreach($threads as $index=>$thread)
                    <tr>
                        <td class="align-middle text-center">{{ $index+1 }}</td>
                        <td class="align-middle text-center">{{ $thread->title }}</td>
                        <td class="align-middle text-center">{{ $thread->user->name }}</td>
                        <td class="align-middle text-center">
                            {{ date_format(date_create($thread->created_at),"d F Y H:i") }}
                        </td>
                        <td class="align-middle text-center">{{ count($thread->replies) }}</td>
                        @if($thread->user_id == auth()->user()->id)
                        <td class="align-middle text-center bg-info text-white">Creator</td>
                        @elseif(count($thread->replyAuthUser) > 0)
                        <td class="align-middle text-center bg-success text-white">Replied</td>
                        @else
                        <td class="align-middle text-center bg-danger text-white">Not Replied</td>
                        @endif
                        <td class="align-middle text-center">
                            <a href="{{ route('thread.show', ['threadId' => $thread->id, 'classSubjectId' => $classSubject->id]) }}" class="btn btn-primary text-white">
                                Show
                            </a>
                            @if($thread->user_id == auth()->user()->id)
                            <form action="{{ route('thread.destroy', $thread->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger text-white">
                                    Delete
                                </button>
                            </form>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Thread</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('thread.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="my-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title" required>
                    </div>
                    <div class="my-3">
                        <label for="body" class="form-label">Body</label>
                        <textarea name="body" id="body" cols="30" rows="10" class="form-control" required></textarea>
                    </div>
                    <div class="my-3">
                        <label for="file" class="form-label">Attached File</label>
                        <input class="form-control" name="file" type="file" id="file">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="class_subject_id" value="{{ $classSubject->id }}">
                        <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
