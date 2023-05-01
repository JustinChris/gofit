<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous" defer></script>
    <title>GoFit</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

    </style>
</head>
<body style="overflow-x: hidden;">
    <nav class="navbar navbar-expand-lg" style="background-color: rgb(44, 44, 44);">
        <div class="container-fluid">
            <a class="navbar-brand" href="/" style="color: white;">GoFit</a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/dashboard" >Dashboard</a>
                    </li>

                    @if ($user->role == "admin")
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/instructors">Instructors</a>
                        </li>
                    @endif

                    @if ($user->role == "kasir" || $user->role == "admin")
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/members">Members</a>
                        </li>
                    @endif

                    @if ($user->role == "mo" || $user->role == "admin")
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/schedule">Schedule</a>
                        </li>
                    @endif

                    
                </ul>
            </div>
        </div>
        <div class="d-flex">
            <a href="/logout" class="btn btn-outline-success" style="margin-right: 30px;">Sign Out</a>
        </div>
    </nav>

    <div>
        @yield('content')
    </div>

</body>
</html>