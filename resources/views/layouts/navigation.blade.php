<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="d-flex">
    <!-- Sidebar -->
    <nav id="sidebar" class="shadow-sm vh-100 position-fixed">
        <div class="sidebar-header text-center py-4">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('storage/images/nia-logo.png') }}" class="h-12 w-auto" alt="NIA">
            </a>
            <h5 class="mt-2">File Management</h5>
        </div>

        <ul class="list-unstyled components">
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="fa-solid fa-chart-line me-2"></i> Dashboard
                </a>
            </li>
            <li class="{{ request()->routeIs('files.index') ? 'active' : '' }}">
                <a href="{{ route('files.index') }}">
                    <i class="fa-solid fa-folder me-2"></i> Files
                </a>
            </li>
            {{-- <li class="{{ request()->routeIs('files.boxes') ? 'active' : '' }}">
                <a href="{{ route('files.boxes') }}">
                    <i class="fa-solid fa-square-plus me-2"></i> Add Box
                </a>
            </li> --}}
        </ul>

        <!-- User Section -->
        <div class="sidebar-footer p-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-user-circle me-2"></i>
                <span>{{ ucwords(strtolower(Auth::user()->name)) }}</span>
            </div>
            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button id="logout-btn" class="btn btn-link text-danger p-0" type="button" title="Log Out">
                    <i class="fa-solid fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </nav>
    <!-- Main Content -->
    <div class="content">
        @yield('content')
    </div>
</div>

<script>
   document.getElementById("logout-btn").addEventListener("click", function () {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to logout",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes",
            background: "#ffe6e6",
            color: "#000000" 
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("logout-form").submit();
            }
        });
    });

</script>
