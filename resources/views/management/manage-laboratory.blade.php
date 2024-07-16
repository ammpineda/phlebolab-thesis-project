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
            max-width: 90%;
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 100%;
            max-width: 600px; /* Adjust width as needed */
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
                <input type="hidden" name="id" id="editQuestionId">
                <input type="hidden" name="quiz_for" id="editQuizFor">
                <div>
                    <label for="editQuestion">Question:</label>
                    <textarea id="editQuestion" name="question" required rows="4"></textarea>
                </div>
                <div>
                    <label for="editChoiceA">Choice A:</label>
                    <input type="text" id="editChoiceA" name="choice_a" required>
                </div>
                <div>
                    <label for="editChoiceB">Choice B:</label>
                    <input type="text" id="editChoiceB" name="choice_b" required>
                </div>
                <div>
                    <label for="editCorrectAnswer">Correct Answer:</label>
                    <select id="editCorrectAnswer" name="correct_answer" required>
                        <option value="choice_a">Choice A</option>
                        <option value="choice_b">Choice B</option>
                    </select>
                </div>
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>

    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <form id="addForm" method="POST" action="{{ route('questions.store') }}">
                @csrf
                <input type="hidden" name="quiz_for" id="addQuizFor">
                <div>
                    <label for="addQuestion">Question:</label>
                    <textarea id="addQuestion" name="question" required rows="4"></textarea>
                </div>
                <div>
                    <label for="addChoiceA">Choice A:</label>
                    <input type="text" id="addChoiceA" name="choice_a" required>
                </div>
                <div>
                    <label for="addChoiceB">Choice B:</label>
                    <input type="text" id="addChoiceB" name="choice_b" required>
                </div>
                <div>
                    <label for="addCorrectAnswer">Correct Answer:</label>
                    <select id="addCorrectAnswer" name="correct_answer" required>
                        <option value="choice_a">Choice A</option>
                        <option value="choice_b">Choice B</option>
                    </select>
                </div>
                <button type="submit">Add Question</button>
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
                <!-- Equipment Familiarization -->
                <div class="table-wrapper">
                    <h1>Equipment Familiarization</h1>
                    <button type="button" class="button" style="background-color:green;" onclick="openModalAdd('lab_1')">Add Question</button>
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
                                        <form action="{{ route('questions.destroy', $question->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this question?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>

                <!-- Patient Identification -->
                <div class="table-wrapper">
                    <h1>Patient Identification</h1>
                    <button type="button" class="button" style="background-color:green;" onclick="openModalAdd('lab_2')">Add Question</button>
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
                                        <form action="{{ route('questions.destroy', $question->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this question?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>

                <!-- Venipuncture Using Syringe -->
                <div class="table-wrapper">
                    
                    <h1>Venipuncture Using Syringe</h1>
                    <button type="button" class="button" style="background-color:green;" onclick="openModalAdd('lab_3')">Add Question</button>
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
                                        <form action="{{ route('questions.destroy', $question->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this question?')">Delete</button>
                                        </form>
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
            var modal = document.getElementById('editModal');
            modal.style.display = 'block';

            // Set values in edit modal
            document.getElementById('editQuestionId').value = question.id;
            document.getElementById('editQuestion').value = question.question;
            document.getElementById('editChoiceA').value = question.choice_a;
            document.getElementById('editChoiceB').value = question.choice_b;
            document.getElementById('editCorrectAnswer').value = question.correct_answer;
            document.getElementById('editQuizFor').value = quizFor;
        }

        function openModalAdd(quizFor) {
            var modal = document.getElementById('addModal');
            modal.style.display = 'block';

            // Clear previous form values if necessary
            document.getElementById('addQuestion').value = '';
            document.getElementById('addChoiceA').value = '';
            document.getElementById('addChoiceB').value = '';
            document.getElementById('addCorrectAnswer').value = 'choice_a'; // Default selection, change if needed
            document.getElementById('addQuizFor').value = quizFor;
        }

        var modals = document.querySelectorAll('.modal');
        var spans = document.querySelectorAll('.close-button');

        spans.forEach(function(span) {
            span.onclick = function() {
                modals.forEach(function(modal) {
                    modal.style.display = 'none';
                });
            }
        });

        window.onclick = function(event) {
            modals.forEach(function(modal) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            });
        }
    </script>

</body>
</html>
