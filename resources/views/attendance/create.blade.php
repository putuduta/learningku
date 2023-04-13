<x-app title="Attendance - {{ $classSubject->name }} {{ $classSubject->className }}">

    <x-slot name="navbar"></x-slot>

    <div id="content" class="container my-5 py-5">
        <div class="mb-3">
            <span class="fa-stack fa-md ms-n1">
                <i class="fas fa-circle fa-stack-2x text-orange"></i>
                <a href="{{ url()->previous() }}" class="fas fa-arrow-left fa-stack-1x fa-inverse text-light" style="text-decoration: none;"></a>
            </span>
        </div>
        <div class="">
            <div class="">
                <h3>Attendance - Subject {{ $classSubject->name }}</h3>
                <h5>{{ $classSubject->className }} - {{ $classSubject->schoolYear }} {{ $classSubject->semester }}</h5>
                <hr>
                <form action="{{ route('attendance.create') }}" method="POST">
                    @csrf
                    <div class="my-3">
                        <label for="class_name" class="form-label">Date</label>
                        <input type="text" value="{{ date_format(date_create(date('y-m-d')),"d F Y") }}"
                            class="form-control" name="date_today" readonly>
                    </div>
                    <hr>
                    <div class="my-3">
                        <input type="checkbox" onClick="presentAll(this)" class="presentAll mb-3"> Present all
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="table-dark">
                                    <th class="align-middle text-center">No</th>
                                    <th class="align-middle text-center">NISN</th>
                                    <th class="align-middle text-center">Student Name</th>
                                    <th class="align-middle text-center">Present</th>
                                    <th class="align-middle text-center">Sick</th>
                                    <th class="align-middle text-center">Absence Permit</th>
                                    <th class="align-middle text-center">Absent</th>
                                </thead>
                                <tbody>
                                    @foreach($class_details as $index=>$student)
                                    <tr>
                                        <td class="align-middle text-center">{{ $index+1 }}</td>
                                        <td class="align-middle text-center">{{ $student->studentNisn }}</td>
                                        <td class="align-middle text-center">{{ $student->studentName }}</td>
                                        <td class="align-middle text-center">
                                            <input type="checkbox" value="1" class="form-check-input attend radio"
                                                name="present-{{$student->studentId}}">
                                        </td>
                                        <td class="align-middle text-center">
                                            <input type="checkbox" value="1" class="form-check-input radio"
                                                name="sick-{{$student->studentId}}">
                                        </td>
                                        <td class="align-middle text-center">
                                            <input type="checkbox" value="1" class="form-check-input radio"
                                                name="absencePermit-{{$student->studentId}}">
                                        </td>
                                        <td class="align-middle text-center">
                                            <input type="checkbox" value="1" class="form-check-input radio"
                                                name="absent-{{$student->studentId}}">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <input type="hidden" name="class_subject_id" value="{{ $classSubject->id }}">
                    <button type="submit" class="btn btn-primary text-white">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app>

<script>
    function presentAll(source) {
        //uncheck all checkbox
        allCheckbox = document.getElementsByClassName('form-check-input');
        for (var i = 0, n = allCheckbox.length; i < n; i++) {
            allCheckbox[i].checked = source.unchecked;
        }

        checkboxes = document.getElementsByClassName('attend');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }

    $("input:checkbox").on('click', function() {
        var box = $(this);
        if (box.is(":checked")) {
            if(box.attr('class') != 'presentAll mb-3'){
                var studentId = box.attr("name").split('-')[1];
            }

            var groupPresent = "input:checkbox[name=present-" + studentId + "]";
            var groupSick = "input:checkbox[name=sick-" + studentId + "]";
            var groupAbsencePermit = "input:checkbox[name=absencePermit-" + studentId + "]";
            var groupAbsent = "input:checkbox[name=absent-" + studentId + "]";
            
            $(groupPresent).prop("checked", false);
            $(groupSick).prop("checked", false);
            $(groupAbsencePermit).prop("checked", false);
            $(groupAbsent).prop("checked", false);
            box.prop("checked", true);
        }else{
            box.prop("checked", false);
        }
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="script.js"></script>