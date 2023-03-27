<x-app title="Student List - {{$class->name}} {{$schoolYear->year}} - {{$schoolYear->semester}}">
     <x-slot name="navbar"></x-slot>

     <div id="content" class="container py-5 my-5">
          <h3 class="fw-bold">Student List - {{$class->name}} Tahun Ajaran {{$schoolYear->year}} - {{$schoolYear->semester}}</h3>
          <a type="button" class="btn btn-dark text-white mb-3" href="{{ route('admin-class-view', $schoolYear->id) }}">
               Back
          </a>
          <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
          data-bs-target="#addStudent">
          Assign Student to Class
          </button>
          <div class="table-responsive">
               <table class="table table-hover">
                    <thead>
                         <th class="align-middle text-center">ID</th>
                         <th class="align-middle text-center">Student Name</th>
                         <th class="align-middle text-center">Action</th>
                    </thead>
                    <tbody>
                         @foreach ($students as $student)
                              <tr>
                                   <td class="align-middle text-center">{{$student->id}}</td>
                                   <td class="align-middle text-center">{{$student->name}}</td>
                                   <td class="align-middle text-center">
                                        <a href="{{ route('admin-class-remove-student', $student->classDetailId) }}"
                                             class="btn btn-danger text-white justify-content-between" onclick="return confirm('Are you sure?')">Remove</a>
                                       </th>
                                   </td>
                              </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div>

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
                              <label for="student_id" class="form-label">Student</label>
                              <select name="student_id" class="form-select" required>
                                   <option value="" selected>--Please Choose--</option>
                                   @foreach ($studentsNotAssigned as $student)
                                       <option value="{{$student->id}}">{{$student->nisn}} - {{$student->name}}</option>
                                   @endforeach
                              </select>
                         </div>
                         <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                  </div>
              </div>
          </div>
     </div>

</x-app>