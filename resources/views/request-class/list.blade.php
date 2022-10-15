<x-app title="List Request Class - Learningku">

    <x-slot name="navbar"></x-slot>

    <div id="content" class="container my-5 py-5">
        <h3 class="fw-bold">Request Class List</h3>
        <hr>
        @if (auth()->user()->role == 'Teacher')
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="newRequest-tab" data-bs-toggle="tab" data-bs-target="#newRequest" type="button" role="tab" aria-controls="newRequest" aria-selected="true">New Request</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved" type="button" role="tab" aria-controls="approved" aria-selected="false">Approved</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected" type="button" role="tab" aria-controls="rejected" aria-selected="false">Rejected</button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="newRequest" role="tabpanel" aria-labelledby="newRequest-tab">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                            <th class="align-middle text-center">No</th>
                            <th class="align-middle text-center">Student Name</th>
                            <th class="align-middle text-center">Class Requested</th>
                            <th class="align-middle text-center">Comment</th>
                            <th class="align-middle text-center">Status</th>
                            <th class="align-middle text-center">Action</th>
                        </thead>
                        <tbody>
                            @foreach($requestClasses->where('status', 'New Request') as $index=>$requestClass)
                            <tr>
                                <td class="align-middle text-center">{{ $index+1 }}</td>
                                <td class="align-middle text-center">{{ $requestClass->studentName }}</td>
                                <td class="align-middle text-center">{{ $requestClass->className }}</td>
                                <td class="align-middle text-center">{{ $requestClass->comment }}</td>
                                <td class="align-middle text-center">{{ $requestClass->status }}</td>
                                <td class="align-middle text-center"> 
                                    <a href="{{route('class-request-action',['classRequestId' => $requestClass->id, 'action' => 'Approved'])}}"
                                        class="btn btn-success">Approve</a>
                                   <a href="{{route('class-request-action',['classRequestId' => $requestClass->id, 'action' => 'Rejected'])}}"
                                             class="btn btn-danger">Reject</a>
                                </td>
        
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 

            </div>
            <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                            <th class="align-middle text-center">No</th>
                            <th class="align-middle text-center">Student Name</th>
                            <th class="align-middle text-center">Class Requested</th>
                            <th class="align-middle text-center">Comment</th>
                            <th class="align-middle text-center">Status</th>
                        </thead>
                        <tbody>
                            @foreach($requestClasses->where('status', 'Approved') as $index=>$requestClass)
                            <tr>
                                <td class="align-middle text-center">{{ $index+1 }}</td>
                                <td class="align-middle text-center">{{ $requestClass->studentName }}</td>
                                <td class="align-middle text-center">{{ $requestClass->className }}</td>
                                <td class="align-middle text-center">{{ $requestClass->comment }}</td>
                                <td class="align-middle text-center">{{ $requestClass->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 
            </div>
            <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                            <th class="align-middle text-center">No</th>
                            <th class="align-middle text-center">Student Name</th>
                            <th class="align-middle text-center">Class Requested</th>
                            <th class="align-middle text-center">Comment</th>
                            <th class="align-middle text-center">Status</th>
                        </thead>
                        <tbody>
                            @foreach($requestClasses->where('status', 'Rejected') as $index=>$requestClass)
                            <tr>
                                <td class="align-middle text-center">{{ $index+1 }}</td>
                                <td class="align-middle text-center">{{ $requestClass->studentName }}</td>
                                <td class="align-middle text-center">{{ $requestClass->className }}</td>
                                <td class="align-middle text-center">{{ $requestClass->comment }}</td>
                                <td class="align-middle text-center">{{ $requestClass->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 
            </div>
          </div>
        </div>        
        @endif
        @if (auth()->user()->role == 'Student')
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <th class="align-middle text-center">No</th>
                    <th class="align-middle text-center">Teacher Name</th>
                    <th class="align-middle text-center">Class Requested</th>
                    <th class="align-middle text-center">Comment</th>
                    <th class="align-middle text-center">Status</th>
                </thead>
                <tbody>
                    @foreach($requestClasses as $index=>$requestClass)
                    <tr>
                        <td class="align-middle text-center">{{ $index+1 }}</td>
                        <td class="align-middle text-center">{{ $requestClass->teacherName }}</td>
                        <td class="align-middle text-center">{{ $requestClass->className }}</td>
                        <td class="align-middle text-center">{{ $requestClass->comment }}</td>
                        <td class="align-middle text-center">{{ $requestClass->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 
        @endif
    </div>
</x-app>