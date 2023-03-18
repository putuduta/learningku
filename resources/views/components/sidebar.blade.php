<nav id="sidebar" class="sidebar-wrapper h-100 mh-100 fixed-top bg-dark text-white pr-0">
    <div class="sidebar-content">
        <div class="sidebar-brand d-flex align-items-center px-lg-4" style="padding: 0.5rem 1rem;">
            <span class="text-white me-3" id="close-sidebar" style="cursor: pointer;">
                <h2>☰</h2>
            </span>
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <h2 class="text-white">LEARNINGKU</h2>
            </a>
        </div>
        <div class="sidebar-header border-top border-gray" style="height: 139px; padding: 0.5rem 1rem;">
            <div class="d-flex flex-column align-items-center justify-content-center text-center">
                <img src="/storage/assets/man.svg" class="rounded border-teal w-25 rounded-circle bg-color-lightblue"
                    alt="">
                <span class="mt-1">{{ auth()->user()->name }}</span>
                <small class="text-secondary">{{ auth()->user()->role->name}}</small>
            </div>
        </div>
        <div class="sidebar-menu border-top border-gray overflow-auto" style="height: calc(100% - 196px);">
            <ul class="list-unstyled m-0 py-1">
                <li class="side-item">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{ route('dashboard') }}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-circle fa-stack-2x text-orange"></i>
                            <i class="fas fa-info fa-stack-1x fa-inverse text-dark"></i>
                        </span>
                        <span class="ms-2">Main Dashboard</span>
                    </a>
                </li>
                @if (auth()->user()->role->name == 'Admin')
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="{{ route('student-view-list') }}">
                            <span class="fa-stack fa-sm ms-n1">
                            </span>
                            <span class="ms-2">Student List</span>
                        </a>
                    </li>
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="{{ route('admin-teacher-view') }}">
                            <span class="fa-stack fa-sm ms-n1">
                            </span>
                            <span class="ms-2">Teacher List</span>
                        </a>
                    </li>
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="{{ route('admin-school-year-view') }}">
                            <span class="fa-stack fa-sm ms-n1">
                            </span>
                            <span class="ms-2">School Year List</span>
                        </a>
                    </li>
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="{{ route('admin-class-view-choose-school-year') }}">
                            <span class="fa-stack fa-sm ms-n1">
                            </span>
                            <span class="ms-2">Class List</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->role->name == 'Student')
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="#" role="button" id="dropdownMenuLink">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-circle fa-stack-2x text-orange"></i>
                                <i class="fas fa-calendar fa-stack-1x fa-inverse text-dark"></i>
                            </span>
                            <span class="ms-2">Class List</span>
                        </a>

                        <ul id="dropdownMenu" style="list-style-type: none;" aria-labelledby="dropdownMenuLink">
                            @foreach ($classes as $class)
                                <li style="background-color: grey;"><a class="dropdown-item" href="{{ route('dashboard-class', $class->id)}}">{{ $class->name }} - {{ $class->semester }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endif
                @if (auth()->user()->role->name == 'Teacher')
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="{{ route('class-view-list') }}">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-circle fa-stack-2x text-orange"></i>
                                <i class="fas fa-calendar fa-stack-1x fa-inverse text-dark"></i>
                            </span>
                            <span class="ms-2">Class & Subject List</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <div class="sidebar-footer bg-danger">
        <a href="{{ route('logout') }}" class="text-decoration-none text-white"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span class="mr-1"><i class="fa fa-sign-out-alt text-white"></i></span> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</nav>



