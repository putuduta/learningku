<x-app title="Forum Thread List - Learningku">
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
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.manage', [0, $class->id] ) }}">Score</a></li>
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
        <h3 class="fw-bold">Forum Thread List</h3>
        <hr>
        <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            Create New Thread
        </button>
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
                            <a href="{{ route('thread.show', ['threadId' => $thread->id, 'classId' => $class->id]) }}" class="btn btn-primary text-white">
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
                        <input type="hidden" name="class_id" value="{{ $class->id }}">
                        <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
