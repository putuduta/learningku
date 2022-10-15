<x-app title="Class Course List - Learningku">
     <x-slot name="navbar"></x-slot>
 
     <div id="content" class="container py-5 my-5">
         <h3 class="fw-bold">Class Course List - {{ auth()->user()->institution->name }}</h3>
         <hr>
         <a href="{{ route('class-course.view-create') }}"
             class="btn btn-primary text-white mb-3">Add Class Course</a>
         <div class="table-responsive">
             <table class="table table-hover table-bordered">
                 <thead class="table-dark">
                     <th class="align-middle text-center">ID</th>
                     <th class="align-middle text-center">Class</th>
                     <th class="align-middle text-center">Course</th>
                     <th class="align-middle text-center">Teacher</th>
                     <th class="align-middle text-center">Day</th>
                     <th class="align-middle text-center">Start Time</th>
                     <th class="align-middle text-center">End Time</th>
                     <th class="align-middle text-center">Action</th>
                 </thead>
                 <tbody>
                     @foreach($class_courses as $class_course)
                         <tr>
                             <td class="align-middle text-center">{{ $class_course->id }}</td>
                             <td class="align-middle text-center">{{ $class_course->class->name }}</td>
                             <td class="align-middle text-center">{{ $class_course->course->name }}</td>
                             <td class="align-middle text-center">{{ $class_course->teacher->name }}</td>
                             <td class="align-middle text-center">{{ $class_course->day }}</td>
                             <td class="align-middle text-center">{{ $class_course->start_time }}</td>
                             <td class="align-middle text-center">{{ $class_course->end_time }}</td>
                             <td class="align-middle text-center">
                                 <a href="{{route('class-course.delete',$class_course)}}" class="btn btn-danger btn-sm text-white">
                                     Delete
                                 </a>
                             </td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
     </div>
 </x-app>