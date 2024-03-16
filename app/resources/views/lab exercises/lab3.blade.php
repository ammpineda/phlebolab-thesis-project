<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PhleboLab | Laboratory Exercise 3</title>

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
            position: relative;
        }

        .content {
            margin: 10px; 
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

        .slideshow-container {
            position: relative;
            max-width: 100%;
            margin-top: 20px;
            z-index: 1; 
        }

        .slideshow-image {
            display: none;
            max-width: 100%;
        }

        .slideshow-buttons {
            margin-top: 10px;
            
        }

        .popup-button {
            background-color: #25396d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
            margin-bottom: 20px;
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
                    <h2>Venipuncture Using Syringe</h2>
                </div>
                <div class="subtitle">
                    In this laboratory exercise, you will engage with a slideshow featuring the step-by-step procedure for venipuncture process using syringe. <br><br>
                    
                    <button id="practiceButton" class="popup-button" onclick="goNext()">
                        PRACTICE QUIZ&nbsp; 
                        <span id="indicator" style="color: red;"><i class="fas fa-times"></i></span>
                    </button> <span id="note" style="font-size: 14px; color: #555;">Note: The practice quiz will become accessible once you've read all the steps.</span>
                    <br>

                </div>
                <div class="slideshow-container">
                    <img class="slideshow-image" src="assets/images/lab/lab3 slideshow/1.png" alt="Slide 1">
                    <img class="slideshow-image" src="assets/images/lab/lab3 slideshow/2.png" alt="Slide 2">
                    <img class="slideshow-image" src="assets/images/lab/lab3 slideshow/3.png" alt="Slide 3">
                    <img class="slideshow-image" src="assets/images/lab/lab3 slideshow/4.png" alt="Slide 4">
                    <img class="slideshow-image" src="assets/images/lab/lab3 slideshow/5.png" alt="Slide 5">
                    <img class="slideshow-image" src="assets/images/lab/lab3 slideshow/6.png" alt="Slide 6">
                    <img class="slideshow-image" src="assets/images/lab/lab3 slideshow/7.png" alt="Slide 7">
                    <img class="slideshow-image" src="assets/images/lab/lab3 slideshow/8.png" alt="Slide 8">
                    <img class="slideshow-image" src="assets/images/lab/lab3 slideshow/9.png" alt="Slide 9">
                    <img class="slideshow-image" src="assets/images/lab/lab3 slideshow/10.png" alt="Slide 10">
                    <img class="slideshow-image" src="assets/images/lab/lab3 slideshow/11.png" alt="Slide 11">
                    <img class="slideshow-image" src="assets/images/lab/lab3 slideshow/12.png" alt="Slide 12">
                    <img class="slideshow-image" src="assets/images/lab/lab3 slideshow/13.png" alt="Slide 13">
                </div>
                <div class="slideshow-buttons">
                    <button class="popup-button" onclick="plusSlides(-1)">&#9664;</button>
                    <button class="popup-button" onclick="plusSlides(1)">&#9654;</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let slideIndex = 1;
        let practiceButton = document.getElementById('practiceButton');
        let indicator = document.getElementById('indicator');
        practiceButton.disabled = true;
        indicator.innerHTML = '<i class="fas fa-times"></i>'; 
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("slideshow-image");
            if (n > slides.length) {
                slideIndex = slides.length;
            }
            if (n < 1) {
                slideIndex = 1;
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex - 1].style.display = "block";
            
            if (slideIndex === 1) {
                // Disable previous button when on first page
                document.getElementById('previousButton').disabled = true;
            } 
            
            if (slideIndex === 13) {
                practiceButton.disabled = false;
                indicator.innerHTML = '<i class="fas fa-check" style="color: green;"></i>';
            } 
        }

        function goNext() {
            alert('Proceeding to the practice quiz for Venipuncture topic. Ensure that you have read every step of the procedure.');
            window.location.href = "{{ route('exercise_3_quiz') }}";
        }
    </script>
</body>
</html>
