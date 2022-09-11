<x-app title="Activity Log - {{ auth()->user()->class->name }}">
    <x-slot name="navbar"></x-slot>

    <div id="content" class="container py-5 my-5">
        <h3>Activity Log - {{ auth()->user()->class->name }}</h3>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">No</th>
                    <th class="align-middle text-center">Date</th>
                    <th class="align-middle text-center">Course</th>
                    <th class="align-middle text-center">Description</th>
                </thead>
                <tbody>
                    @foreach($activites as $index=>$activity)
                    <tr>
                        <td class="align-middle text-center">{{ $index+1 }}</td>
                        <td class="align-middle text-center">
                            {{ date_format(date_create($activity->date),"d F Y") }}</td>
                        <td class="align-middle text-center">{{ $activity->classCourse->course->name }}</td>
                        <td class="align-middle text-center">{{ $activity->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>
