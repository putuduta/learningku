<x-app title="Assignment List - Learningku">
    <x-slot name="navbar"></x-slot>
<h1>this is material page</h1>
<div id="content" class="container my-5">
    <h3 class="fw-bold">Material List</h3>
    <hr>
    @if (auth()->user()->role == 'Teacher')
        <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
            data-bs-target="#newAssignment">
            Create New Material
        </button>
    @endif
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <th class="align-middle text-center">ID</th>
                <th class="align-middle text-center">Class Name</th>
                <th class="align-middle text-center">Class ID</th>
                {{-- @if (auth()->user()->role == 'Student')
                    <th class="align-middle text-center">Status</th>
                @endif --}}
                <th class="align-middle text-center">Description</th>
                <th class="align-middle text-center">Resources</th>
                <th class="align-middle text-center">Created By</th>
                <th class="align-middle text-center">Created At</th>
            </thead>
            <tbody>
                {{-- @foreach ($assignments as $index => $assignment)
                    <tr>
                        <td class="align-middle text-center">{{ $index + 1 }}</td>
                        <td class="align-middle text-center">{{ $assignment->title }}</td>
                        <td class="align-middle text-center">
                            {{ date_format(date_create($assignment->end_time), 'd F Y H:i') }}
                        </td>
                        @if (auth()->user()->role == 'Student')
                            @if (count($assignment->submissionUser) > 0)
                                <td class="align-middle text-center bg-success text-white">Submitted</td>
                            @else
                                <td class="align-middle text-center bg-danger text-white">Not Submitted</td>
                            @endif
                        @endif
                        <td class="align-middle text-center">
                            <a href="/storage/assignment/{{ $assignment->file }}" download
                                class="btn btn-success text-white">
                                Download
                            </a>
                            @if (auth()->user()->role == 'Student')
                                @if (strtotime($assignment->end_time) > time())
                                    <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                                        data-bs-target="#submit-{{ $assignment->id }}">
                                        Add Submission
                                    </button>
                                @endif
                                <button type="button" class="btn btn-dark text-white" data-bs-toggle="modal"
                                    data-bs-target="#history-{{ $assignment->id }}">
                                    History
                                </button>
                            @elseif(auth()->user()->role == 'Teacher')
                                <a href="{{ route('assignment.show', $assignment) }}"
                                    class="btn btn-primary text-white">
                                    Show Detail
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
</div>
</x-app>