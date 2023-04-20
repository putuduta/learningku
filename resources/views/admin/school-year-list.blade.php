<x-app title="School Year List - L-Man">
    <x-slot name="navbar"></x-slot>

    <div id="content" class="container py-5 my-5">
        <h3 class="fw-bold">School Year List</h3>
        <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
        data-bs-target="#newSchoolYear">
        Add School Year
        </button>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                        <th class="align-middle text-center">No</th>
                        <th class="align-middle text-center">Year</th>
                        <th class="align-middle text-center">Semester</th>
                        <th class="align-middle text-center" colspan="3">Action</th>
                   </thead>
                   <tbody>
                        @foreach ($schoolYears as $index => $schoolYear)
                             <tr>
                                  <td class="align-middle text-center">{{$index+1}}</td>
                                  <td class="align-middle text-center">{{$schoolYear->year}}</td>
                                  <td class="align-middle text-center">{{$schoolYear->semester}}</td>
                                  <td class="align-middle text-center">
                                    <button type="button" class="btn btn-primary text-white justify-content-between" data-bs-toggle="modal"
                                    data-bs-target="#updateSchoolYear{{ $schoolYear->id }}">
                                        Edit School Year
                                    </button>
                                    <a href="{{route('admin-class-view', $schoolYear->id)}}"
                                    class="btn btn-success  text-white justify-content-between">Class List</a>

                                    <button type="button" class="btn btn-danger text-white justify-content-between"
                                        data-bs-toggle="modal"
                                        data-bs-target="#delete-{{ $schoolYear->id }}">
                                        Remove
                                   </button>
                                  </td>
                             </tr>
                        @endforeach
                   </tbody>
              </table>
         </div>
   
         @foreach ($schoolYears as $schoolYear)
         <div class="modal fade show pr-0" style="z-index: 9999;" id="delete-{{ $schoolYear->id }}"
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
                                     <form action="{{ route('admin-school-year-remove', $schoolYear->id) }}"
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

        <div class="modal fade" id="newSchoolYear" tabindex="-1" aria-labelledby="newSchoolYear"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="submitLabel">Add School Year</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin-school-year-create') }}">
                            @csrf
                            <div class="my-3">
                                 <label for="year" class="form-label">Year <span class="required">*</span></label>
                                 <input type="number" class="form-control" name="year" min="2023" required>
                            </div>
                            <div class="my-3">
                                 <label for="semester" class="form-label">Semester <span class="required">*</span></label>
                                 <select name="semester" class="form-select" required>
                                    <option value="" selected>--Please Choose--</option>
                                    <option value="Semester 1">Semester 1</option>
                                    <option value="Semester 2">Semester 2</option>
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

        @foreach($schoolYears as $schoolYear)
            <div class="modal fade" id="updateSchoolYear{{ $schoolYear->id }}" tabindex="-1" aria-labelledby="updateSchoolYear"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="submitLabel">Edit School Year</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin-school-year-update', $schoolYear->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="my-3">
                                    <label for="year" class="form-label">Year <span class="required">*</span></label>
                                    <input type="text" class="form-control" value="{{ $schoolYear->year }}" name="year" required>
                               </div>
                               <div class="my-3">
                                    <label for="semester" class="form-label">Semester <span class="required">*</span></label>
                                    <select name="semester" class="form-select" required>
                                       <option value="" selected>--Please Choose--</option>
                                       <option value="Semester 1" {{($schoolYear->semester === 'Semester 1') ? 'selected' : ''}}>Semester 1</option>
                                       <option value="Semester 2" {{($schoolYear->semester === 'Semester 2') ? 'selected' : ''}}>Semester 2</option>
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

