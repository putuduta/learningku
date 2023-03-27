<x-app title="Assignment Detail - Learningku">
    <x-slot name="navbar"></x-slot>

    <div id="content" class="container py-5 my-5">
        <div class="mb-3">
            <span class="fa-stack fa-md ms-n1">
                <i class="fas fa-circle fa-stack-2x text-orange"></i>
                <a href="{{ url()->previous() }}" class="fas fa-arrow-left fa-stack-1x fa-inverse text-light" style="text-decoration: none;"></a>
            </span>
        </div>
        <h3 class="fw-bold">Assignment Detail - {{ $assignmentHeader->title }}</h3>
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
                    @php($i = 1)
                    @foreach($assignmentScore as $score)

                        @if($assignments->count() > 0)
                            @foreach($assignments as $assignment)
                                @if ($score->assignmentHeaderId == $assignment->assignmentId && $score->studentUserId == $assignment->studentUserId)
                                <tr>
                                    <td class="align-middle text-center">{{ $i }}</td>
                                    <td class="align-middle text-center">{{ $assignment->studentName }}</td>
                                    <td class="align-middle text-center">
                                        {{ date_format(date_create($assignment->createdAt),"d F Y H:i") }}
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="/storage/assignment/submission/{{ $assignment->file }}" download
                                            class="btn btn-success text-white">
                                            Download
                                        </a>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <td class="align-middle text-center">{{ $i }}</td>
                                    <td class="align-middle text-center">{{ $score->studentName }}</td>
                                    <td class="align-middle text-center">
                                    Not Yet Submitted
                                    </td>
                                    <td class="align-middle text-center">
                                        -
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            @else 
                            <tr>
                                <td class="align-middle text-center">{{ $i }}</td>
                                <td class="align-middle text-center">{{ $score->studentName }}</td>
                                <td class="align-middle text-center">
                                Not Yet Submitted
                                </td>
                                <td class="align-middle text-center">
                                    -
                                </td>
                            </tr> 
                            @endif
                    @php($i++)
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>
