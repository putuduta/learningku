<x-app title="Student List">
     <x-slot name="navbar"></x-slot>

     <div id="content" class="container py-5 my-5">
          <h3 class="fw-bold">Student List</h3>
          <a href="{{route('student-view-create')}}" class="btn btn-primary mb-3">Add New Student</a>
          <div class="table-responsive">
               <table class="table table-hover">
                    <thead>
                         <th class="align-middle text-center">ID</th>
                         <th class="align-middle text-center">Student Name</th>
                    </thead>
                    <tbody>
                         @foreach ($students as $student)
                              <tr>
                                   <td class="align-middle text-center">{{$student->id}}</td>
                                   <td class="align-middle text-center">{{$student->name}}</td>
                              </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div>
</x-app>