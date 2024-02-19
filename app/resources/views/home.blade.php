<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PhleboLab | Home</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);
        body {
            background-color: whitesmoke;
            font-family: "Roboto", sans-serif;
            margin: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .content {
            margin-left: 100px;
            text-align: left;
        }

        .welcome-message {
            font-size: 36px;
            margin-bottom: -40px;
        }

        .subtitle {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }

        .slideshow-container {
            max-width: 300px;
            margin-left: 20px;
        }

        .slideshow-container img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .button-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .button-container {
            text-align: center;
            border-radius: 10px;
            padding: 20px;
            padding-bottom: 10px;
            background-color: #2d4789;
            color: #fff;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .button-container:hover {
            transform: scale(1.05);
            background-color: #35B0E2;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .button-container i {
            font-size: 2em;
        }
    </style>
</head>
<body>
    @include('sidebar')

    <div class="container">
        <div class="content">
            <div class="welcome-message">
                <h1>Welcome, {{ $user->first_name }} </h1>
            </div>
            <div class="subtitle">
                Phlebolab aims to assist in reinforcing your knowledge regarding the principles of Phlebotomy.
            </div>

            <div class="button-grid">
                <div class="button-container">
                    <i class="fas fa-book"></i>
                    <p>Reading Materials</p>
                </div>
                <div class="button-container">
                    <i class="fas fa-flask"></i>
                    <p>2D Laboratory</p>
                </div>
                <div class="button-container">
                    <i class="fas fa-file-alt"></i>
                    <p>Summative Assessment</p>
                </div>
            </div>
        </div>

        <div class="slideshow-container">
            <img src="assets/images/slideshow/image1.jpg" alt="Slide 1">
            <img src="assets/images/slideshow/image2.jpg" alt="Slide 2">
            <img src="assets/images/slideshow/image3.jpg" alt="Slide 3">
        </div>
    </div>
</body>
</html>
