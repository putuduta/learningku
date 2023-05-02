<x-app title="Student List">
     <x-slot name="navbar"></x-slot>

     <div id="content" class="container py-5 my-5">
          <h3 class="fw-bold">Student List</h3>
          <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
               data-bs-target="#newStudent">
               Add New Student
          </button>
          <div class="table-responsive">
               <table class="table table-hover table-bordered">
                   <thead class="table-light">
                         <th class="align-middle text-center">No</th>
                         <th class="align-middle text-center">Student Name</th>
                         <th class="align-middle text-center">NISN</th>
                         <th class="align-middle text-center">Action</th>
                    </thead>
                    <tbody>
                         @foreach ($students as $index => $student)
                              <tr>
                                   <td class="align-middle text-center">{{$index+1}}</td>
                                   <td class="align-middle text-center">{{$student->name}}</td>
                                   <td class="align-middle text-center">{{$student->nisn}}</td>
                                   <td class="align-middle text-center">
                                        <button type="button" class="btn btn-primary text-white justify-content-between" data-bs-toggle="modal"
                                        data-bs-target="#updateStudent{{ $student->id }}">
                                            Update
                                        </button>

                                        <button type="button" class="btn btn-danger text-white justify-content-between"
                                             data-bs-toggle="modal"
                                             data-bs-target="#delete-{{ $student->id }}">
                                             Remove
                                        </button>
                                        
                                   </td>
                              </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div>

     <div class="modal fade" id="newStudent" tabindex="-1" aria-labelledby="newStudentLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="submitLabel">Add New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form action="{{route('student-add')}}" method="POST" enctype="multipart/form-data">
                         @csrf
                         <div class="my-3">
                              <label for="name" class="form-label">Student Name <span class="required">*</span></label>
                              <input type="text" class="form-control" name="name" required>
                         </div>
                         <div class="my-3">
                              <label for="nisn" class="form-label">NISN <span class="required">*</span></label>
                              <input type="text" class="form-control" name="nisn" maxlength="10" required>
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
                                          <input type="radio" class="form-check-input" value="Female"  name="gender" required> Female
                                        </label>
                                   </div>
                              </div>
                         </div>
                         <div class="my-3">
                              <label for="image" class="form-label">Student Image</label>
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

@foreach($students as $student)
        <div class="modal fade" id="updateStudent{{ $student->id }}" tabindex="-1" aria-labelledby="updateStudent"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="submitLabel">Update Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('student-update', $student->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="my-3">
                                 <label for="name" class="form-label">Student Name <span class="required">*</span></label>
                                 <input type="text" class="form-control" name="name" value="{{ $student->name }}" required>
                            </div>
                            <div class="my-3">
                                 <label for="nisn" class="form-label">NISN <span class="required">*</span></label>
                                 <input type="text" class="form-control" name="nisn" value="{{ $student->nisn }}" required>
                            </div>
                            <div class="my-3">
                                 <label for="email" class="form-label">Email <span class="required">*</span></label>
                                 <input type="email" class="form-control" name="email" value="{{ $student->email }}" required>
                            </div>
                            <div class="my-3">
                                 <label for="password" class="form-label">Password <span class="required">*</span></label>
                                 <input type="password" class="form-control" name="password" value="{{ $student->password }}" required>
                            </div>
                            <div class="my-3">
                              <label for="gender" class="form-label">Gender <span class="required">*</span></label>
                                   <div>
                                        <div class="form-check-inline">
                                             <label class="form-check-label">
                                             <input type="radio" class="form-check-input" name="gender" value="Male" @if ($student->gender == "Male")
                                                checked 
                                             @endif required> Male
                                             </label>
                                        </div>
                                        <div class="form-check-inline">
                                             <label class="form-check-label">
                                             <input type="radio" class="form-check-input" name="gender" value="Female" @if ($student->gender == "Female")
                                                  checked 
                                             @endif> Female
                                             </label>
                                        </div>
                                   </div>
                            </div>
                            <div class="my-3">
                              <label for="image" class="form-label">Student Image</label>
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


    @foreach ($students as $student)
    <div class="modal fade show pr-0" style="z-index: 9999;" id="delete-{{ $student->id }}"
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
                                <form action="{{ route('student-remove', $student->id) }}"
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


