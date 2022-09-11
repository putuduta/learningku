<x-app title="Class Schedule">
    <x-slot name="navbar"></x-slot>

    <div id="content" class="container py-5 my-5">
        <h2 class="fw-bold">Class Schedule</h2>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="bg-dark text-white">
                    <th class="align-middle text-center" style="width: 25%">Monday</th>
                    <th class="align-middle text-center" style="width: 25%">Tuesday</th>
                    <th class="align-middle text-center" style="width: 25%">Wednesday</th>
                    <th class="align-middle text-center" style="width: 25%">Thursday</th>
                </thead>
                <tbody>
                    <tr>
                        @for ($i = 0; $i < 4; $i++)
                            @php
                                if ($i == 0) {
                                    $courses = $monday_courses;
                                } elseif ($i == 1) {
                                    $courses = $tuesday_courses;
                                } elseif ($i == 2) {
                                    $courses = $wednesday_courses;
                                } elseif ($i == 3) {
                                    $courses = $thursday_courses;
                                }
                            @endphp
                            <td>
                                @forelse ($courses as $course)
                                    <div class="card border-0 bg-color-lightblue mb-2">
                                        <div class="card-body">
                                            <h5>{{ $course->course->name }}</h5>
                                            <p>{{ auth()->user()->role->name == 'Teacher:' ? 'Class: ' . $course->class->name : 'Teacher: ' . $course->teacher->name }}
                                                <br>
                                                Start: {{ $course->start_time }}
                                                <br>
                                                End: {{ $course->end_time }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    No Class
                                @endforelse
                            </td>
                        @endfor
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead class="bg-dark text-white">
                    <th class="align-middle text-center" style="width: 33%">Friday</th>
                    <th class="align-middle text-center" style="width: 33%">Saturday</th>
                    <th class="align-middle text-center" style="width: 34%">Sunday</th>
                </thead>
                <tbody>
                    <tr>
                        @for ($i = 4; $i < 7; $i++)
                            @php
                                if ($i == 4) {
                                    $courses = $friday_courses;
                                } elseif ($i == 5) {
                                    $courses = $saturday_courses;
                                } elseif ($i == 6) {
                                    $courses = $sunday_courses;
                                }
                            @endphp
                            <td>
                                @forelse ($courses as $course)
                                    <div class="card border-0 bg-color-lightblue mb-2">
                                        <div class="card-body">
                                            <h5>{{ $course->course->name }}</h5>
                                            <p>{{ auth()->user()->role->name == 'Teacher:' ? 'Class: ' . $course->class->name : 'Teacher: ' . $course->teacher->name }}
                                                <br>
                                                Start: {{ $course->start_time }}
                                                <br>
                                                End: {{ $course->end_time }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <p>No Class</p>
                                @endforelse
                            </td>
                        @endfor
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app>
