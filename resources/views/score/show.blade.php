<x-app title="Score Detail - Learningku">
    <x-slot name="navbar"></x-slot>

    <div id="content" class="container py-5 my-5">
        <h3 class="fw-bold">{{ $student->name }}'s score</h3>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">No</th>
                    <th class="align-middle text-center">Assignment Name</th>
                    <th class="align-middle text-center">Score</th>
                    <th class="align-middle text-center">Action</th>
                </thead>
                <tbody>
                    <div>
                        <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
                            data-bs-target="#newScore">
                            Give Score
                        </button>
                        <a href="{{ route('score.manage', $class) }}" class="btn btn-primary text-white mb-3">Back to Student List</a>

                    </div>

                    @foreach ($scores as $index => $s)
                        <tr>
                            <td class="align-middle text-center">{{ $index + 1 }}</td>
                            <td class="align-middle text-center">{{ $s->assignment_header->title }}</td>
                            <td class="align-middle text-center">{{ $s->score }}</td>
                            <td class="align-middle text-center">
                                <a href="{{ URL::to('/') }}/score/edit/{{ $class }}/{{ $s->id }}"
                                    class="btn btn-primary text-white">
                                    Edit Score
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>


<div class="modal fade" id="newScore" tabindex="-1" aria-labelledby="newScoreLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newAssignmentLabel">Create New Score</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('score.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="my-3">
                        <label for="score_name" class="form-label">Score Name</label>
                        <input type="text" class="form-control" name="score_name" id="score_name" required>
                    </div>
                    <div class="my-3">
                        <label for="score" class="form-label">Score</label>
                        <input type="number" class="form-control" name="score" id="score" required>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="class_id" value="{{ $class }}">
                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                        <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <div class="modal fade" id="editScore" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Score</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('score.update', $s->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="my-3">
                                        <label for="score_name" class="form-label">Score Name</label>
                                        <input type="text" class="form-control" name="score_name" id="score_name" required
                                            value="{{ $s->score_name }}">
                                    </div>
                                    <div class="my-3">
                                        <label for="score" class="form-label">Score</label>
                                        <input type="number" class="form-control" name="score" id="score" required
                                            value="{{ $s->score }}">
                                    </div>
                                    <div class="d-grid">
                                        @method('put')
                                        <button type="submit" class="btn btn-primary my-4 text-white">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
</div> --}}