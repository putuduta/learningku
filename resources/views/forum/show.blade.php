<x-app title="Forum Detail - Learningku">
    <x-slot name="navbar"></x-slot>

    <div id="content" class="container py-5 my-5">
        <div class="mb-3">
            <span class="fa-stack fa-md ms-n1">
                <i class="fas fa-circle fa-stack-2x text-orange"></i>
                <a href="{{ route('forum.index', $classSubject->class_subject_id ) }}" class="fas fa-arrow-left fa-stack-1x fa-inverse text-light" style="text-decoration: none;"></a>
            </span>
        </div>
        {{-- <a href="{{ route('forum.index', $classSubject->id) }}" class="btn btn-primary text-white mb-3">Back to forum list</a> --}}
        <div class="card shadow-sm border-0">
            <div class="card-body my-2">
                <h3 class="fw-bold">{{ $forum->title }}</h3>
                <p>
                    Subject {{ $classSubject->name }}
                    <br>
                    Created at  {{ date_format(date_create($forum->created_at),"d F Y H:i") }}</p>
                <hr>
                <h5 class="fw-bold">{{ $forum->user->name }} 
                    <br>
                    <span class="smallFont" style="font-weight: normal !important;">
                        @if ($forum->user->role->name == 'Student')
                                NISN: {{ $forum->user->user_code }}
                        @else 
                                NUPTK: {{ $forum->user->user_code }}
                        @endif
                    </span>
                </h5>
     
             
                <p>{!! $forum->description !!}
                </p>
                <a href="/storage/forum/{{ $forum->file }}" target="_blank" download="">{{ $forum->file }}</a>
                <div class="d-flex justify-content-start mt-3">
                    <div class="mx-1">
                        <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                            data-bs-target="#createReply">
                            Reply
                        </button>
                    </div>
                    <div class="mx-1">
                        @if($forum->user_id == auth()->user()->user_id)
                            <button type="button" class="btn btn-info text-white" data-bs-toggle="modal"
                            data-bs-target="#editThread">
                            Edit Forum
                        </button>
                        @endif
                    </div>
                </div>

                <div class="modal fade" id="editThread" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" data-bs-focus="false">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Forum</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('forum.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="text" class="form-control" name="forum_id" id="forum_id"
                                    value="{{ $forum->forum_id }}" hidden>
                                    <input type="text" class="form-control" name="old_file" id="old_file"
                                    value="{{ $forum->file }}" hidden>
                                    <div class="my-3">
                                        <label for="title" class="form-label">Title <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="title" id="title" required
                                            value="{{ $forum->title }}">
                                    </div>
                                    <div class="my-3">
                                        <label for="description" class="form-label">Description <span class="required">*</span></label>
                                        <textarea name="description" id="body" cols="30" rows="10" class="form-control"
                                            >{{ $forum->description }}</textarea>
                                    </div>
                                    <div class="my-3">
                                        <label for="file" class="form-label">Attached File</label>
                                        <input class="form-control" name="file" type="file" id="file"
                                            value="{{ $forum->file }}">
                                    </div>
                                    <div class="d-grid">
                                        @method('put')
                                        <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <hr>
        <h5 class="fw-bold mt-3 ms-2">{{ count($forum->replies) }} replies</h5>
        @foreach ($forum->replies as $reply)
        <div class="card shadow-sm border-0 my-3">
            <div class="card-body my-2">
                <h5 class="fw-bold">{{ $reply->user->name }}
                    <br>
                    <span class="smallFont" style="font-weight: normal !important;">
                        @if ($reply->user->role->name == 'Student')
                            NISN: {{ $reply->user->user_code }}
                        @else 
                            NUPTK: {{ $reply->user->user_code }}
                        @endif
                    </span>
                    <br>
                    <span class="smallFont" style="font-weight: normal !important;">Created at  {{ date_format(date_create($reply->created_at),"d F Y H:i") }}</p></span>
                </h5>
                <p>{!! $reply->description !!}
                </p>

                @if($reply->file)
                <a href="/storage/forum/{{ $reply->file }}" class="btn btn-secondary text-white" target="_blank"
                    download="">{{ $reply->file }}</a>
                @endif

                @if($reply->user_id == auth()->user()->user_id)
                <div class="d-flex mt-3 justify-content-start my-1">
                    <div class="mx-1">
                        <button type="button" class="btn btn-info text-white" data-bs-toggle="modal"
                            data-bs-target="#editReply-{{ $reply->reply_forum_id }}">
                            Edit Reply
                        </button>
                    </div>

                    <div class="mx-1">
                        <button type="button" class="btn btn-danger text-white"
                            data-bs-toggle="modal"
                            data-bs-target="#delete-{{ $reply->reply_forum_id }}">
                            Delete
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    @foreach ($forum->replies as $reply)
        <div class="modal fade show pr-0" style="z-index: 9999;" id="delete-{{ $reply->reply_forum_id }}"
        tabindex="-1" role="dialog" aria-labelledby="alertTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-20 border-0">
                    <div class="modal-header border-bottom-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-12 mb-3 text-center">
                                <span class="fa-stack fa-4x">
                                    <i class="fas fa-circle fa-stack-2x text-danger"></i>
                                    <i class="fas fa-exclamation-triangle fa-stack-1x fa-inverse"></i>
                                </span>
                                </div>
                                <div class="col-12 my-2 text-center">
                                <h4 class="font-weight-bold">Are you sure want to delete this data?</h4>

                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-light text-dark justify-content-between mx-2"
                                        data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                    <form action="{{ route('reply-forum.destroy', $reply->reply_forum_id) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger text-white justify-content-between">
                                                Yes, delete it
                                        </button>
                                    </form>
                                </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach($forum->replies as $reply)
    <div class="modal fade" id="editReply-{{ $reply->reply_forum_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-focus="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Reply Forum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reply-forum.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="text" class="form-control" name="reply_forum_id" id="reply_forum_id"
                        value="{{ $reply->reply_forum_id }}" hidden>
                        <input type="text" class="form-control" name="old_file" id="old_file"
                        value="{{ $reply->file }}" hidden>
                        <div class="my-3">
                            <label for="description" class="form-label">Description <span class="required">*</span></label>
                            <textarea name="description" id="bodyEditReply-{{ $reply->reply_forum_id }}" cols="30" rows="10" class="form-control"
                                >{{ $reply->description }}</textarea>
                        </div>
                        <div class="my-3">
                            <label for="file" class="form-label">Attached File</label>
                            <input class="form-control" name="file" type="file" id="file"
                                value="{{ $reply->file }}">
                        </div>
                        <div class="d-grid">
                            @method('put')
                            <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Modal -->
    <div class="modal fade" id="createReply" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-focus="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Reply Forum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reply-forum.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="my-3">
                            <label for="description" class="form-label">Description <span class="required">*</span></label>
                            <textarea name="description" id="bodyForum" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="my-3">
                            <label for="file" class="form-label">Attached File</label>
                            <input class="form-control" name="file" type="file" id="file">
                        </div>
                        <input type="hidden" name="forum_id" value="{{ $forum->forum_id }}">
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

    var replies = {!! json_encode($forum->replies->toArray()) !!};
    replies.forEach(function(item) {
        ClassicEditor
            .create(document.querySelector('#bodyEditReply-' + item.reply_forum_id))
            .catch(error => {
                console.error(error);
        });
    });

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
