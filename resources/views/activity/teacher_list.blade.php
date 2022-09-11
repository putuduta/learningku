<x-app title="Activity Log - Teacher">
    <x-slot name="navbar"></x-slot>

    <div id="content" class="container py-5 my-5">
        <h3>Activity Log</h3>
        <hr>
        <a href="{{ route('activity.view-create') }}" class="btn btn-primary text-white mb-3">Add New Activity</a>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">ID</th>
                    <th class="align-middle text-center">Date</th>
                    <th class="align-middle text-center">Course</th>
                    <th class="align-middle text-center">Class</th>
                    <th class="align-middle text-center">Description</th>
                    <th class="align-middle text-center">Actions</th>
                </thead>
                <tbody>
                    @foreach($activites as $activity)
                    <tr>
                        <td class="align-middle text-center">{{ $activity->id }}</td>
                        <td class="align-middle text-center">
                            {{ date_format(date_create($activity->date),"d F Y") }}</td>
                        <td class="align-middle text-center">{{ $activity->classCourse->course->name }}</td>
                        <td class="align-middle text-center">{{ $activity->classCourse->class->name }}</td>
                        <td class="align-middle text-center">{{ $activity->description }}</td>
                        <td class="align-middle text-center">
                            <a type="button" class="btn btn-danger text-white"
                                href="{{route('activity.delete',$activity->id)}}">
                                Delete
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>
