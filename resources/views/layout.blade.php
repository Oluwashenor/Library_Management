<!DOCTYPE html>
<html class="h-100">

<?php
$appName = "Library Management";
?>

<head>
    <title>{{$appName}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">

    <style>
        body {
            font-family: "ui-sans-serif", sans-serif;
            background-color: #F3F4F6;
        }

        .nav-item {
            margin: 0 6px;
        }

        .titleLayer {
            padding-top: 9px;
            height: calc(2 * 64px);
            background-color: white;
        }

        .myNav {
            background-color: white;
            border-bottom: 0.5px solid #cccccc;
        }

        .titleHeader {
            font-size: 140%;
            text-align: left;
            margin-top: 20px;
            margin-left: 15px;
            font-weight: bold;
        }

        .content {
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            min-height: 100px;
            margin-top: 4%;
            background-color: white;
            border-radius: 10px;
            padding-top: 20px;

        }

        /* .btn-primary {
            border: 1px solid #8d448b !important;
            color: #fff !important;
        } */
    </style>
</head>


<body class="d-flex flex-column h-100">
    <div class="titleLayer">
        <nav class="navbar navbar-expand-lg myNav">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">{{$appName}}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @auth
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @if(Session::get('role') == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="/elections">Elections</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/ninserver">NIN SERVER</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="/books">Books</a>
                        </li>
                    </ul>
                    <div class="d-flex" role="search">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li style="float: right;" class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ auth()->user()->name }}
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/profile/{{Auth::user()->email}}">Profile</a>
                                    </li>
                                    <li><a class="dropdown-item" href="/logout">Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                @endauth

            </div>
        </nav>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight titleHeader">
            {{$title ?? "Dashboard"}}
        </h2>
    </div>
    @yield('content')

</body>

<footer style="bottom:0" class="footer mt-auto py-3 bg-light">
    <div class="container" style="text-align: center;">
        <span class="text-muted">&copy; {{$appName}} 2023</span>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js" integrity="sha512-i9cEfJwUwViEPFKdC1enz4ZRGBj8YQo6QByFTF92YXHi7waCqyexvRD75S5NVTsSiTv7rKWqG9Y5eFxmRsOn0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@include('sweetalert::alert')

</html>