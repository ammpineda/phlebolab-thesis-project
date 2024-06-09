<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <!-- Styles -->
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);
        body {
            margin: 0;
            padding: 0;
        }
        .top-bar {
            display: none;
            background-color: #25396d;
            padding: 10px;
            justify-content: space-between;
            align-items: center;
        }
        .top-bar h1 {
            color: whitesmoke;
            margin: 0;
        }
        .toggle-btn {
            cursor: pointer;
            background-color: #25396d;
            padding: 5px;
            border-radius: 5px;
            display: none;
        }
        .toggle-btn span {
            background-color: whitesmoke;
            display: block;
            height: 3px;
            width: 25px;
            margin-bottom: 5px;
        }
        .sidebar {
            height: 100vh;
            background-color: #25396d;
            padding-top: 20px;
            position: fixed;
            width: 250px;
            text-align: center;
            color: whitesmoke;
            transition: width 0.3s;
            z-index: 2;
        }
        .sidebar a {
            display: block;
            padding: 15px;
            padding-left: 50px;
            color: whitesmoke;
            text-decoration: none;
            text-align: left;
            margin: 1px;
        }
        .sidebar a:hover {
            background-color: #35B0E2;
            color: #fff;
        }
        .logo img {
            width: 100%;
            max-width: 200px;
            margin-bottom: 20px;
        }
        .logout {
            position: absolute;
            bottom: 20px;
            width: 100%;
            margin-bottom: 10px;
        }
        .logout a {
            display: block;
            padding: 15px;
            padding-left: 50px;
            color: white;
            text-decoration: none;
            text-align: left;
            margin: 1px;
        }
        .logout a:hover {
            background-color: #35B0E2;
            color: white;
        }
        @media screen and (max-width: 768px) {
            .top-bar {
                display: flex;
            }
            .toggle-btn {
                display: block;
            }
            .sidebar {
                width: 0;
                overflow: hidden;
            }
            .sidebar.show {
                width: 250px;
            }
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <div class="toggle-btn" onclick="toggleSidebar()">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar">
        <div class="logo">
            <img src="{{asset('assets/images/phlebolab_logo.png')}}" alt="Logo">
        </div>
        <a href="{{ route('management-home') }}"><i class="fas fa-home"></i> Home</a>
        <a href="{{ route('management-users') }}"><i class="fas fa-pen"></i> Manage Users</a>
        <a href="{{ route('management-materials') }}"><i class="fas fa-book"></i> Manage Materials</a>
        <a href="{{ route('management-laboratory') }}"><i class="fas fa-flask"></i> Manage 2D Laboratory</a>
        <a href="{{ route('management-quiz') }}"><i class="fas fa-file-alt"></i> Manage Quiz</a>
        @if(request()->is('management-home'))
            <div class="logout">
                <a href="{{ route('login') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        @endif
    </div>
    <script>
        function toggleSidebar() {
            var sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('show');
        }
    </script>
</body>
</html>
