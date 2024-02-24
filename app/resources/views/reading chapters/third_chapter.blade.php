<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PhleboLab | Reading Chapter 3</title>

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

        .main-content {
            display: flex;
        }

        .container {
            margin-left: 300px;
            flex: 1;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-wrap: wrap; 
        }

        .content {
            margin-left: 10px; 
            text-align: left;
            flex: 1; 
            max-width: 900px; 
        }

        .welcome-message {
            font-size: 36px;
            margin-bottom: -20px; 
        }

        .subtitle {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }

        .pdf-iframe {
            width: 100%;
            height: 600px;
            border: none; 
        }

        .toggle-button {
            background-color: #2d4789;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        @media screen and (max-width: 768px) {
            .main-content {
                flex-direction: column; 
                margin-left: 0;
            }

            .container {
                margin-left: 0; 
            }
        }
    </style>
</head>
<body>
    @include('sidebar')  
    <div class="main-content">   
        <div class="container">
            <div class="content">
                <div class="welcome-message">
                    <h2>Chapter 3</h2>
                </div>
                <div class="subtitle">
                 <!-- Insert description here     -->
                </div>

                <iframe class="pdf-iframe" src="assets/pdf/chapter3.pdf"></iframe>
                <form action="{{ route('chapter3-done') }}" method="POST">
                    @csrf
                    <button type="submit" class="toggle-button"><i class="fas fa-check"></i>  Complete Reading</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
