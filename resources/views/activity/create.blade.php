<x-app title="Create Activity - {{ auth()->user()->institution->name }}">

     <x-slot name="navbar"></x-slot>
 
     <div id="content" class="container my-5 py-5">
         <div class="row justify-content-center">
             <div class="col-md-8">
                 <h3>Create Activity</h3>
                 <hr>
                 <form action="{{ route('activity.create') }}" method="POST">
                     @csrf
                     <div class="my-3">
                         <label for="class_name" class="form-label">Date</label>
                         <input type="date" class="form-control" name="date" id="date">
                     </div>
                     <div class="my-3">
                         <label for="class_name" class="form-label">Class Course</label>
                         <select name="class_course_id" id="class_course_id" class="form-select">
                              @foreach ($class_courses as $class_course)
                                   <option value="{{ $class_course->id }}">{{$class_course->class->name}} - {{ $class_course->course->name}}</option>
                              @endforeach
                         </select>
                     </div>
                     <div class="my-3">
                         <label for="description" class="form-label">Description</label>
                         <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                     </div>
                     <button type="submit" class="btn btn-primary text-white mt-4">Submit</button>
                 </form>
             </div>
         </div>
     </div>
 </x-app>