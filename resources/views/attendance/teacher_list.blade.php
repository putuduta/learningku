<x-app title="Attendance List - Teacher">
    <x-slot name="navbar"></x-slot>

    <div id="content" class="container py-5 my-5">
        <h3 class="fw-bold">Attendance List - {{ $class->name }}</h3>
        <a href="{{ route('attendance.view-create',$class->id) }}" class="btn btn-primary text-white mb-3">Add Today
            Attendance</a>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">ID</th>
                    <th class="align-middle text-center">Date</th>
                    <th class="align-middle text-center">Class</th>
                    <th class="align-middle text-center">Actions</th>
                </thead>
                <tbody>
                    @foreach($attendances as $attendance)
                    <tr>
                        <td class="align-middle text-center">{{ $attendance->id }}</td>
                        <td class="align-middle text-center">{{ date_format(date_create($attendance->date),"d F Y") }}
                        </td>
                        <td class="align-middle text-center">{{ $attendance->class->name }}</td>
                        <td class="align-middle text-center">
                            <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                                data-bs-target="#detail-{{ $attendance->id }}">
                                Details
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>

@foreach($attendances as $attendance)
<div class="modal fade" id="detail-{{ $attendance->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Attendance Detail - {{ $attendance->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                            <th class="align-middle text-center">No</th>
                            <th class="align-middle text-center">Student Name</th>
                            <th class="align-middle text-center">Status</th>
                        </thead>
                        <tbody>
                            <h5>Date: {{ date_format(date_create($attendance->date),"d F Y") }}</h5>
                            @foreach($attendance->details as $index => $detail)
                            <tr>
                                <td class="align-middle text-center">
                                    {{ $index+1 }}</td>
                                <td class="align-middle text-center">
                                    {{ $detail->student->name }}</td>

                                @if($detail->is_attend == 1)
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
