<x-app title="Teacher List">
     <x-slot name="navbar"></x-slot>

     <div id="content" class="container py-5 my-5">
          <h3 class="fw-bold">Teacher List</h3>
          <a href="{{route('teacher-view-create')}}" class="btn btn-primary mb-3">Add New Teacher</a>
          <div class="table-responsive">
               <table class="table table-hover">
                    <thead>
                         <th class="align-middle text-center">ID</th>
                         <th class="align-middle text-center">Teacher Name</th>
                    </thead>
                    <tbody>
                         @foreach ($teachers as $teacher)
                              <tr>
                                   <td class="align-middle text-center">{{$teacher->id}}</td>
                                   <td class="align-middle text-center">{{$teacher->name}}</td>
                              </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div>
</x-app>