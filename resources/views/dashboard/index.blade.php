<x-app title="Dashboard - L-Man">

    <div id="content" class="container pt-5 mt-5">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body m-3">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <img src="/storage/assets/man.svg" width="100%" alt="" class="rounded-circle bg-color-lightblue">
                    </div>
                    <div class="col-md-10">
                        <h1 class="fw-bold">Welcome, {{ auth()->user()->name }}</h1>
                        <p>{{ auth()->user()->role }}</p>
                        <hr>
                    </div>           
                </div>
            </div>
        </div>
    </div>

    @if (auth()->user()->role == 'Admin')
        @include('dashboard.admin')
    @elseif(auth()->user()->role == 'Teacher')
        @include('dashboard.teacher')
    @elseif(auth()->user()->role == 'Student')
        @include('dashboard.student')
    @endif
</x-app>
