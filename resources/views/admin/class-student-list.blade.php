<x-app title="Student List - {{$class->name}} {{$schoolYear->year}} - {{$schoolYear->semester}}">
     <x-slot name="navbar"></x-slot>

     <div id="content" class="container py-5 my-5">
          <h3 class="fw-bold">Student List - {{$class->name}} {{$schoolYear->year}} - {{$schoolYear->semester}}</h3>
          <a type="button" class="btn btn-dark text-white mb-3" href="{{ route('admin-class-view', $schoolYear->id) }}">
               Back
          </a>
          <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
          data-bs-target="#addStudent">
          Assign Student to Class
          </button>
          <div class="table-responsive">
               <table class="table table-hover table-bordered">
                   <thead class="table-light">
                         <th class="align-middle text-center">No</th>
                         <th class="align-middle text-center">NISN</th>
                         <th class="align-middle text-center">Student Name</th>
                         <th class="align-middle text-center">Action</th>
                    </thead>
                    <tbody>
                         @foreach ($students as $index => $student)
                              <tr>
                                   <td class="align-middle text-center">{{$index+1}}</td>
                                   <td class="align-middle text-center">{{$student->nisn}}</td>
                                   <td class="align-middle text-center">{{$student->name}}</td>
                                   <td class="align-middle text-center">
                                        <button type="button" class="btn btn-danger text-white justify-content-between"
                                             data-bs-toggle="modal"
                                             data-bs-target="#delete-{{ $student->classDetailId }}">
                                             Remove
                                        </button>
                                   </td>
                              </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div>

     @foreach ($students as $student)
          <div class="modal fade show pr-0" style="z-index: 9999;" id="delete-{{ $student->classDetailId }}"
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
                                        <form action="{{ route('admin-class-remove-student', $student->classDetailId) }}"
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

     <div class="modal fade" id="addStudent" tabindex="-1" aria-labelledby="addStudent"
     aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="submitLabel">Assign Student to Class</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="{{route('admin-class-assign-student',$class->id)}}">
                         @csrf
                         <div class="">
                              <label for="school_year" class="form-label">School Year</label>
                              <input type="text" class="form-control" name="school_year" value="{{$schoolYear->year}} - {{$schoolYear->semester}}" readonly>
                         </div>
                         <div class="my-3">
                              <label for="class_name" class="form-label">Class</label>
                              <input type="text" class="form-control" name="class_name" value="{{$class->name}}"  readonly>
                         </div>
                         <div class="my-3">
                              <label for="student_id" class="form-label">Student <span class="required">*</span></label>
                              <select name="student_id" class="form-select" required>
                                   <option value="" selected>--Please Choose--</option>
                                   @foreach ($studentsNotAssigned as $student)
                                       <option value="{{$student->id}}">{{$student->nisn}} - {{$student->name}}</option>
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

</x-app>