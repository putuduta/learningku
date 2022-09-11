<x-app title="Score">

    <x-slot name="navbar"></x-slot>

    <div id="content" class="container my-5 py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>Score - {{ $class_course->class->name }} - {{ $class_course->course->name }} -
                    {{ $user->name }}</h3>
                <hr>
                <form action="{{ route('score.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="class_course_id" value="{{ $class_course->id }}">

                    <div class="my-3">
                        <label for="assignment" class="form-label">Assignment</label>
                        <input type="number" class="form-control" name="assignment" min="0" max="100">
                    </div>

                    <div class="my-3">
                        <label for="mid" class="form-label">Mid</label>
                        <input type="number" class="form-control" name="mid" min="0" max="100">
                    </div>
                    <div class="my-3">
                        <label for="final" class="form-label">Final</label>
                        <input type="number" class="form-control" name="final" min="0" max="100">
                    </div>

                    <button type="submit" class="btn btn-primary text-white mt-4">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</x-app>
