<x-app title="View Class List">

    <div id="content" class="container my-5 py-5">
         <div class="row justify-content-center">
              <div class="col-md-6">
               <h3 class="fw-bold">Class List</h3>
                   <form method="POST" action="{{route('admin-class-post-choose-school-year')}}">
                        @csrf
                        <div class="my-3">
                             <label for="school_year_id" class="form-label">School Year/Tahun Ajaran</label>
                             <select name="school_year_id" class="form-select" required>
                                  @foreach ($schoolYears as $schoolYear)
                                      <option value="{{$schoolYear->school_year_id}}">{{$schoolYear->year}} - {{$schoolYear->semester}}</option>
                                  @endforeach
                             </select>
                        </div>
                        <button type="submit" class="btn btn-primary text-white mt-4">Submit</button>
                   </form>
              </div>
         </div>
    </div>
</x-app>