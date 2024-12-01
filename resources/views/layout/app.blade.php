<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WebApp - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="py-2 col-lg-12 bg-primary">
                <div class="dropdown float-end">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        User
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="/images/sample.jpg" width="50px" height="50px" alt="...">
                                    </div>
                                    <div class="media-body ms-2">
                                        <div class="mt-0 fs-5">{{ Auth::user()->name ?? 'Guest' }}</div>
                                        <div class="fs-6"><i class="bi bi-clock-history"></i> Pkl. 13:00 WIB</div>
                                    </div>
                                </div>
                            </a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
                        <li><a class="dropdown-item" href="/logout"><i class="bi bi-box-arrow-right"></i> Log-out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="pt-4 border col-lg-2">
                <nav class="nav flex-column">
                    <a class="nav-link {{ $key == 'home' ? 'bg-primary border rounded-pill text-light' : '' }}"
                        href="/home" role="tab">Home</a>
                    <a class="nav-link {{ $key == 'user' ? 'bg-primary border rounded-pill text-light' : '' }}"
                        href="/user" role="tab">Users</a>
                    <a class="nav-link {{ $key == 'student' ? 'bg-primary border rounded-pill text-light' : '' }}" href="/student" role="tab">Student</a>
                    <a class="nav-link" href="#" role="tab">Report</a>
                </nav>
            </div>
            <div class="mt-4 col-lg-10 vh-100">
                <div class="card">
                    <div class="card-body">
                        {{-- Content Article --}}
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
