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
                        @if (auth()->user()->role->name != 'Owner')
                        <p>{{ auth()->user()->role->name }} of {{ auth()->user()->institution->name }}</p>
                        @else
                        Owner of L-Man
                        @endif
                        <hr>
                    </div>           
                </div>
            </div>
        </div>
    </div>

    @if (auth()->user()->role->name == 'Admin')
        @include('dashboard.admin')
    @elseif(auth()->user()->role->name == 'Teacher')
        @include('dashboard.teacher')
    @elseif(auth()->user()->role->name == 'Student')
        @include('dashboard.student')
    @elseif(auth()->user()->role->name == 'Owner')
        @include('dashboard.owner')
    @endif
</x-app>
