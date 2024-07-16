<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PhleboLab | Reading Materials</title>
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
        .open-button, .locked-button {
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
                    <h1>Reading Materials <i class="fas fa-book"></i></h1>
                </div>
                <div class="subtitle">
                    Explore comprehensive reading materials covering essential topics such as <strong>Basic Human Anatomy and Physiology</strong>, <strong>Anatomy and Physiology of the Circulatory System</strong>, <strong>Phlebotomy Equipment</strong>, <strong>Phlebotomy Technique</strong>, <strong>Safety in Phlebotomy</strong>, and <strong>Introduction to Phlebotomy</strong>. The reading materials presented are sourced from "The Complete Textbook of Phlebotomy" by Lynn B. Hoeltke. Begin your learning journey by clicking on the respective chapters below.
                </div>
                <div class="button-grid">
                @foreach ($readingMaterials as $index => $material)
    <div class="button-container">
        <p><strong>Chapter {{ $index + 1 }}:</strong><br> {{ $material->title }}</p>
        <img src="{{ asset('storage/thumbnail/' . $material->display_image) }}" alt="{{ $material->title }} Thumbnail"><br>
        
        {{-- Check if it's the first chapter or current chapter is marked as done --}}
        @if ($index === 0)
            <a href="{{ route('chapter', ['chapter_number' => $material->id]) }}" class="open-button">Open</a>
        @else
            {{-- Check if the previous chapter is marked as done --}}
            @if ($readingProgress[$index - 1]->is_done)
                <a href="{{ route('chapter', ['chapter_number' => $material->id]) }}" class="open-button">Open</a>
            @else
                <a href="#" class="locked-button">Locked</a>
            @endif
        @endif
    </div>
@endforeach

                </div>
            </div>
        </div>
    </div>
</body>
</html>
