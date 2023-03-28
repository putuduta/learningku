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

