<nav class="navbar navbar-expand-lg" style="background-color: #004080;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Dash.</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                @if(Auth::check())
                    @switch(Auth::user()->role)
                        @case('admin')
                            <li class="nav-item"><a class="nav-link active" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.accounts') }}">Accounts</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.jobs') }}">Jobs</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.events') }}">Events</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.webinars') }}">Webinars</a></li>
                            @break
                        @case('applicant')
                            <li class="nav-item"><a class="nav-link active" href="{{ route('applicant.dashboard') }}" style="color: white;">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('applicant.jobs.index') }}" style="color: white;">Jobs</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('applicant.events.index') }}" style="color: white;">Events</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('webinars.index') }}" style="color: white;">Webinars</a></li>
                            @break
                        @case('recruiter')
                            <li class="nav-item"><a class="nav-link active" href="{{ route('recruiter.dashboard') }}" style="color: white;">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('recruiter.jobs.index') }}" style="color: white;">My Jobs</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('recruiter.events.index') }}" style="color: white;">My Events</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('webinars.index') }}" style="color: white;">My Webinars</a></li>
                            @break
                        @default
                            <li class="nav-item"><a class="nav-link" href="#" style="color: white;">Home</a></li>
                    @endswitch
                @endif
            </ul>
            @if(Auth::check())
                <ul class="navbar-nav ms-auto">
                    @if(Auth::user()->role === 'applicant')
                        <li class="nav-item"><a class="nav-link" href="{{ route('applicant.profile') }}" style="color: white;">Profile</a></li>
                    @elseif(Auth::user()->role === 'recruiter')
                        <li class="nav-item"><a class="nav-link" href="{{ route('recruiter.profile') }}" style="color: white;">Profile</a></li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); showLogoutModal();" style="color: white;">Logout</a>
                    </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}" style="color: white;">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}" style="color: white;">Register</a></li>
                </ul>
            @endif
        </div>
    </div>
</nav>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('logout-form').submit();">Logout</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showLogoutModal() {
        var logoutModal = new bootstrap.Modal(document.getElementById('logoutModal'), {
            keyboard: false
        });
        logoutModal.show();
    }
</script>
