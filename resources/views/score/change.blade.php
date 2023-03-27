<x-app title="Score Update - Learningku">
    <x-slot name="navbar"></x-slot>

    <div id="content" class="container py-5 my-5">
        <h3 class="fw-bold">Update Score</h3>
        <hr>
        <a href="{{ URL::to('/') }}/score/detail/{{ $class }}/{{ $score->student_user_id }}" class="btn btn-primary text-white mb-3">Back to Student Score</a>

        <form action="{{ route('score.update', $score->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="my-3">
                <label for="score_name" class="form-label">Assignment Name</label>
                <input type="text" class="form-control" name="score_name" id="score_name" required
                    value="{{ $score->assignment_header->title }}" readonly>
            </div>
            <div class="my-3">
                <label for="score" class="form-label">Score</label>
                <input type="number" class="form-control" name="score" id="score" required
                    value="{{ $score->score }}">
            </div>
            <div class="d-grid">
                @method('put')
                <button type="submit" class="btn btn-primary my-4 text-white">Update</button>
            </div>
        </form>
    </div>
</x-app>