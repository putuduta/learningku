<x-app title="Create Class - {{auth()->user()->institution->name}}">

     <x-slot name="navbar"></x-slot>

     <div id="content" class="container my-5 py-5">
          <div class="row justify-content-center">
               <div class="col-md-6">
                    <h3>Create Student - {{auth()->user()->institution->name}}</h3>
                    <hr>
                    <form action="{{route('student-create')}}">
                         @csrf
                         <div class="my-3">
                              <label for="name" class="form-label">Student Name</label>
                              <input type="text" class="form-control" name="name" required>
                         </div>
                         <div class="my-3">
                              <label for="class_name" class="form-label">Email</label>
                              <input type="email" class="form-control" name="email" required>
                         </div>
                         <div class="my-3">
                              <label for="reg_number" class="form-label">Registration Number</label>
                              <input type="text" class="form-control" name="reg_number" required>
                         </div>
                         <div class="my-3">
                              <label for="phone_number" class="form-label">Phone Number</label>
                              <input type="text" class="form-control" name="phone_number" required>
                         </div>
                         <div class="my-3">
                              <label for="class_id" class="form-label">Class</label>
                              <select name="class_id" class="form-select" required>
                                   @foreach ($classes as $class)
                                       <option value="{{$class->id}}">{{$class->name}}</option>
                                   @endforeach
                              </select>
                         </div>
                         <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </form>
               </div>
          </div>
     </div>
</x-app>