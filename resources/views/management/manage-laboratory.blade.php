<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PhleboLab | Manage Laboratory</title>
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
        .delete-button {
            background-color: red;
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
            margin-left: 250px; /* Adjust margin to accommodate sidebar */
            padding: 20px;
        }
        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }
        table {
            width: 100%;
            max-width: 1200px;
            
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
        .pdf-iframe {
            width: 100%;
            height: 600px;
            border: none;
        }
        @media (max-width: 768px) {
            .content-container {
                padding: 20px;
            }
            table {
                font-size: 14px;
            }
            th,
            td {
                padding: 8px;
            }
        }
        /* Adjusted sidebar width */
        .sidebar {
            width: 200px; /* Adjust this width as needed */
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #25396d;
            padding-top: 20px;
        }
        /* Adjusted modal position */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 50%; /* Adjust as needed */
            top: 50%; /* Adjust as needed */
            transform: translate(-50%, -50%);
            width: 400px; /* Adjust width as needed */
            max-width: 90%;
            overflow: auto;
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 200px;
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
                    <label for="correct_answer">Correct Answer:</label>
                    <select id="correct_answer" name="correct_answer" required>
                        <option value="choice_a">Choice A</option>
                        <option value="choice_b">Choice B</option>
                    </select>
                </div>
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>

    <div class="content-container">
        <div class="main-content">
            <div class="welcome-message">
                <h2>Manage Laboratory</h2>
            </div>
            <div class="content">
                <br>
                <div class="table-wrapper">
                <h1>Equipment Familiarization</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Question Number</th>
                                <th>Question</th>
                                <th>Choice 1</th>
                                <th>Choice 2</th>
                                <th>Correct Answer</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $index => $question)
                            @if ($question->quiz_for === 'lab_1')
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $question->question }}</td>
                                <td>{{ $question->choice_a }}</td>
                                <td>{{ $question->choice_b }}</td>
                                <td>{{ $question->correct_answer }}</td>
                                <td>
                                    <button type="button" class="button" onclick="openModal({{ $question }}, 'lab_1')">Edit</button>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="content">
                <br>
                
                <br>
                <br>
                <div class="table-wrapper">
                <h1>Patient Identification</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Question Number</th>
                                <th>Question</th>
                                <th>Choice 1</th>
                                <th>Choice 2</th>
                                <th>Correct Answer</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $index => $question)
                            @if ($question->quiz_for === 'lab_2')
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $question->question }}</td>
                                <td>{{ $question->choice_a }}</td>
                                <td>{{ $question->choice_b }}</td>
                                <td>{{ $question->correct_answer }}</td>
                                <td>
                                    <button type="button" class="button" onclick="openModal({{ $question }}, 'lab_2')">Edit</button>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="content">
                <br>
                
                <br>
                <br>
                <div class="table-wrapper">
                <h1>Venipuncture Using Syringe</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Question Number</th>
                                <th>Question</th>
                                <th>Choice 1</th>
                                <th>Choice 2</th>
                                <th>Correct Answer</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $index => $question)
                            @if ($question->quiz_for === 'lab_3')

                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $question->question }}</td>
                                <td>{{ $question->choice_a }}</td>
                                <td>{{ $question->choice_b }}</td>
                                <td>{{ $question->correct_answer }}</td>
                                <td>
                                    <button type="button" class="button" onclick="openModal({{ $question }}, 'lab_3')">Edit</button>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
