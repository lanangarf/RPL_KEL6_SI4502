<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 65px;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,);
            
        }
        .navbar-brand {
            
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md bg-light fixed-top">
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
        </div>
    </nav>
    
    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
