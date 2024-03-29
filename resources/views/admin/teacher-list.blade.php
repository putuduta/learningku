<x-app title="Teacher List">
     <div id="content" class="container py-5 my-5">
          <h3 class="fw-bold">Teacher List</h3>
          <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
               data-bs-target="#newTeacher">
               Add New Teacher
          </button>
          <div class="table-responsive">
               <table class="table table-hover table-bordered">
                   <thead class="table-light">
                         <th class="align-middle text-center">No</th>
                         <th class="align-middle text-center">Teacher Name</th>
                         <th class="align-middle text-center">NUPTK</th>
                         <th class="align-middle text-center">Action</th>
                    </thead>
                    <tbody>
                         @foreach ($teacherList as $index => $teacher)
                              <tr>
                                   <td class="align-middle text-center">{{$index+1}}</td>
                                   <td class="align-middle text-center">{{$teacher->name}}</td>
                                   <td class="align-middle text-center">{{$teacher->nuptk}}</td>
                                   <td class="align-middle text-center">
                                        <button type="button" class="btn btn-primary text-white justify-content-between" data-bs-toggle="modal"
                                        data-bs-target="#updateTeacher{{ $teacher->user_id }}">
                                            Update
                                        </button>

                                        <button type="button" class="btn btn-danger text-white justify-content-between"
                                             data-bs-toggle="modal"
                                             data-bs-target="#delete-{{ $teacher->user_id }}">
                                             Remove
                                        </button>
                                   </td>
                              </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div>

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
                              <input type="number" class="form-control" name="nuptk" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==16) return false;" required>
                         </div>
                         <div class="my-3">
                              <label for="email" class="form-label">Email <span class="required">*</span></label>
                              <input type="email" class="form-control" name="email" required>
                         </div>
                         <div class="my-3">
                              <label for="password" class="form-label">Password <span class="required">*</span></label>
                              <input type="password" class="form-control" name="password" required>
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
                              <label for="school" class="form-label">School</label>
                              <input type="text" class="form-control" name="school" value="{{ auth()->user()->school }}" readonly>
                         </div>
                         <div class="my-3">
                              <label for="image" class="form-label">Teacher Image</label>
                              <input type="file" class="form-control" name="image">
                         </div>
                         <div class="d-grid">
                              <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                          </div>
                    </form>
               </div>
        </div>
    </div>
</div>

@foreach($teacherList as $teacher)
        <div class="modal fade" id="updateTeacher{{ $teacher->user_id }}" tabindex="-1" aria-labelledby="updateTeacher"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="submitLabel">Update Teacher</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin-teacher-update', $teacher) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="my-3">
                                 <label for="name" class="form-label">Teacher Name <span class="required">*</span></label>
                                 <input type="text" class="form-control" name="name" value="{{ $teacher->name }}" required>
                            </div>
                            <div class="my-3">
                                 <label for="nuptk" class="form-label">NUPTK <span class="required">*</span></label>
                                 <input type="number" class="form-control" name="nuptk" value="{{ $teacher->nuptk }}" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==16) return false;" required>
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
                              <label for="school" class="form-label">School</label>
                              <input type="text" class="form-control" name="school" value="{{ $teacher->school }}"  readonly>
                            </div>   
                            <div class="my-3">
                              <label for="image" class="form-label">Teacher Image</label>
                              <input type="file" class="form-control" name="image">
                            </div>
                            <div class="d-grid">
                              <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($teacherList as $teacher)
    <div class="modal fade show pr-0" style="z-index: 9999;" id="delete-{{ $teacher->user_id }}"
        tabindex="-1" role="dialog" aria-labelledby="alertTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-20 border-0">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-12 mb-3 text-center">
                            <span class="fa-stack fa-4x">
                                <i class="fas fa-circle fa-stack-2x text-danger"></i>
                                <i class="fas fa-exclamation-triangle fa-stack-1x fa-inverse"></i>
                            </span>
                        </div>
                        <div class="col-12 my-2 text-center">
                            <h4 class="font-weight-bold">Are you sure want to remove this data?</h4>

                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-light text-dark justify-content-between mx-2"
                                    data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <form action="{{ route('admin-teacher-remove', $teacher->user_id) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger text-white justify-content-between">
                                        Yes, remove it
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
</x-app>

