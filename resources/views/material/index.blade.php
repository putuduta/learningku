<x-app title="Materials - Learningku">
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
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forums</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.manage', $classSubject->id ) }}">Assignments Score</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view', $classSubject->id ) }}">Daily Attendances</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('class-view-student', $classSubject->id ) }}">Students</a></li>
                        @endif
        
                        @if (auth()->user()->role->name == 'Student')
                            <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Materials</a></li>
                            <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forum Discussions</a></li>
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
        {{-- <h3 class="fw-bold">Material List</h3>
        <hr> --}}
        @if (auth()->user()->role->name == 'Teacher')
            <div class="text-end">
                <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
                    data-bs-target="#newMaterial">
                    Create New Material
                </button>
            </div>
            @foreach($materials as $material)
            <div class="card mb-2" style="width: 100%">
                <div class="card-body">
                    <h5 class="card-title">{{ $material->title }}</h5>
                    <p class="card-text">{!! $material->description !!}</p>
                    <div class="left d-flex justify-content-between">
                        <div>
                            @if ($material->resource != null || $material->resource != "")                       
                                <a class="btn btn-success text-white" href="{{ route('material.download', $material->id)}}" target="_blank">Download File</a>
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
                                    <button type="submit" class="btn btn-danger text-white" onclick="return confirm('Are you sure?')">
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
                    <h2 class="card-title pb-3">{{ $material->title }}</h2>
                    {!! $material->description !!}</p>
                    @if ($material->resource != null || $material->resource != "") 
                        <div class="pt-3"><a class="btn btn-primary text-white" href="{{ $material->resource }}">Download File</a></div>
                    @endif
                </div>
            </div>
            @endforeach
        @endif
    </div>
</x-app>

<div class="modal fade" id="newMaterial" tabindex="-1" aria-labelledby="newMaterialLabel"
    aria-hidden="true" data-bs-focus="false">
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
                        <textarea id="createDescription" name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
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
        aria-hidden="true" data-bs-focus="false">
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
                            <textarea id="updateDescription-{{ $material->id }}" name="description" value="{{ $material->description }}" cols="30" rows="10" class="form-control">{{ $material->description }}</textarea>
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

<script>
    ClassicEditor
        .create( document.querySelector( '#createDescription' ) )
        .catch( error => {
            console.error( error );
        } );

    var materials = {!! json_encode($materials->toArray()) !!};
    materials.forEach(function(item) {
        ClassicEditor
            .create(document.querySelector('#updateDescription-' + item.id))
            .catch(error => {
                console.error(error);
        });
    });

    $('.modal').modal( {
        focus: false
    });
    
</script>
