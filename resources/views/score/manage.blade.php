<x-app title="Class Score">
    <x-slot name="navbar"></x-slot>

    <div id="content" class="container py-5 my-5">
        <h3 class="fw-bold">Class Score - {{ $class_course->course->name }} - {{ $class_course->class->name }}</h3>
        <hr>
        <div class="d-flex mb-3">
            @foreach ($class_courses as $data)
                <a href="{{ route('score.manage', $data->id) }}"
                    class="btn btn-primary me-2">{{ $data->course->name }} -
                    {{ $data->class->name }}</a>
            @endforeach
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">ID</th>
                    <th class="align-middle text-center">NIM</th>
                    <th class="align-middle text-center">Name</th>
                    <th class="align-middle text-center">Action</th>
                </thead>
                <tbody>
                    @foreach ($class_course->class->student as $index => $student)
                        <tr>
                            <td class="align-middle text-center">{{ $index + 1 }}</td>
                            <td class="align-middle text-center">{{ $student->reg_number }}</td>
                            <td class="align-middle text-center">{{ $student->name }}</td>

                            <td class="align-middle text-center">
                                <a href="{{ route('score.create', ['classCourseId' => $class_course->id, 'userId' => $student->id]) }}"
                                    class="btn btn-success text-white">
                                    View Score
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>
