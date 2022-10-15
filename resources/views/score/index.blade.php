<x-app title="Class Score - Learningku">
    <x-slot name="navbar"></x-slot>

    <div id="content" class="container py-5 my-5">
        <h3 class="fw-bold">Class Score</h3>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">No</th>
                    <th class="align-middle text-center">Class</th>
                    <th class="align-middle text-center">Course</th>
                    <th class="align-middle text-center">Assignment</th>
                    <th class="align-middle text-center">Mid</th>
                    <th class="align-middle text-center">Final</th>
                </thead>
                <tbody>
                    @foreach ($scores as $index => $score)
                        <tr>
                            <td class="align-middle text-center">{{ $index + 1 }}</td>
                            <td class="align-middle text-center">{{ $score->class_course->class->name }}</td>
                            <td class="align-middle text-center">{{ $score->class_course->course->name }}</td>
                            <td class="align-middle text-center">{{ $score->assignment }}</td>
                            <td class="align-middle text-center">{{ $score->mid }}</td>
                            <td class="align-middle text-center">{{ $score->final }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>
