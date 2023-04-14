<x-app title="Class List - {{$schoolYear->year}} {{$schoolYear->semester}}">
     <x-slot name="navbar"></x-slot>

     <div id="content" class="container py-5 my-5">
          <h3 class="fw-bold">Class List - Tahun Ajaran {{$schoolYear->year}} - {{$schoolYear->semester}}</h3>

          <a type="button" class="btn btn-dark text-white mb-3" href="{{ url()->previous() }}">
          Back
          </a>
          <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
          data-bs-target="#newClass">
          Add Class
          </button>
          <div class="table-responsive">
               <table class="table table-hover table-bordered">
                   <thead class="table-light">
                         <th class="align-middle text-center">No</th>
                         <th class="align-middle text-center">Class Name</th>
                         <th class="align-middle text-center">Homeroom Teacher/Wali Kelas</th>
                         <th class="align-middle text-center" colspan="4">Action</th>
                    </thead>
                    <tbody>
                         @foreach ($classes as $index => $class)
                              <tr>
                                   <td class="align-middle text-center">{{$index+1}}</td>
                                   <td class="align-middle text-center">{{$class->name}}</td>
                                   <td class="align-middle text-center">{{$class->homeroomTeacherName}}</td>
                                   <td class="align-middle text-center">
                                        <button type="button" class="btn btn-primary text-white justify-content-between" data-bs-toggle="modal"
                                        data-bs-target="#updateClass{{ $class->id }}">
                                             Edit
                                        </button>
                                        <a href="{{route('admin-class-view-subject',$class)}}"
                                        class="btn btn-success text-white">Subject and Teacher List</a>
                                        <a href="{{route('admin-class-view-student',$class->id)}}"
                                             class="btn btn-secondary text-white">Students</a>

                                        <a href="{{ route('admin-class-remove', $class->id) }}"
                                             class="btn btn-danger text-white justify-content-between" onclick="return confirm('Are you sure?')">Remove</a>
                                   </td>
                              </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>

          <div class="modal fade" id="newClass" tabindex="-1" aria-labelledby="newClass"
          aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered modal-lg">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title" id="submitLabel">Add Class</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                       </div>
                       <div class="modal-body">
                         <form method="POST" action="{{route('admin-class-create', $schoolYear->id)}}">
                              @csrf
                              <div class="">
                                   <label for="school_year" class="form-label">School Year</label>
                                   <input type="text" class="form-control" name="school_year" value="{{$schoolYear->year}} - {{$schoolYear->semester}}" readonly>
                              </div>
                              <div class="my-3">
                                   <label for="class_name" class="form-label">Class Name <span class="required">*</span></label>
                                   <input type="text" class="form-control" name="class_name" required>
                              </div>
                              <div class="my-3">
                                   <label for="homeroom_teacher_id" class="form-label">Homeroom Teacher <span class="required">*</span></label>
                                   <select name="homeroom_teacher_id" class="form-select" required>
                                        <option value="" selected>--Please Choose--</option>
                                        @foreach ($teachersNotAssigned as $teacher)
                                            <option value="{{$teacher->id}}">{{$teacher->teacherNuptk}} - {{$teacher->name}}</option>
                                        @endforeach
                                   </select>
                              </div>
                              <div class="d-grid">
                                   <button type="submit" class="btn btn-primary my-4 text-white">Submit</button>
                               </div>
                         </form>
                       </div>
                   </div>
               </div>
          </div>

          @foreach($classes as $class)
              <div class="modal fade" id="updateClass{{ $class->id }}" tabindex="-1" aria-labelledby="updateSchoolYear"
                  aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="submitLabel">Edit Class</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <form action="{{ route('admin-class-update', $class->id) }}" method="POST"
                                  enctype="multipart/form-data">
                                  @csrf
                                  @method('put')
                                  <div class="">
                                       <input type="text" class="form-control" name="school_year_id" value="{{$schoolYear->id}}" hidden>
                                       <label for="school_year" class="form-label">School Year</label>
                                       <input type="text" class="form-control" name="school_year" value="{{$schoolYear->year}} - {{$schoolYear->semester}}" readonly>
                                  </div>
                                  <div class="my-3">
                                       <label for="class_name" class="form-label">Class Name <span class="required">*</span></label>
                                       <input type="text" class="form-control" value="{{$class->name}}" name="class_name" required>
                                  </div>
                                  <div class="my-3">
                                       <label for="homeroom_teacher_id" class="form-label">Homeroom Teacher <span class="required">*</span></label>
                                       <select name="homeroom_teacher_id" class="form-select" required>
                                            <option value="" selected>--Please Choose--</option>
                                            <option value="{{$class->homeroomTeacherId}}" selected>{{$class->teacherNuptk}} - {{$class->homeroomTeacherName}}</option> 
                            
                                            @foreach ($teachersNotAssigned as $teacher)
                                                <option value="{{$teacher->id}}" {{($class->homeroom_teacher_id === $teacher->id) ? 'selected' : ''}}>{{$teacher->teacherNuptk}} - {{$teacher->name}}</option>
                                            @endforeach
                                       </select>
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
     </div>
</x-app>