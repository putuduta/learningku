<x-app title="Attendance List - Student">
    <x-slot name="navbar"></x-slot>

    <div id="content" class="container py-5 my-5">
        <h3 class="fw-bold">Attendance List</h3>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">No</th>
                    <th class="align-middle text-center">Date</th>
                    <th class="align-middle text-center">Status</th>
                </thead>
                <tbody>
                    @foreach($attendances as $index=>$attendance)
                    <tr>
                        <td class="align-middle text-center">{{ $index+1 }}</td>
                        <td class="align-middle text-center">
                            {{ date_format(date_create($attendance->header->date),"d F Y") }}
                        </td>
                        @if($attendance->is_attend == 1)
                        <td class="align-middle text-center bg-success text-white">
                            Present
                        </td>
                        @else
                        <td class="align-middle text-center bg-danger text-white">
                            Absent
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>
