<x-app title="Material List - Learningku">
    <x-slot name="navbar"></x-slot>

    <div id="content" class="container pt-5 mt-5">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body m-3">
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <h1 class="fw-bold">Mata Pelajaran {{ $classSubject->name }}</h1>
                        <h3>Kelas {{ $classSubject->className }} - {{ $classSubject->schoolYear }} {{ $classSubject->semester }}</h3>
                        <h5>Guru Pengajar {{ $classSubject->teacherName }} </h5> <p> {{ $classSubject->description }}</p>
                        <hr>
                    </div>           
                </div>
            </div>
        </div>
    
        <nav class="navbar navbar-expand-md navbar-fixed-top navbar-light main-nav card shadow-sm border-0 mb-3" style="background-color: #fff;">
            <div class="container">
                <ul class="nav navbar-nav mx-auto">
                    @if (auth()->user()->role->name == 'Teacher')
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.view-teacher', $classSubject->id)}}">Material</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view-teacher-list', $classSubject->id ) }}">Daily Attendance</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('thread.index', $classSubject->id ) }}">Forum</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignment</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.manage', $classSubject->id ) }}">Score</a></li>
                    @endif
    
                    @if (auth()->user()->role->name == 'Student')
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.view-student', $classSubject->id)}}">Material</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view-student-list', $classSubject->id ) }}">Attendances</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('thread.index', $classSubject->id ) }}">Forum Discussion</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignment</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index', $classSubject->id ) }}">Score</a></li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>

    <div id="content" class="container my-5">
        <h3 class="fw-bold">Material List</h3>
        <hr>
        @if (auth()->user()->role->name == 'Teacher')
            <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
                data-bs-target="#newMaterial">
                Create New Material
            </button>
            @foreach($materials as $material)
            <div class="card mb-2" style="width: 100%">
                <div class="card-body">
                    <h5 class="card-title">{{ $material->title }}</h5>
                    <p class="card-text">{{ $material->description }}</p>
                    <div class="left d-flex justify-content-between">
                        <div>
                            @if ($material->resource != null || $material->resource != "")                       
                                <a class="btn btn-success text-white" href="{{ route('material.download', $material->id)}}" target="_blank">Download</a>
                            @endif
                        </div>
                        <div class="d-flex">
                            <div class="me-2">
                                <button type="button" class="btn btn-primary text-white justify-content-between" data-bs-toggle="modal"
                                data-bs-target="#updateMaterial{{ $material->id }}">
                                    Update
                                </button>
                            </div>
                            <div>
                                <form action="{{ route('material.delete', $material->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger text-white">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif

        @if (auth()->user()->role->name == 'Student')
            @foreach($materials as $material)
            <div class="card mb-2" style="width: 100%">
                <div class="card-body">
                <h5 class="card-title">{{ $material->title }}</h5>
                <p class="card-text">{{ $material->description }}</p>
                <a class="btn btn-primary text-white" href="{{ $material->resource }}">link</a>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</x-app>

<div class="modal fade" id="newMaterial" tabindex="-1" aria-labelledby="newMaterialLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitLabel">Create New Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('material.create') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="my-3">
                        <label for="class_subject_id" class="form-label" hidden>Class Id</label>
                        <input value="{{ $classSubject->id }}" type="text" class="form-control" name="class_subject_id" id="class_subject_id" readonly required hidden>
                    </div>
                    <div class="my-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title" required>
                    </div>
                    <div class="my-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control" required></textarea>
                    </div>
                    <div class="my-3">
                        <label for="resource" class="form-label">Resource</label>
                        <input type="file" class="form-control" name="file" id="file">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach($materials as $material)
    <div class="modal fade" id="updateMaterial{{ $material->id }}" tabindex="-1" aria-labelledby="updateMaterial"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submitLabel">Update Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('material.update', $material->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="my-3">
                            <label for="class_subject_id" class="form-label" hidden>Class Id</label>
                            <input value="{{ $classSubject->id }}" type="text" class="form-control" name="class_subject_id" id="class_subject_id" readonly required hidden>
                        </div>
                        <div class="my-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" value="{{ $material->title }}" class="form-control" name="title" id="title" required>
                        </div>
                        <div class="my-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" value="{{ $material->description }}"  id="description" cols="30" rows="10" class="form-control" required>{{ $material->description }}</textarea>
                        </div>
                        <div class="my-3">
                            <label for="resource" class="form-label">Resource</label>
                            <input type="file" class="form-control" name="file" id="file">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach