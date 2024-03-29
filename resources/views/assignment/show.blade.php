<x-app title="Assignment Show - Learningku">
    <x-slot name="navbar"></x-slot>

    <div id="content" class="container py-5 my-5">
        <div class="mb-3">
            <span class="fa-stack fa-md ms-n1">
                <i class="fas fa-circle fa-stack-2x text-orange"></i>
                <a href="{{ route('assignment.index', $assignmentScore->first()->classSubjectId)}}" class="fas fa-arrow-left fa-stack-1x fa-inverse text-light" style="text-decoration: none;"></a>
            </span>
        </div>
        <h3 class="fw-bold">Assignment Submissions - {{ $assignmentScore->first()->asgTitle }} - ({{ $assignmentScore->first()->classSubject }} - {{ $assignmentScore->first()->className }})</h3>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">No</th>
                    <th class="align-middle text-center">NISN</th>
                    <th class="align-middle text-center">Student Name</th>
                    <th class="align-middle text-center">Submission Time</th>
                    <th class="align-middle text-center">Score</th>
                    <th class="align-middle text-center">Action</th>
                </thead>
                <tbody>
                    @php($i = 1)
                    @foreach($assignmentScore as $score)
                        @php($tempStudentId = null)
                        @php($tempStudentScoreId = null)
                        @php($tempAsgCreatedAt = null)
                        @if($assignmentSubmissions->count() > 0)
                            @foreach($assignmentSubmissions as $assignment)
                                @if ($score->assignmentHeaderId == $assignment->assignmentId && $score->studentUserId == $assignment->studentUserId)
                                    @if ($score->score === 0 && $assignment->file === null)                                  
                                    <tr>
                                        <td class="align-middle text-center">{{ $i }}</td>
                                        <td class="align-middle text-center">{{ $score->nisn }}</td>
                                        <td class="align-middle text-center">{{ $score->studentName }}</td>
                                        <td class="align-middle text-center bg-danger text-white">
                                        Not Submitted
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $score->score }}
                                        </td>
                                        <td class="align-middle text-center">
                                            -
                                        </td>
                                    </tr>
                                    @else
                                    {{-- @if (($tempStudentId == $assignment->studentUserId && $assignment->createdAt == $tempAsgCreatedAt))
                                         --}}
                                    <tr>
                                        <td class="align-middle text-center">{{ $i }}</td>
                                        <td class="align-middle text-center">{{ $score->nisn }}</td>
                                        <td class="align-middle text-center">{{ $assignment->studentName }}</td>
                                        <td class="align-middle text-center bg-success text-white">
                                            {{ date_format(date_create($assignment->createdAt),"d F Y H:i") }}
                                        </td>
                                        <td class="align-middle text-center">
                                            @if (($score->score === null || $score->score === 0) && $assignment->file !== null)
                                                -
                                            @else
                                                {{ $score->score }}
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="/storage/assignment/submission/{{ $assignment->file }}" download
                                                class="btn btn-success text-white">
                                                Download Submission
                                            </a>
                                            @if (($score->score === null || $score->score === 0) && $assignment->file !== null)
                                                <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                                                    data-bs-target="#newScore{{ $assignment->assignmentId }}{{ $assignment->studentUserId }}">
                                                    Give Score
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                                                    data-bs-target="#updateScore{{ $assignment->assignmentId }}{{ $assignment->studentUserId }}">
                                                    Update Score
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    {{-- @endif --}}
                                    @endif
                                    @php($tempStudentId = $assignment->studentUserId)
                                    @php($tempAsgCreatedAt = $assignment->createdAt)
                                @else 
                                    @if ($score->score === 0 && ($tempStudentScoreId != $score->studentUserId))
                                    <tr>
                                        <td class="align-middle text-center">{{ $i }}</td>
                                        <td class="align-middle text-center">{{ $score->nisn }}</td>
                                        <td class="align-middle text-center">{{ $score->studentName }}</td>
                                        <td class="align-middle text-center bg-danger text-white">
                                        Not Submitted
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $score->score }}
                                        </td>
                                        <td class="align-middle text-center">
                                            -
                                        </td>
                                    </tr> 
                                    @php($tempStudentScoreId = $score->studentUserId)
                                    @endif
                                @endif
                            @endforeach
                        @else
                        <tr>
                            <td class="align-middle text-center">{{ $i }}</td>
                            <td class="align-middle text-center">{{ $score->nisn }}</td>
                            <td class="align-middle text-center">{{ $score->studentName }}</td>
                            <td class="align-middle text-center bg-danger text-white">
                            Not Submitted
                            </td>
                            <td class="align-middle text-center">
                                {{ $score->score }}
                            </td>
                            <td class="align-middle text-center">
                                -
                            </td>
                        </tr> 
                        @endif
                    @php($i++)
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>

@foreach($assignmentScore as $score)
<div class="modal fade" id="newScore{{ $score->assignmentHeaderId }}{{ $score->studentUserId }}" tabindex="-1" aria-labelledby="newScoreLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newAssignmentLabel">Give Score ({{$score->nisn}} - {{$score->studentName}})</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('score.store-assignment', $score) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="">
                        <label for="score" class="form-label">Score <span class="required">*</span></label>
                        <input type="number" class="form-control" name="score" id="score" min="0" max="100" required>
                    </div>
                    <div class="pt-2">
                        <label for="score" class="form-label">Notes/Feedback (Optional)</label>
                        <textarea name="notes" id="bodyNewScore{{ $score->assignmentHeaderId }}{{ $score->studentUserId }}" cols="20" rows="10" class="form-control"
                        ></textarea>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="score_id" value="{{ $score->assignment_score_id }}">
                        <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach($assignmentScore as $score)
<div class="modal fade" id="updateScore{{ $score->assignmentHeaderId }}{{ $score->studentUserId }}" tabindex="-1" aria-labelledby="newScoreLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newAssignmentLabel">Update Score ({{$score->nisn}} - {{$score->studentName}})</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('score.update-assignment', $score) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="">
                        <label for="score" class="form-label">Score <span class="required">*</span></label>
                        <input type="number" class="form-control" name="score" id="score" min="0" max="100" value="{{ $score->score }}" required>
                    </div>
                    <div class="">
                        <label for="score" class="form-label">Notes/Feedback (Optional)</label>
                        <textarea name="notes" id="bodyUpdateScore{{ $score->assignmentHeaderId }}{{ $score->studentUserId }}" cols="30" rows="10" class="form-control"
                        >{{ $score->notes }}</textarea>
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
    var scores = {!! json_encode($assignmentScore->toArray()) !!};
    scores.forEach(function(item) {
        console.log('#bodyNewScore' + item.assignmentHeaderId + item.studentUserId)
        ClassicEditor
            .create(document.querySelector('#bodyNewScore' + item.assignmentHeaderId + item.studentUserId))
            .catch(error => {
                console.error(error);
        });

        ClassicEditor
            .create(document.querySelector('#bodyUpdateScore' + item.assignmentHeaderId + item.studentUserId))
            .catch(error => {
                console.error(error);
        });
    });

    $('.modal').modal( {
        focus: false
    });
    
</script>