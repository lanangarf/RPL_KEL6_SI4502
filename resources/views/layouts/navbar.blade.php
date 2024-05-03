<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Dash</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @if(Auth::check())
                    @switch(Auth::user()->role)
                        @case('admin')
                            @include('layouts.navbars.admin')
                            @break
                        @case('applicant')
                            @include('layouts.navbars.applicant')
                            @break
                        @case('recruiter')
                            @include('layouts.navbars.recruiter')
                            @break
                        @default
                            {{-- Default navbar or guest links --}}
                            <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    @endswitch
                @endif
            </ul>
        </div>