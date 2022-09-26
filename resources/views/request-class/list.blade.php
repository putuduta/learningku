<x-app title="List Request Class">

    <x-slot name="navbar"></x-slot>

    <div id="content" class="container my-5 py-5">
        <h3 class="fw-bold">Request Class List</h3>
        <hr>
        @if (auth()->user()->role == 'Teacher')
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
                    @foreach($requestClasses as $index=>$requestClass)
                    <tr>
                        <td class="align-middle text-center">{{ $index+1 }}</td>
                        <td class="align-middle text-center">{{ $requestClass->studentName }}</td>
                        <td class="align-middle text-center">{{ $requestClass->className }}</td>
                        <td class="align-middle text-center">{{ $requestClass->comment }}</td>
                        <td class="align-middle text-center">{{ $requestClass->status }}</td>
                        <td class="align-middle text-center"> 
                            @if ($requestClass->status == 'New Request')
                            <a href="{{route('class-request-action',['classRequestId' => $requestClass->id, 'action' => 'Approve'])}}"
                                class="btn btn-success">Approve</a>
                           <a href="{{route('class-request-action',['classRequestId' => $requestClass->id, 'action' => 'Reject'])}}"
                                     class="btn btn-danger">Reject</a>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 
        @endif    
    </div>
</x-app>