<x-app title="Student List - Learningku">
     <x-slot name="navbar"></x-slot>
 
     <section id="headerClassSubject">
         <div id="content" class="container pt-5 mt-5">
             <div class="mb-3">
                 <span class="fa-stack fa-md ms-n1">
                     <i class="fas fa-circle fa-stack-2x text-orange"></i>
                     <a href="{{ url()->previous() }}" class="fas fa-arrow-left fa-stack-1x fa-inverse text-light" style="text-decoration: none;"></a>
                 </span>
             </div>
 
             <div class="card shadow-sm border-0 mb-3">
                 <div class="card-body">
                     <div class="row align-items-center">
                         <div class="col-md-10">
                             <h1 class="fw-bold">Mata Pelajaran {{ $classSubject->name }}</h1>
                             <h3>Kelas {{ $classSubject->className }} - {{ $classSubject->schoolYear }} {{ $classSubject->semester }}</h3>
                             <h5>Guru Pengajar {{ $classSubject->teacherName }} </h5>
                         </div>           
                     </div>
                 </div>
             </div>
     
             <nav class="" style="font-size:1.25rem">
                 {{-- <div class="container"> --}}
                     <ul class="nav nav-tabs">
                         @if (auth()->user()->role->name == 'Teacher')
                             <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Material</a></li>
                             <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forum</a></li>
                             <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignment</a></li>
                             <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.manage', $classSubject->id ) }}">Score</a></li>
                             <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view', $classSubject->id ) }}">Daily Attendance</a></li>
                             <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('class-view-student', $classSubject->id ) }}">Students</a></li>
                         @endif
         
                         @if (auth()->user()->role->name == 'Student')
                             <li class="nav-item"><a class="nav-link active" style="color: black" href="{{ route('material.index', $classSubject->id)}}">Material</a></li>
                             <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('forum.index', $classSubject->id ) }}">Forum Discussion</a></li>
                             <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('assignment.index', $classSubject->id ) }}">Assignment</a></li>
                             <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('score.index', $classSubject->id ) }}">Score</a></li>
                             <li class="nav-item"><a class="nav-link" style="color: black" href="{{ route('attendance.view', $classSubject->id ) }}">Attendances</a></li>
                         @endif
                     </ul>
                 {{-- </div> --}}
             </nav>
         </div>
     </section>
 
     <div id="content" class="container my-3">
          <div class="table-responsive pt-2">
               <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                         <th class="align-middle text-center">ID</th>
                         <th class="align-middle text-center">NISN</th>
                         <th class="align-middle text-center">Student Name</th>
                    </thead>
                    <tbody>
                         @foreach ($students as $student)
                              <tr>
                                   <td class="align-middle text-center">{{$student->id}}</td>
                                   <td class="align-middle text-center">{{$student->nisn}}</td>
                                   <td class="align-middle text-center">{{$student->name}}</td>
                              </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div>
 </x-app>