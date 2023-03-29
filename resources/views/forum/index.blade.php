<x-app title="Forums - Learningku">
    <style>
        .fa-stack.small { font-size: 0.5em; }
        i { vertical-align: middle; }
    </style>
    <x-slot name="navbar"></x-slot>

    <section id="headerClassSubject">
        <div id="content" class="container pt-5 mt-5">
            <section id="headerClassDetail">
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
                                <h2 class="fw-bold">Mata Pelajaran {{ $classSubject->name }}</h2>
                                <h5 class="pb-2">Guru Pengajar: {{ $classSubject->teacherName }} - {{ $classSubject->teacherNuptk }}</h5>
                                <h5><span class="fa-stack small pb-4"><i class="fas fa-circle fa-stack-2x text-orange"></i><i class="fas fa-home fa-stack-1x fa-2xs fa-inverse text-white"></i></span> {{ $classSubject->className }} - {{ $classSubject->schoolYear }} {{ $classSubject->semester }} <span class="fa-stack small pb-4"><i class="fas fa-circle fa-stack-2x text-orange"></i><i class="fas fa-user fa-stack-1x fa-2xs fa-inverse text-white"></i></span> Wali Kelas: {{ $classSubject->homeRoomTeacherName }} - {{ $classSubject->homeRoomTeacherNuptk }}</h5>
                            </div>           
                        </div>
                    </div>
                </div>
            </section>
            <nav class="" style="font-size:1.25rem">
                {{-- <div class="container"> --}}
                    <ul class="nav nav-tabs">
                        @if (auth()->user()->role->name == 'Teacher')
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forums</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.manage', $classSubject->id ) }}">Assignments Score</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view', $classSubject->id ) }}">Attendances</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('class-view-student', $classSubject->id ) }}">Students</a></li>
                        @endif
        
                        @if (auth()->user()->role->name == 'Student')
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forum Discussions</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index', $classSubject->id ) }}">Assignments Score</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view', $classSubject->id ) }}">Attendances</a></li>

                        @endif
                    </ul>
                {{-- </div> --}}
            </nav>
        </div>
    </section>

    <div id="content" class="container my-3">
        <div class="text-end">
            <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
                data-bs-target="#exampleModal" data-bs-focus="false">
                Create New Forum
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
                    @foreach($forums as $index=>$forum)
                    <tr>
                        <td class="align-middle text-center">{{ $index+1 }}</td>
                        <td class="align-middle text-center">{{ $forum->title }}</td>
                        <td class="align-middle text-center">{{ $forum->user->name }}</td>
                        <td class="align-middle text-center">
                            {{ date_format(date_create($forum->created_at),"d F Y H:i") }}
                        </td>
                        <td class="align-middle text-center">{{ count($forum->replies) }}</td>
                        @if($forum->user_id == auth()->user()->id)
                        <td class="align-middle text-center bg-info text-white">Creator</td>
                        @elseif(count($forum->replyAuthUser) > 0)
                        <td class="align-middle text-center bg-success text-white">Replied</td>
                        @else
                        <td class="align-middle text-center bg-danger text-white">Not Replied</td>
                        @endif
                        <td class="align-middle text-center">
                            <a href="{{ route('forum.show', ['forumId' => $forum->id, 'classSubjectId' => $classSubject->id]) }}" class="btn btn-primary text-white">
                                Show
                            </a>
                            @if($forum->user_id == auth()->user()->id)
                            <form action="{{ route('forum.destroy', $forum->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger text-white" onclick="return confirm('Are you sure?')">
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-focus="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Forum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('forum.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="my-3">
                        <label for="title" class="form-label">Title <span class="required">*</span></label>
                        <input type="text" class="form-control" name="title" id="title" required>
                    </div>
                    <div class="my-3">
                        <label for="body" class="form-label">Body <span class="required">*</span></label>
                        <textarea id="forumBody" name="body" id="body" cols="60" rows="20" class="form-control"></textarea>
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


<script>
    ClassicEditor
        .create( document.querySelector( '#forumBody' ) )
        .catch( error => {
            console.error( error );
        } );

        $('#exampleModal').modal( {
            focus: false
        });
</script>