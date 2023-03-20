<x-app title="Assignment Detail - Learningku">
    <x-slot name="navbar"></x-slot>

    <div id="content" class="container py-5 my-5">
        <div class="mb-3">
            <span class="fa-stack fa-md ms-n1">
                <i class="fas fa-circle fa-stack-2x text-orange"></i>
                <a href="{{ url()->previous() }}" class="fas fa-arrow-left fa-stack-1x fa-inverse text-light" style="text-decoration: none;"></a>
            </span>
        </div>
        <h3 class="fw-bold">Assignment Detail - {{ $assignment->title }}</h3>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">No</th>
                    <th class="align-middle text-center">Student Name</th>
                    <th class="align-middle text-center">Submission Time</th>
                    <th class="align-middle text-center">Action</th>
                </thead>
                <tbody>
                    @foreach($assignment->submission as $index=>$submission)
                    <tr>
                        <td class="align-middle text-center">{{ $index+1 }}</td>
                        <td class="align-middle text-center">{{ $submission->user->name }}</td>
                        <td class="align-middle text-center">
                            {{ date_format(date_create($submission->end_time),"d F Y H:i") }}
                        </td>
                        @if(auth()->user()->role == 'Student')
                        @if (count($submission->submission) > 0)
                        <td class="align-middle text-center bg-success text-white">Submitted</td>
                        @else
                        <td class="align-middle text-center bg-danger text-white">Not Submitted</td>
                        @endif
                        @endif
                        <td class="align-middle text-center">
                            <a href="/storage/assignment/submission/{{ $submission->file }}" download
                                class="btn btn-success text-white">
                                Download
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>
