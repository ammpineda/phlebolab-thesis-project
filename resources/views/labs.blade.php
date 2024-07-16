<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PhleboLab | Laboratory Exercises</title>

    <link rel="icon" href="assets/images/favicon.ico.png" type="image/x-icon">

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
            margin-left: 250px;
            flex: 1;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-wrap: wrap; 
        }

        .content {
            margin: 30px; 
            text-align: left;
            flex: 1; 
            max-width: 100%; 
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

        .button-grid {
            display: grid;
            
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); 
            gap: 20px;
        }

        .button-container {
            margin-bottom: 10px;
            text-align: center;
            border-radius: 10px;
            padding: 20px;
            background-color: #2d4789;
            color: #fff;
        }

        .button-container img {
            max-width: 100%;
            height: 400px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .button-container p {
            font-size: 20px;
        }

        .open-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .locked-button {
            background-color: #802635;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
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
                <h1>Laboratory Exercises <i class="fas fa-flask"></i></h1>
            </div>
            <div class="subtitle">
                In this laboratory session, you will perform the following exercises: <strong>Equipment Familiarization</strong> - Familiarize yourself with the various medical equipment used in phlebotomy procedures. <strong>Patient Identification</strong> - Learn the procedures for accurately identifying patients before performing blood collection. <strong>Venipuncture using Syringe</strong> - Practice the technique of venipuncture using syringes under supervision. 
                After each exercise, you will be prompted to answer an ungraded practice quiz relevant to the laboratory exercises. <br><br>
                To begin, ensure that you have completed all the reading materials before starting the first laboratory exercise. 
            </div>


            <div class="button-grid">
                <div class="button-container">
                    <p><strong>Laboratory Exercise 1:</strong><br> Equipment Familiarization</p>
                    <img src="assets/images/lab/lab1.png" alt="Exercise 1 Thumbnail"><br>
                    @if($isLastChapterDone)
                        <a href="{{ route('exercise_1') }}" class="open-button">Open</a>
                    @else
                        <a href="" class="locked-button">Locked</a>
                    @endif
                </div>
                <div class="button-container">
                    <p><strong>Laboratory Exercise 2:</strong><br>  Patient Identification</p>
                    <img src="assets/images/lab/lab2.png" alt="Exercise 2 Thumbnail"><br>
                    @if($labProgress->first_lab_is_done)
                        <a href="{{ route('exercise_2') }}" class="open-button">Open</a>
                    @else
                        <a href="" class="locked-button">Locked</a>
                    @endif
                </div>
                <div class="button-container">
                    <p><strong>Laboratory Exercise 3:</strong><br>  Venipuncture using Syringe</p>
                    <img src="assets/images/lab/lab3.png" alt="Exercise 3 Thumbnail"><br>
                    @if($labProgress->second_lab_is_done)
                        <a href="{{ route('exercise_3') }}" class="open-button">Open</a>
                    @else
                        <a href="" class="locked-button">Locked</a>
                    @endif
                </div>
                
                
                
            </div>
        </div>
    </div>
    </div>


</body>
</html>
