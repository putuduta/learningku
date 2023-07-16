<x-app title="Class List - {{$classes->first()->year}} - {{$classes->first()->semester}}">
     <div id="content" class="container py-5 my-5">
          <h3 class="fw-bold">Class List - School Year {{$classes->first()->year}} - {{$classes->first()->semester}}</h3>

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
                         <th class="align-middle text-center">Homeroom Teacher</th>
                         <th class="align-middle text-center" colspan="4">Action</th>
                    </thead>
                    <tbody>
                         @foreach ($classes as $index => $class)
                              @if ($class->name !== null)
                              <tr>
                                   <td class="align-middle text-center">{{$index+1}}</td>
                                   <td class="align-middle text-center">{{$class->name}}</td>
                                   <td class="align-middle text-center">{{$class->homeroomTeacherName}}</td>
                                   <td class="align-middle text-center">
                                        <button type="button" class="btn btn-primary text-white justify-content-between" data-bs-toggle="modal"
                                        data-bs-target="#updateClass{{ $class->class_header_id }}">
                                             Edit
                                        </button>
                                        <a href="{{route('admin-class-view-subject',$class->class_header_id)}}"
                                        class="btn btn-success text-white">Subject List</a>
                                        <a href="{{route('admin-class-view-student',$class->class_header_id)}}"
                                             class="btn btn-secondary text-white">Students</a>

                                        <button type="button" class="btn btn-danger text-white justify-content-between"
                                             data-bs-toggle="modal"
                                             data-bs-target="#delete-{{ $class->class_header_id }}">
                                             Remove
                                        </button>
                                   </td>
                              </tr>
                              @endif
                         @endforeach
                    </tbody>
               </table>
          </div>

          @foreach ($classes as $class)
          @if ($class->name !== null)
               <div class="modal fade show pr-0" style="z-index: 9999;" id="delete-{{ $class->class_header_id }}"
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
                                             <form action="{{ route('admin-class-remove', $class->class_header_id) }}"
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
          @endif
          @endforeach

          <div class="modal fade" id="newClass" tabindex="-1" aria-labelledby="newClass"
          aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered modal-lg">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title" id="submitLabel">Add Class</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                       </div>
                       <div class="modal-body">
              
                         <form method="POST" action="{{route('admin-class-create', $classes->first()->schoolYearId)}}">
                              @csrf
                              <div class="">
                                   <label for="school_year" class="form-label">School Year</label>
                                   <input type="text" class="form-control" name="school_year" value="{{$classes->first()->year}} - {{$classes->first()->semester}}" readonly>
                              </div>
                              <div class="my-3">
                                   <label for="class_name" class="form-label">Class Name <span class="required">*</span></label>
                                   <input type="text" class="form-control" name="class_name" required>
                              </div>
                              <div class="my-3">
                                   <label for="homeroom_teacher_user_id" class="form-label">Homeroom Teacher <span class="required">*</span></label>
                                   <select name="homeroom_teacher_user_id" class="form-select" required>
                                        <option value="" selected>--Please Choose--</option>
                                        @foreach ($teachers as $teacher)
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
          @if ($class->name !== null)
              <div class="modal fade" id="updateClass{{ $class->class_header_id }}" tabindex="-1" aria-labelledby="updateSchoolYear"
                  aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="submitLabel">Edit Class</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <form action="{{ route('admin-class-update', $class) }}" method="POST"
                                  enctype="multipart/form-data">
                                  @csrf
                                  @method('put')
                                  <div class="">
                                       <input type="text" class="form-control" name="school_year_id" value="{{$classes->first()->schoolYearId}}" hidden>
                                       <label for="school_year" class="form-label">School Year</label>
                                       <input type="text" class="form-control" name="school_year" value="{{$classes->first()->year}} - {{$classes->first()->semester}}" readonly>
                                  </div>
                                  <div class="my-3">
                                       <label for="class_name" class="form-label">Class Name <span class="required">*</span></label>
                                       <input type="text" class="form-control" value="{{$class->name}}" name="class_name" required>
                                  </div>
                                  <div class="my-3">
                                       <label for="homeroom_teacher_user_id" class="form-label">Homeroom Teacher <span class="required">*</span></label>
                                       <select name="homeroom_teacher_user_id" class="form-select" required>
                                            <option value="" selected>--Please Choose--</option>
                                            <option value="{{$class->homeroomTeacherId}}" selected>{{$class->teacherNuptk}} - {{$class->homeroomTeacherName}}</option> 
                            
                                            @foreach ($teachers as $teacher)
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
          @endif
          @endforeach
     </div>
</x-app>