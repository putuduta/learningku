<x-app title="Scores Show - Learningku">
    <x-slot name="navbar"></x-slot>

    <div id="content" class="container py-5 my-5">
        <div class="mb-3">
            <span class="fa-stack fa-md ms-n1">
                <i class="fas fa-circle fa-stack-2x text-orange"></i>
                <a href="{{ route('score.index-teacher', $classSubject->id)}}" class="fas fa-arrow-left fa-stack-1x fa-inverse text-light" style="text-decoration: none;"></a>
            </span>
        </div>
        <h3 class="fw-bold">Scores - ({{ $classSubject->studentName }} - {{ $classSubject->studentNisn }}) - ({{ $classSubject->name }} - {{ $classSubject->className }})</h3>
        <hr>
        <h5 class="modal-title pb-2" id="staticBackdropLabel">Assignment Scores</h5>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">No</th>
                    <th class="align-middle text-center">Assignment Name</th>
                    <th class="align-middle text-center">Score</th>
                    <th class="align-middle text-center">Action</th>
                </thead>
                <tbody>
                    @php $score = 0; $count = 0;$isAllAsgNotScored = true; @endphp
                    @foreach ($assignmentScores as $s)
                        @if ($s->user_id == $classSubject->studentId && $s->assignment->class_subject_id == $classSubject->id)
                            @if (!(strtotime($s->assignment->end_time) > time()) && $s->score !== null)
                            @php $score += $s->score; $count += 1; @endphp
                            <tr>
                                <td class="align-middle text-center">{{ $count }}</td>
                                <td class="align-middle text-center">{{ $s->assignment->title }}</td>
                                <td class="align-middle text-center">{{ $s->score }}</td>
                                <td class="align-middle text-center">
                                    <button type="button" class="btn btn-primary text-white"
                                        data-bs-toggle="modal"
                                        data-bs-target="#updateAssignmentScore-{{ $s->assignment_score_id }}">
                                        <i class='fas fa-pencil-alt'></i>
                                    </button>
                                </td>
                            </tr>
                            @elseif (!(strtotime($s->assignment->end_time) > time()) && $s->score === null)
                            @php $count += 1; $isAllAsgNotScored = false; @endphp
                            <tr>
                                <td class="align-middle text-center">{{ $count }}</td>
                                <td class="align-middle text-center">{{ $s->assignment->title }}</td>
                                <td class="align-middle text-center">-</td>
                                <td class="align-middle text-center">
                                    <button type="button" class="btn btn-primary text-white"
                                        data-bs-toggle="modal"
                                        data-bs-target="#newAssignmentScore-{{ $s->assignment_score_id }}">
                                        <i class='fas fa-pencil-alt'></i>
                                    </button>
                                </td>
                            </tr>
                            @endif
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <h5 class="modal-title pb-2" id="staticBackdropLabel">Exam Scores</h5>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">No</th>
                    <th class="align-middle text-center">Exam Name</th>
                    <th class="align-middle text-center">Score</th>
                    <th class="align-middle text-center">Action</th>
                </thead>
                <tbody>
                    @php $countExam = 0; $isUTS = false; $isUAS = false; @endphp
                    @foreach ($examScores as $s)
                        @if ($s->user_id == $classSubject->studentId)
                            @php $score += $s->score; $count += 1; $countExam += 1; @endphp
                            @if ($s->name == "UTS")
                                @php $isUTS = true; @endphp
                            @endif
                            @if ($s->name == "UAS")
                                @php $isUAS = true; @endphp
                            @endif
                            <tr>
                                <td class="align-middle text-center">{{ $countExam }}</td>
                                <td class="align-middle text-center">{{ $s->name }}</td>
                                <td class="align-middle text-center">{{ $s->score }}</td>
                                <td class="align-middle text-center">
                                    <button type="button" class="btn btn-primary text-white"
                                        data-bs-toggle="modal"
                                        data-bs-target="#updateExamScore-{{ $s->exam_score_id }}">
                                        <i class='fas fa-pencil-alt'></i>
                                    </button>
                                </td>
                            </tr>
                        @endif
                    @endforeach                
                   
                    @if ($countExam === 0)
                    <tr>
                        <td class="align-middle text-center">1</td>
                        <td class="align-middle text-center">UTS</td>
                        <td class="align-middle text-center">-</td>
                        <td class="align-middle text-center">
                            <button type="button" class="btn btn-primary text-white"
                                data-bs-toggle="modal"
                                data-bs-target="#addExamScore-UTS">
                                <i class='fas fa-pencil-alt'></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle text-center">2</td>
                        <td class="align-middle text-center">UAS</td>
                        <td class="align-middle text-center">-</td>
                        <td class="align-middle text-center">
                            <button type="button" class="btn btn-primary text-white"
                                data-bs-toggle="modal"
                                data-bs-target="#addExamScore-UAS">
                                <i class='fas fa-pencil-alt'></i>
                            </button>
                        </td>
                    </tr>   
                    @endif

                    @if ($countExam > 0)
                        @if (!$isUTS)
                            <tr>
                                <td class="align-middle text-center">1</td>
                                <td class="align-middle text-center">UTS</td>
                                <td class="align-middle text-center">-</td>
                                <td class="align-middle text-center">
                                    <button type="button" class="btn btn-primary text-white"
                                        data-bs-toggle="modal"
                                        data-bs-target="#addExamScore-UTS">
                                        <i class='fas fa-pencil-alt'></i>
                                    </button>
                                </td>
                            </tr> 
                        @endif

                        @if (!$isUAS)
                        <tr>
                            <td class="align-middle text-center">2</td>
                            <td class="align-middle text-center">UAS</td>
                            <td class="align-middle text-center">-</td>
                            <td class="align-middle text-center">
                                <button type="button" class="btn btn-primary text-white"
                                    data-bs-toggle="modal"
                                    data-bs-target="#addExamScore-UAS">
                                    <i class='fas fa-pencil-alt'></i>
                                </button>
                            </td>
                        </tr> 
                        @endif
                    @endif

                </tbody>
            </table>
        </div>
        <h5 class="modal-title pb-2" id="staticBackdropLabel">Overall Score</h5>
        <div class="table-responsive-sm">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">Overall Score</th>
                    <th class="align-middle text-center">Minimum Score</th>
                </thead>
                <tbody>
                    @if ($countExam === 2 && $isAllAsgNotScored)
                        @if ( $overallScore > $classSubject->minimum_score)
                        <td class="align-middle text-center bg-success">  
                        @else
                        <td class="align-middle text-center bg-danger">
                        @endif
                            {{ $overallScore }}</td>
                        <td class="align-middle text-center">
                            {{ $classSubject->minimum_score }}</td></td>  
                    @else
                        <td class="align-middle text-center">
                        
                                -</td>
                            <td class="align-middle text-center">
                                {{ $classSubject->minimum_score }}</td></td>  
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app>

