<x-app title="Subject List - {{$class->name}} {{$schoolYear->year}} - {{$schoolYear->semester}}">
    <x-slot name="navbar"></x-slot>

    <div id="content" class="container py-5 my-5">
         <h3 class="fw-bold">Subject and Teacher List - {{$class->name}} {{$schoolYear->year}} - {{$schoolYear->semester}}</h3>
         <a type="button" class="btn btn-dark text-white mb-3" href="{{ route('admin-class-view', $schoolYear->id) }}">
              Back
         </a>
         <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
         data-bs-target="#addSubject">
         Add Subject and Teacher
         </button>
         <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                        <th class="align-middle text-center">No</th>
                        <th class="align-middle text-center">Subject Name</th>
                        <th class="align-middle text-center">Teacher Name</th>
                        <th class="align-middle text-center">Teacher NUPTK</th>
                        <th class="align-middle text-center" colspan="2">Action</th>
                   </thead>
                   <tbody>
                        @foreach ($classSubjects as $index => $subject)
                             <tr>
                                  <td class="align-middle text-center">{{$index+1}}</td>
                                  <td class="align-middle text-center">{{$subject->name}}</td>
                                  <td class="align-middle text-center">{{$subject->teacherName}}</td>
                                  <td class="align-middle text-center">{{$subject->teacherNuptk}}</td>
                                  <th class="align-middle text-center">
                                    <button type="button" class="btn btn-primary text-white justify-content-between" data-bs-toggle="modal"
                                    data-bs-target="#updateSubject{{ $subject->id }}">
                                        Edit
                                    </button>

                                    <button type="button" class="btn btn-danger text-white justify-content-between"
                                        data-bs-toggle="modal"
                                        data-bs-target="#delete-{{ $subject->id }}">
                                        Remove
                                    </button>
                                  </th>
                             </tr>
                        @endforeach
                   </tbody>
              </table>
         </div>
    </div>

    @foreach ($classSubjects as $subject)
        <div class="modal fade show pr-0" style="z-index: 9999;" id="delete-{{ $subject->id }}"
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
                                    <form action="{{ route('admin-class-remove-subject', $subject->id) }}"
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

    <div class="modal fade" id="addSubject" tabindex="-1" aria-labelledby="addSubject"
    aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-lg">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="submitLabel">Add Subject and Teacher</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                   <form method="POST" action="{{route('admin-class-assign-subject',$class->id)}}">
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
                            <input type="text" class="form-control" name="class_id" value="{{$class->id}}"  hidden>
                             <label for="name" class="form-label">Subject Name <span class="required">*</span></label>
                             <input type="text" class="form-control" name="name" value="" required>
                        </div>
                       <div class="my-3">
                            <label for="minimum_score" class="form-label">Minimum Score <span class="required">*</span></label>
                            <input type="number" class="form-control" name="minimum_score" required>
                        </div>
                        <div class="my-3">
                             <label for="teacher_id" class="form-label">Teacher <span class="required">*</span></label>
                             <select name="teacher_id" class="form-select" required>
                                  <option value="" selected>--Please Choose--</option>
                                  @foreach ($teachersNotAssigned as $teacher)
                                      <option value="{{$teacher->id}}">{{$teacher->nuptk}} - {{$teacher->name}}</option>
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

    @foreach($classSubjects as $subject)
        <div class="modal fade" id="updateSubject{{ $subject->id }}" tabindex="-1" aria-labelledby="updateSubject"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="submitLabel">Edit Subject and Teacher</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin-class-update-subject', $subject->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="">
                              <label for="school_year" class="form-label">School Year</label>
                                <input type="text" class="form-control" name="school_year" value="{{$schoolYear->year}} - {{$schoolYear->semester}}" readonly>
                            </div>
                            <div class="my-3">
                                <label for="class_name" class="form-label">Class</label>
                                <input type="text" class="form-control" name="class_name" value="{{$class->name}}"  readonly>
                            </div>
                            <div class="my-3">
                                <input type="text" class="form-control" name="class_id" value="{{$class->id}}"  hidden>
                                 <label for="name" class="form-label">Subject Name <span class="required">*</span></label>
                                 <input type="text" class="form-control" name="name" value="{{$subject->name}}" required>
                            </div>
                           <div class="my-3">
                                <label for="minimum_score" class="form-label">Minimum Score <span class="required">*</span></label>
                                <input type="number" class="form-control" name="minimum_score"  value="{{$subject->minimum_score}}" required>
                            </div>
                            <div class="my-3">
                                 <label for="teacher_id" class="form-label">Teacher <span class="required">*</span></label>
                                 <select name="teacher_id" class="form-select" required>
                                      <option value="" selected>--Please Choose--</option>
                                      <option value="{{$subject->teacherId}}" selected>{{$subject->teacherNuptk}} - {{$subject->teacherName}}</option> 
                                      @foreach ($teachersNotAssigned as $teacher)
                                          <option value="{{$teacher->id}}">{{$teacher->nuptk}} - {{$teacher->name}}</option>
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