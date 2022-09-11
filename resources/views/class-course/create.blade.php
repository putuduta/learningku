<x-app title="Create Class Course - {{ auth()->user()->institution->name }}">

     <x-slot name="navbar"></x-slot>
 
     <div id="content" class="container my-5 py-5">
         <div class="row justify-content-center">
             <div class="col-md-8">
                 <h3>Create Class Course - {{ auth()->user()->institution->name }}</h3>
                 <hr>
                 <form action="{{ route('class-course.create') }}" method="POST">
                     @csrf
                     <div class="my-3">
                         <label for="class_id" class="form-label">Class</label>
                         <select name="class_id" id="class_id" class="form-select">
                              @foreach ($classes as $class)
                                   <option value="{{$class->id}}">{{$class->name}}</option>
                              @endforeach
                         </select>
                     </div>
                     <div class="my-3">
                         <label for="course_id" class="form-label">Course</label>
                         <select name="course_id" id="course_id" class="form-select">
                              @foreach ($courses as $course)
                                   <option value="{{$course->id}}">{{$course->name}}</option>
                              @endforeach
                         </select>
                     </div>
                     <div class="my-3">
                         <label for="teacher_id" class="form-label">Teacher</label>
                         <select name="teacher_id" id="course_id" class="form-select">
                              @foreach ($teachers as $teacher)
                                   <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                              @endforeach
                         </select>
                     </div>
                     <div class="my-3">
                         <label for="day" class="form-label">Day</label>
                         <select name="day" id="day" class="form-select">
                              <option value="MON">Monday</option>
                              <option value="TUE">Tuesday</option>
                              <option value="WED">Wednesday</option>
                              <option value="THU">Thursday</option>
                              <option value="FRI">Friday</option>
                              <option value="SAT">Saturday</option>
                              <option value="SUN">Sunday</option>
                         </select>
                     </div>
                     <div class="my-3">
                         <label for="start_time" class="form-label">Start Time</label>
                         <input type="time" name="start_time" id="start_time" class="form-control">
                     </div>
                     <div class="my-3">
                         <label for="end_time" class="form-label">End Time</label>
                         <input type="time" name="end_time" id="end_time" class="form-control">
                     </div>

                     <button type="submit" class="btn btn-primary text-white mt-4">Submit</button>
                 </form>
             </div>
         </div>
     </div>
 </x-app>
 