@foreach($assignmentScores as $score)
@if ($score->user_id == $classSubject->studentId && $score->assignment->class_subject_id == $classSubject->id)
<div class="modal fade" id="newAssignmentScore-{{ $score->assignment_score_id }}" tabindex="-1" aria-labelledby="newScoreLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newAssignmentLabel">Give Assignment Score - {{$score->assignment->title}}</h5>
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
                        <textarea name="notes" id="bodyNewScore{{ $score->assignment_score_id }}" cols="20" rows="10" class="form-control"
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
@endif
@endforeach


<div class="modal fade" id="addExamScore-UTS" tabindex="-1" aria-labelledby="newExamScoreLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newExamScoreLabel">Give Exam Score - UTS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('score.store-exam') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="form-control" name="name" id="name" value="UTS" hidden>
                    <input type="text" class="form-control" name="classSubjectId" id="classSubjectId" value="{{$classSubject->id}}" hidden>
                    <input type="text" class="form-control" name="studentId" id="studentId" value="{{ $classSubject->studentId}}" hidden>
                    <div class="">
                        <label for="score" class="form-label">Score <span class="required">*</span></label>
                        <input type="number" class="form-control" name="score" id="score" min="0" max="100" required>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="score_id" value="{{ $score->exam_score_id }}">
                        <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addExamScore-UAS" tabindex="-1" aria-labelledby="newExamScoreLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newExamScoreLabel">Give Exam Score - UAS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('score.store-exam') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="form-control" name="name" id="name" value="UAS" hidden>
                    <input type="text" class="form-control" name="classSubjectId" id="classSubjectId" value="{{$classSubject->id}}" hidden>
                    <input type="text" class="form-control" name="studentId" id="studentId" value="{{ $classSubject->studentId}}" hidden>
                    <div class="">
                        <label for="score" class="form-label">Score <span class="required">*</span></label>
                        <input type="number" class="form-control" name="score" id="score" min="0" max="100" required>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="score_id" value="{{ $score->exam_score_id }}">
                        <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach($examScores as $score)
<div class="modal fade" id="updateExamScore-{{ $score->exam_score_id }}" tabindex="-1" aria-labelledby="updateAssignmentScore" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateAssignmentScore">Update Exam Score - {{$score->name}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('score.update-exam', $score->exam_score_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="text" class="form-control" name="name" id="name" value="{{ $score->name }}" hidden>
                    <input type="text" class="form-control" name="classSubjectId" id="classSubjectId" value="{{$score->class_subject_id}}" hidden>
                    <input type="text" class="form-control" name="studentId" id="studentId" value="{{ $score->user_id}}" hidden>
                    <div class="">
                        <label for="score" class="form-label">Score <span class="required">*</span></label>
                        <input type="number" class="form-control" name="score" id="score" min="0" max="100" value="{{ $score->score }}" required>
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



@foreach($assignmentScores as $score)
<div class="modal fade" id="updateAssignmentScore-{{ $score->assignment_score_id }}" tabindex="-1" aria-labelledby="updateAssignmentScore" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newAssignmentLabel">Update Assignment Score - {{$score->assignment->title}}</h5>
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
                        <textarea name="notes" id="bodyUpdateScore{{ $score->assignment_score_id }}" cols="30" rows="10" class="form-control"
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
    var scores = {!! json_encode($assignmentScores->toArray()) !!};
    scores.forEach(function(item) {
        console.log('#bodyNewScore' + item.assignment_score_id)
        ClassicEditor
            .create(document.querySelector('#bodyNewScore' + item.assignment_score_id))
            .catch(error => {
                console.error(error);
        });

        ClassicEditor
            .create(document.querySelector('#bodyUpdateScore' + item.assignment_score_id))
            .catch(error => {
                console.error(error);
        });
    });

    $('.modal').modal( {
        focus: false
    });
    
</script>