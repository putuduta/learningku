<x-app title="Teacher List">
     <x-slot name="navbar"></x-slot>

     <div id="content" class="container py-5 my-5">
          <h3 class="fw-bold">Teacher List</h3>
          <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
               data-bs-target="#newTeacher">
               Assign New Teacher
          </button>
          {{-- <a href="{{route('teacher-view-create')}}" class="btn btn-primary mb-3">Add New Teacher</a> --}}
          <div class="table-responsive">
               <table class="table table-hover">
                    <thead>
                         <th class="align-middle text-center">ID</th>
                         <th class="align-middle text-center">Teacher Name</th>
                         <th class="w-25 align-middle text-center">Action</th>
                    </thead>
                    <tbody>
                         @foreach ($teachers as $teacher)
                              <tr>
                                   <td class="align-middle text-center">{{$teacher->id}}</td>
                                   <td class="align-middle text-center">{{$teacher->name}}</td>
                                   <td class="align-middle text-center">
                                        <button type="button" class="btn btn-primary text-white justify-content-between" data-bs-toggle="modal"
                                        data-bs-target="">
                                            Update
                                        </button>
                                        <a href="{{ route('admin-teacher-remove', $teacher->id) }}"
                                             class="btn btn-danger text-white justify-content-between">Remove</a>
                                   </td>
                              </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div>
</x-app>

<div class="modal fade" id="newTeacher" tabindex="-1" aria-labelledby="newTeacherLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="submitLabel">Assign New Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form action="">
                         @csrf
                         <div class="my-3">
                              <label for="name" class="form-label">Teacher Name</label>
                              <input type="text" class="form-control" name="name" required>
                         </div>
                         <div class="my-3">
                              <label for="class_name" class="form-label">Email</label>
                              <input type="email" class="form-control" name="email" required>
                         </div>
                         <div class="my-3">
                              <label for="reg_number" class="form-label">Registration Number</label>
                              <input type="text" class="form-control" name="reg_number" required>
                         </div>
                         <div class="my-3">
                              <label for="phone_number" class="form-label">Phone Number</label>
                              <input type="text" class="form-control" name="phone_number" required>
                         </div>
                         <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </form>
               </div>
        </div>
    </div>
</div>