<x-app title="Forum Thread List - Learningku">
    <x-slot name="navbar"></x-slot>

    <div id="content" class="container py-5 my-5">
        <div class="mb-3">
            <span class="fa-stack fa-md ms-n1">
                <i class="fas fa-circle fa-stack-2x text-orange"></i>
                <a href="{{ route('thread.index', $classSubject->id ) }}" class="fas fa-arrow-left fa-stack-1x fa-inverse text-light" style="text-decoration: none;"></a>
            </span>
        </div>
        {{-- <a href="{{ route('thread.index', $classSubject->id) }}" class="btn btn-primary text-white mb-3">Back to thread list</a> --}}
        <div class="card shadow-sm border-0">
            <div class="card-body my-2">
                <h3 class="fw-bold">{{ $thread->title }}</h3>
                <p>
                    Mata Pelajaran {{ $classSubject->name }}
                    <br>
                    Created at {{ $thread->created_at }}</p>
                <hr>
                <h5 class="fw-bold">{{ $thread->user->name }}</h5>
                <p>{!! $thread->body !!}
                </p>
                <a href="/storage/forum/{{ $thread->file }}" target="_blank" download="">{{ $thread->file }}</a>
                <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                    data-bs-target="#createReply">
                    Reply
                </button>

                @if($thread->user_id == auth()->user()->id)
                <button type="button" class="btn btn-info text-white" data-bs-toggle="modal"
                    data-bs-target="#editThread">
                    Edit Thread
                </button>
                @endif

                <div class="modal fade" id="editThread" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" data-bs-focus="false">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Thread</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('thread.update',$thread->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="my-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" id="title" required
                                            value="{{ $thread->title }}">
                                    </div>
                                    <div class="my-3">
                                        <label for="body" class="form-label">Body</label>
                                        <textarea name="body" id="body" cols="30" rows="10" class="form-control"
                                            >{{ $thread->body }}</textarea>
                                    </div>
                                    <div class="my-3">
                                        <label for="file" class="form-label">Attached File</label>
                                        <input class="form-control" name="file" type="file" id="file"
                                            value="{{ $thread->file }}">
                                    </div>
                                    <div class="d-grid">
                                        @method('put')
                                        <button type="submit" class="btn btn-primary my-4 text-white">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <hr>
        <h5 class="fw-bold mt-3 ms-2">{{ count($thread->replies) }} replies</h5>
        @foreach ($thread->replies as $reply)
        <div class="card shadow-sm border-0 my-3">
            <div class="card-body my-2">
                <h5 class="fw-bold">{{ $reply->user->name }}</h5>
                <p>{!! $reply->body !!}
                </p>

                @if($reply->file)
                <a href="/storage/forum/{{ $reply->file }}" class="btn btn-secondary text-white" target="_blank"
                    download="">{{ $reply->file }}</a>
                @endif

                @if($reply->user_id == auth()->user()->id)
                <div class="mt-3">
                    <button type="button" class="btn btn-info text-white" data-bs-toggle="modal"
                        data-bs-target="#editReply">
                        Edit Reply
                    </button>

                    <form action="{{ route('reply-thread.destroy', $reply->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger text-white">
                            Delete
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>

        <div class="modal fade" id="editReply" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-focus="false">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Reply Thread</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('reply-thread.update',$reply->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="my-3">
                                <label for="body" class="form-label">Body</label>
                                <textarea name="body" id="bodyEditReply" cols="30" rows="10" class="form-control"
                                    >{{ $reply->body }}</textarea>
                            </div>
                            <div class="my-3">
                                <label for="file" class="form-label">Attached File</label>
                                <input class="form-control" name="file" type="file" id="file"
                                    value="{{ $reply->file }}">
                            </div>
                            <div class="d-grid">
                                @method('put')
                                <button type="submit" class="btn btn-primary my-4 text-white">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createReply" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-focus="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reply Thread</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reply-thread.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="my-3">
                            <label for="body" class="form-label">Body</label>
                            <textarea name="body" id="bodyForum" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="my-3">
                            <label for="file" class="form-label">Attached File</label>
                            <input class="form-control" name="file" type="file" id="file">
                        </div>
                        <input type="hidden" name="thread_id" value="{{ $thread->id }}">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app>


<script>
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#bodyForum' ) )
        .catch( error => {
            console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#bodyEditReply' ) )
        .catch( error => {
            console.error( error );
        } );

        $('#createReply').modal( {
            focus: false
        });

        $('#editReply').modal( {
            focus: false
        });

        $('#editThread').modal( {
            focus: false
        });
</script>
