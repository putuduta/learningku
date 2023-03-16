<x-app title="Class List - L-Man">
     <x-slot name="navbar"></x-slot>

     <div id="content" class="container py-5 my-5">
          <h3 class="fw-bold">Class List - Tahun Ajaran {{$schoolYear->year}} - {{$schoolYear->semester}}</h3>
          <hr>
          <a type="button" class="btn btn-dark text-white mb-3" href="{{ route('admin-class-view-choose-school-year') }}">
          Back to Choose School Year
          </a>
          <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
          data-bs-target="#newClass">
          Create Class
          </button>
          <div class="table-responsive">
               <table class="table table-hover">
                    <thead>
                         <th class="align-middle text-center">ID</th>
                         <th class="align-middle text-center">Class Name</th>
                         <th class="align-middle text-center">Homeroom Teacher/Wali Kelas</th>
                         <th class="align-middle text-center" colspan="2">Action</th>
                    </thead>
                    <tbody>
                         @foreach ($classes as $class)
                              <tr>
                                   <td class="align-middle text-center">{{$class->id}}</td>
                                   <td class="align-middle text-center">{{$class->name}}</td>
                                   <td class="align-middle text-center">{{$class->homeroomTeacherName}}</td>
                                   <td class="align-middle text-center">
                                        <button type="button" class="btn btn-primary text-white justify-content-between" data-bs-toggle="modal"
                                        data-bs-target="#updateClass{{ $class->id }}">
                                             Update
                                        </button>
                                        <a href=""
                                        class="btn btn-success">Student List</a>
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
                      <h5 class="modal-title" id="submitLabel">Create New Class</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="{{route('admin-class-create', $schoolYear->id)}}">
                         @csrf
                         <div class="my-3">
                              <label for="school_year" class="form-label">School Year</label>
                              <input type="text" class="form-control" name="school_year" value="{{$schoolYear->year}} - {{$schoolYear->semester}}" readonly>
                         </div>
                         <div class="my-3">
                              <label for="class_name" class="form-label">Class Name</label>
                              <input type="text" class="form-control" name="class_name" required>
                         </div>
                         <div class="my-3">
                              <label for="homeroom_teacher_id" class="form-label">Homeroom Teacher</label>
                              <select name="homeroom_teacher_id" class="form-select" required>
                                   <option value="" selected>--Please Choose--</option>
                                   @foreach ($teachers as $teacher)
                                       <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                   @endforeach
                              </select>
                         </div>
                         <button type="submit" class="btn btn-primary mt-4">Submit</button>
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
                          <h5 class="modal-title" id="submitLabel">Update Class</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form action="{{ route('admin-class-update', $class->id) }}" method="POST"
                              enctype="multipart/form-data">
                              @csrf
                              @method('put')
                              <div class="my-3">
                                   <input type="text" class="form-control" name="school_year_id" value="{{$schoolYear->id}}" hidden>
                                   <label for="school_year" class="form-label">School Year</label>
                                   <input type="text" class="form-control" name="school_year" value="{{$schoolYear->year}} - {{$schoolYear->semester}}" readonly>
                              </div>
                              <div class="my-3">
                                   <label for="class_name" class="form-label">Class Name</label>
                                   <input type="text" class="form-control" value="{{$class->name}}" name="class_name" required>
                              </div>
                              <div class="my-3">
                                   <label for="homeroom_teacher_id" class="form-label">Homeroom Teacher</label>
                                   <select name="homeroom_teacher_id" class="form-select" required>
                                        <option value="" selected>--Please Choose--</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{$teacher->id}}" {{($class->homeroom_teacher_id === $teacher->id) ? 'selected' : ''}}>{{$teacher->name}}</option>
                                        @endforeach
                                   </select>
                              </div>
                              <button type="submit" class="btn btn-primary mt-4">Submit</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      @endforeach
     </div>
</x-app>