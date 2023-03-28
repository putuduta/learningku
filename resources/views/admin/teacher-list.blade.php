<x-app title="Teacher List">
     <x-slot name="navbar"></x-slot>

     <div id="content" class="container py-5 my-5">
          <h3 class="fw-bold">Teacher List</h3>
          <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
               data-bs-target="#newTeacher">
               Add New Teacher
          </button>
          <div class="table-responsive">
               <table class="table table-hover">
                    <thead>
                         <th class="align-middle text-center">ID</th>
                         <th class="align-middle text-center">Teacher Name</th>
                         <th class="align-middle text-center">NUPTK</th>
                         <th class="align-middle text-center">Action</th>
                    </thead>
                    <tbody>
                         @foreach ($teachers as $teacher)
                              <tr>
                                   <td class="align-middle text-center">{{$teacher->id}}</td>
                                   <td class="align-middle text-center">{{$teacher->name}}</td>
                                   <td class="align-middle text-center">{{$teacher->nuptk}}</td>
                                   <td class="align-middle text-center">
                                        <button type="button" class="btn btn-primary text-white justify-content-between" data-bs-toggle="modal"
                                        data-bs-target="#updateTeacher{{ $teacher->id }}">
                                            Update
                                        </button>
                                        <a href="{{ route('admin-teacher-remove', $teacher->id) }}"
                                             class="btn btn-danger text-white justify-content-between" onclick="return confirm('Are you sure?')">Remove</a>
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
                    <h5 class="modal-title" id="submitLabel">Add New Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form action="{{route('admin-teacher-add')}}" method="POST" enctype="multipart/form-data">
                         @csrf
                         <div class="my-3">
                              <label for="name" class="form-label">Teacher Name <span class="required">*</span></label>
                              <input type="text" class="form-control" name="name" required>
                         </div>
                         <div class="my-3">
                              <label for="nuptk" class="form-label">NUPTK <span class="required">*</span></label>
                              <input type="text" class="form-control" name="nuptk" maxlength="20" required>
                         </div>
                         <div class="my-3">
                              <label for="email" class="form-label">Email <span class="required">*</span></label>
                              <input type="email" class="form-control" name="email" required>
                         </div>
                         <div class="my-3">
                              <label for="gender" class="form-label">Gender <span class="required">*</span></label>
                              <div>
                                   <div class="form-check-inline">
                                        <label class="form-check-label">
                                          <input type="radio" class="form-check-input" value="Male" name="gender" required> Male
                                        </label>
                                      </div>
                                      <div class="form-check-inline">
                                        <label class="form-check-label">
                                          <input type="radio" class="form-check-input" value="Female"  name="gender"> Female
                                        </label>
                                   </div>
                              </div>
                         </div>
                         <div class="my-3">
                              <label for="last_education" class="form-label">Last Education <span class="required">*</span></label>
                              <input type="text" class="form-control" name="last_education" required>
                         </div>
                         <div class="my-3">
                              <label for="position" class="form-label">Position <span class="required">*</span></label>
                              <input type="text" class="form-control" name="position" required>
                         </div>
                         <div class="my-3">
                              <label for="subject_taught" class="form-label">Subject Taught <span class="required">*</span></label>
                              <input type="text" class="form-control" name="subject_taught" required>
                         </div>
                         <div class="my-3">
                              <label for="image" class="form-label">Teacher Image</label>
                              <input type="file" class="form-control" name="image">
                         </div>
                         <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </form>
               </div>
        </div>
    </div>
</div>

@foreach($teachers as $teacher)
        <div class="modal fade" id="updateTeacher{{ $teacher->id }}" tabindex="-1" aria-labelledby="updateTeacher"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="submitLabel">Update Teacher</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin-teacher-update', $teacher->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="my-3">
                                 <label for="name" class="form-label">Teacher Name <span class="required">*</span></label>
                                 <input type="text" class="form-control" name="name" value="{{ $teacher->name }}" required>
                            </div>
                            <div class="my-3">
                                 <label for="nuptk" class="form-label">NUPTK <span class="required">*</span></label>
                                 <input type="text" class="form-control" name="nuptk" value="{{ $teacher->nuptk }}" maxlength="20" required>
                            </div>
                            <div class="my-3">
                                 <label for="email" class="form-label">Email <span class="required">*</span></label>
                                 <input type="email" class="form-control" name="email" value="{{ $teacher->email }}" required>
                            </div>
                            <div class="my-3">
                                 <label for="password" class="form-label">Password <span class="required">*</span></label>
                                 <input type="password" class="form-control" name="password" value="{{ $teacher->password }}" required>
                            </div>
                            <div class="my-3">
                              <label for="gender" class="form-label">Gender <span class="required">*</span></label>
                                   <div>
                                        <div class="form-check-inline">
                                             <label class="form-check-label">
                                             <input type="radio" class="form-check-input" name="gender" value="Male" @if ($teacher->gender == "Male")
                                                checked 
                                             @endif required> Male
                                             </label>
                                        </div>
                                        <div class="form-check-inline">
                                             <label class="form-check-label">
                                             <input type="radio" class="form-check-input" name="gender" value="Female" @if ($teacher->gender == "Female")
                                                  checked 
                                             @endif> Female
                                             </label>
                                        </div>
                                   </div>
                            </div>
                            <div class="my-3">
                              <label for="last_education" class="form-label">Last Education <span class="required">*</span></label>
                              <input type="text" class="form-control" name="last_education" value="{{ $teacher->last_education }}" required>
                            </div>
                            <div class="my-3">
                                 <label for="position" class="form-label">Position <span class="required">*</span></label>
                                 <input type="text" class="form-control" name="position" value="{{ $teacher->position }}" required>
                            </div>
                            <div class="my-3">
                                 <label for="subject_taught" class="form-label">Subject Taught <span class="required">*</span></label>
                                 <input type="text" class="form-control" name="subject_taught" value="{{ $teacher->subject_taught }}" required>
                            </div>
                            <div class="my-3">
                              <label for="image" class="form-label">Teacher Image</label>
                              <input type="file" class="form-control" name="image">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach