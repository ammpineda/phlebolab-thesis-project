<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PhleboLab | Manage Quiz</title>

    <link rel="icon" href="assets/images/favicon.ico.png" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <!-- Styles -->
    <style>
        :root {
            --primary-color: #25396d;
        }

        @import url(https://fonts.googleapis.com/css?family=Roboto:300);

        body {
            background-color: whitesmoke;
            font-family: "Roboto", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h1,
        th,
        td,
        button {
            color: var(--primary-color);
        }

        a {
            color: var(--primary-color);
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        button {
            background-color: #35B0E2;
            color: white;
            border: none;
            padding: 8px 18px;
            margin-top: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-left: 10px;
        }

        .content-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            margin-top: 20px;
        }

        .add-button {
            background-color: green;
            color: #fff;
            border: none;
            padding: 8px 16px;
            margin-left: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: var(--primary-color);
            color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .welcome-message {
            font-size: 36px;
            margin-bottom: -20px;
        }

        @media (max-width: 768px) {
            .button-bar {
                flex-direction: column;
                align-items: center;
            }

            table {
                font-size: 14px;
            }

            th,
            td {
                padding: 8px;
            }
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
        }

        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-content form {
            display: flex;
            flex-direction: column;
        }

        .modal-content form div {
            margin-bottom: 15px;
        }

        .modal-content label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .modal-content input[type="text"],
        .modal-content textarea,
        .modal-content select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .modal-content button[type="submit"] {
            background-color: #35B0E2;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .modal-content button[type="submit"]:hover {
            background-color: #1b86b3;
        }
    </style>
</head>

<body>
    @include('management/admin-sidebar')

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <form id="editForm" method="POST" action="{{ route('questions.update') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="questionId">
                <input type="hidden" name="quiz_for" id="quizFor">
                <div>
                    <label for="question">Question:</label>
                    <textarea id="question" name="question" required rows="4"></textarea>
                </div>
                <div>
                    <label for="choice_a">Choice A:</label>
                    <input type="text" id="choice_a" name="choice_a" required>
                </div>
                <div>
                    <label for="choice_b">Choice B:</label>
                    <input type="text" id="choice_b" name="choice_b" required>
                </div>
                <div>
                    <label for="choice_c">Choice C:</label>
                    <input type="text" id="choice_c" name="choice_c" required>
                </div>
                <div>
                    <label for="choice_d">Choice D:</label>
                    <input type="text" id="choice_d" name="choice_d" required>
                </div>
                <div>
                    <label for="correct_answer">Correct Answer:</label>
                    <select id="correct_answer" name="correct_answer" required>
                        <option value="choice_a">Choice A</option>
                        <option value="choice_b">Choice B</option>
                        <option value="choice_c">Choice C</option>
                        <option value="choice_d">Choice D</option>
                    </select>
                </div>
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>

    <div class="content-container">
        <div class="main-content">
            <div class="welcome-message">
                <h2>Manage Quiz</h2>
            </div>
            <br>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Question Number</th>
                            <th>Question</th>
                            <th>Choice A</th>
                            <th>Choice B</th>
                            <th>Choice C</th>
                            <th>Choice D</th>
                            <th>Correct Answer</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($questions as $index => $question)
                        @if ($question->quiz_for === 'lab_4')

                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $question->question }}</td>
                            <td>{{ $question->choice_a }}</td>
                            <td>{{ $question->choice_b }}</td>
                            <td>{{ $question->choice_c }}</td>
                            <td>{{ $question->choice_d }}</td>
                            <td>{{ $question->correct_answer }}</td>
                            <td>
                                <button type="button" class="button" onclick="openModal({{ $question }}, 'lab_4')">Edit</button>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        function openModal(question, quizFor) {
            document.getElementById('editModal').style.display = 'block';
            document.getElementById('questionId').value = question.id;
            document.getElementById('question').value = question.question;
            document.getElementById('choice_a').value = question.choice_a;
            document.getElementById('choice_b').value = question.choice_b;
            document.getElementById('choice_c').value = question.choice_c;
            document.getElementById('choice_d').value = question.choice_d;
            document.getElementById('correct_answer').value = question.correct_answer;
            document.getElementById('quizFor').value = quizFor;
        }

        var modal = document.getElementById('editModal');
        var span = document.getElementsByClassName('close-button')[0];

        span.onclick = function() {
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>

</html>
