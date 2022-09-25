<x-app title="Create Class">

     <x-slot name="navbar"></x-slot>

     <div id="content" class="container my-5 py-5">
          <div class="row justify-content-center">
               <div class="col-md-6">
                    <h3>Create Class</h3>
                    <hr>
                    <form action="{{route('class-create')}}">
                         @csrf
                         <div class="my-3">
                              <label for="class_name" class="form-label">Class Name</label>
                              <input type="text" class="form-control" name="class_name" required>
                         </div>
                         
                         <div class="my-3">
                              <label for="class_description" class="form-label">Description</label>
                              <input type="text" class="form-control" name="class_description" required>
                         </div>
                         <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </form>
               </div>
          </div>
     </div>
</x-app>