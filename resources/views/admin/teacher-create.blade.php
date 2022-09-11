<x-app title="Create Teacher - {{auth()->user()->institution->name}}">

     <x-slot name="navbar"></x-slot>

     <div id="content" class="container my-5 py-5">
          <div class="row justify-content-center">
               <div class="col-md-6">
                    <h3>Create Teacher - {{auth()->user()->institution->name}}</h3>
                    <hr>
                    <form action="{{route('teacher-create')}}">
                         @csrf
                         <div class="my-3">
                              <label for="name" class="form-label">Teacher Name</label>
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
                         <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </form>
               </div>
          </div>
     </div>
</x-app>