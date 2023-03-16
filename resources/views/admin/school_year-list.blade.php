<x-app title="Class List - L-Man">
    <x-slot name="navbar"></x-slot>

    <div id="content" class="container py-5 my-5">
        <button type="button" class="btn btn-primary text-white mb-3" data-bs-toggle="modal"
        data-bs-target="#newSchoolYear">
        Create School Year
        </button>
         <div class="table-responsive">
              <table class="table table-hover">
                   <thead>
                        <th class="align-middle text-center">ID</th>
                        <th class="align-middle text-center">Year</th>
                        <th class="align-middle text-center">Semester</th>
                        <th class="align-middle text-center">Action</th>
                   </thead>
                   <tbody>
                        @foreach ($shoolYears as $shoolYear)
                             <tr>
                                  <td class="align-middle text-center">{{$schoolYear->id}}</td>
                                  <td class="align-middle text-center">{{$schoolYear->name}}</td>
                                  <td class="align-middle text-center">{{$schoolYear->semester}}</td>
                                  <td class="align-middle text-center">
                                    <button type="button" class="btn btn-primary text-white justify-content-between" data-bs-toggle="modal"
                                    data-bs-target="#updateSchoolYear{{ $schoolYear->id }}">
                                        Update
                                    </button>
                                  </td>
                             </tr>
                        @endforeach
                   </tbody>
              </table>
         </div>
   


        <div class="modal fade" id="newSchoolYear" tabindex="-1" aria-labelledby="newSchoolYear"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="submitLabel">Create New School Year</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            @csrf
                            <div class="my-3">
                                 <label for="year" class="form-label">Year</label>
                                 <input type="text" class="form-control" name="year" required>
                            </div>
                            <div class="my-3">
                                 <label for="semester" class="form-label">Semester</label>
                                 <select name="semester" class="form-select" required>
                                    <option selected>--Please Choose--</option>
                                    <option value="Semester 1">Semester 1</option>
                                    <option value="Semester 2">Semester 2</option>
                                 </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
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
                            <h5 class="modal-title" id="submitLabel">Update School Year</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <input value="{{ $schoolYear->id }}" type="text" class="form-control" name="schoolYear_id" id="schoolYear_id" hidden>
                                <div class="my-3">
                                    <label for="year" class="form-label">Year</label>
                                    <input type="text" class="form-control" value="{{ $schoolYear->year }}" name="year" required>
                               </div>
                               <div class="my-3">
                                    <label for="semester" class="form-label">Semester</label>
                                    <select name="semester" class="form-select" required>
                                       <option selected>--Please Choose--</option>
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

