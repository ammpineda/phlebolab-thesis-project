<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PhleboLab | Manage Users</title>

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
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            margin-top: 20px;
        }

        .button-bar {
            text-align: center;
            margin-bottom: 20px;
            padding: 20px;
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
    </style>
</head>

<body>
    @include('management/admin-sidebar')
    <div class="content-container">
        <div class="main-content">
            <div class="welcome-message">
                <h2>Manage Users</h2>
            </div>

            <div class="content">
                @if (session('is_instructor') && !session('is_admin'))
                <p style="color: red;">This feature is not accessible to instructors.</p>
                @else
                <div class="button-bar">
                    <button class="add-button" onclick="toggleInstructorForm()" href="#instructor-form">+ Add Instructor</button>
                </div>
                @endif
                <h2>List of Instructors</h2>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $instructorIndex = 1;
                            $hasInstructors = false;
                            @endphp
                            @foreach ($users as $user)
                            @if ($user->type == 'Instructor')
                            @php $hasInstructors = true; @endphp
                            <tr>
                                <td>{{ $instructorIndex++ }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>

                                @if ($user->is_active)
                                        Active
                                    @elseif (!$user->is_active)
                                        Disabled
                                    @endif

                                </td>
                                <td>
                                    @if (session('is_instructor') && !session('is_admin'))
                                    <p style="color: red;">Read only</p>
                                    @elseif($user->is_active)
                                    <button class="button" onclick="toggleEditForm('edit-student-form-{{ $user->id }}')">Edit</button>
                                    <form action="{{ route('updateAccountStatus', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button class="delete-button">Disable</button>
                                    </form>
                                    @elseif(!$user->is_active)
                                    <button class="button" onclick="toggleEditForm('edit-student-form-{{ $user->id }}')">Edit</button>
                                    <form action="{{ route('updateAccountStatus', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button class="activate-button">Activate</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>

                            <!-- Edit User Form -->
                            <tr id="edit-instructor-form-{{ $user->id }}" style="display: none;">
                                <td colspan="6">
                                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <label for="edit_first_name">First Name:</label><br>
                                        <input type="text" id="edit_first_name" name="first_name" value="{{ $user->first_name }}"><br>

                                        <label for="edit_last_name">Last Name:</label><br>
                                        <input type="text" id="edit_last_name" name="last_name" value="{{ $user->last_name }}"><br>

                                        <label for="edit_email">Email:</label><br>
                                        <input type="email" id="edit_email" name="email" value="{{ $user->email }}"><br>

                                        <label for="edit_password">Password:</label><br>
                                        <input type="password" id="edit_password" name="password" value="{{ $user->password }}"><br>

                                        <button type="submit">Update</button>
                                        <button type="button" onclick="toggleEditForm('edit-instructor-form-{{ $user->id }}')">Cancel</button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @if (!$hasInstructors)
                            <tr>
                                <td colspan="6">There are no registered instructors.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>




            <!-- Instructor Form -->
            <div id="instructor-form" style="display: none;">
                <h2>Add Instructor</h2>
                <form action="{{ route('instructor.store') }}" method="POST">
                    @csrf
                    <label for="first_name">First Name:</label><br>
                    <input type="text" id="first_name" name="first_name"><br>

                    <label for="last_name">Last Name:</label><br>
                    <input type="text" id="last_name" name="last_name"><br>

                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email"><br>

                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password"><br>

                    <button type="submit">Submit</button>
                </form>
            </div>

            <br>
            <br>


            <div class="content">
                @if (session('is_instructor') && !session('is_admin'))
                <p style="color: red;">This feature is not accessible to instructors.</p>
                @else
                <div class="button-bar">
                    <button class="add-button" onclick="toggleStudentForm()" href="#student-form">+ Add Student</button>
                </div>
                @endif


                <h2>List of Students</h2>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Lab 1 Completion</th>
                                <th>Lab 2 Completion</th>
                                <th>Lab 3 Completion</th>
                                <th>Quiz Score</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $studentIndex = 1;
                            $hasStudents = false;
                            @endphp
                            @foreach ($users as $user)
                            @if ($user->type == 'Student')
                            @php $hasStudents = true; @endphp
                            <tr>
                                <td>{{ $studentIndex++ }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach ($lab_progress as $progress)
                                    @if ($progress->lab_progress_user_id == $user->id && $progress->first_lab_is_done == 1)
                                    <i class="fas fa-check"></i>
                                    @break
                                    @endif
                                    @endforeach
                                    @if (!isset($progress) || $progress->lab_progress_user_id != $user->id || $progress->first_lab_is_done == 0)
                                    <i class="fas fa-times"></i>
                                    @endif
                                </td>
                                <td>
                                    @foreach ($lab_progress as $progress)
                                    @if ($progress->lab_progress_user_id == $user->id && $progress->second_lab_is_done == 1)
                                    <i class="fas fa-check"></i>
                                    @break
                                    @endif
                                    @endforeach
                                    @if (!isset($progress) || $progress->lab_progress_user_id != $user->id || $progress->second_lab_is_done == 0)
                                    <i class="fas fa-times"></i>
                                    @endif
                                </td>
                                <td>
                                    @foreach ($lab_progress as $progress)
                                    @if ($progress->lab_progress_user_id == $user->id && $progress->third_lab_is_done == 1)
                                    <i class="fas fa-check"></i>
                                    @break
                                    @endif
                                    @endforeach
                                    @if (!isset($progress) || $progress->lab_progress_user_id != $user->id || $progress->third_lab_is_done == 0)
                                    <i class="fas fa-times"></i>
                                    @endif
                                </td>
                                <td>
                                    @foreach ($summative_results as $result)
                                    @if ($result->summative_results_user_id == $user->id && $result->score > 0)
                                    {{ $result->score }}
                                    @break
                                    @endif
                                    @endforeach
                                    @if (!isset($result) || $result->summative_results_user_id != $user->id || !$result->score && $result->score == 0)
                                    <i class="fas fa-times"></i>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->is_active)
                                        Active
                                    @elseif (!$user->is_active)
                                        Disabled
                                    @endif
                                </td>

                                <td>
                                    @if (session('is_instructor') && !session('is_admin'))
                                    <p style="color: red;">Read only</p>
                                    @elseif($user->is_active)
                                    <button class="button" onclick="toggleEditForm('edit-student-form-{{ $user->id }}')">Edit</button>
                                    <form action="{{ route('updateAccountStatus', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button class="delete-button">Disable</button>
                                    </form>
                                    @elseif(!$user->is_active)
                                    <button class="button" onclick="toggleEditForm('edit-student-form-{{ $user->id }}')">Edit</button>
                                    <form action="{{ route('updateAccountStatus', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button class="activate-button">Activate</button>
                                    </form>
                                    @endif
                                </td>

                            </tr>

                            <!-- Edit User Form -->
                            <tr id="edit-student-form-{{ $user->id }}" style="display: none;">
                                <td colspan="10">
                                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <label for="edit_first_name">First Name:</label><br>
                                        <input type="text" id="edit_first_name" name="first_name" value="{{ $user->first_name }}"><br>

                                        <label for="edit_last_name">Last Name:</label><br>
                                        <input type="text" id="edit_last_name" name="last_name" value="{{ $user->last_name }}"><br>

                                        <label for="edit_email">Email:</label><br>
                                        <input type="email" id="edit_email" name="email" value="{{ $user->email }}"><br>

                                        <label for="edit_password">Password:</label><br>
                                        <input type="text" id="edit_password" name="password" value="{{ $user->password }}"><br>

                                        <button type="submit">Update</button>
                                        <button type="button" onclick="toggleEditForm('edit-student-form-{{ $user->id }}')">Cancel</button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @if (!$hasStudents)
                            <tr>
                                <td colspan="10">There are no registered students.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Student Form -->
            <div id="student-form" style="display: none;">
                <h2>Add Student</h2>
                <form action="{{ route('student.store') }}" method="POST">
                    @csrf
                    <label for="first_name">First Name:</label><br>
                    <input type="text" id="first_name" name="first_name"><br>

                    <label for="last_name">Last Name:</label><br>
                    <input type="text" id="last_name" name="last_name"><br>

                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email"><br>

                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password"><br>

                    <button type="submit">Submit</button>
                </form>
            </div>

        </div>
    </div>
    <script>
        function toggleEditForm(formId) {
            var form = document.getElementById(formId);
            if (form.style.display === "none") {
                form.style.display = "table-row"; // Display as a table row
            } else {
                form.style.display = "none";
            }
        }

        function toggleInstructorForm() {
            var form = document.getElementById("instructor-form");
            var studentForm = document.getElementById("student-form");
            if (form.style.display === "none") {
                form.style.display = "block";
                studentForm.style.display = "none"; // Hide student form if visible
            } else {
                form.style.display = "none";
            }
        }

        function toggleStudentForm() {
            var form = document.getElementById("student-form");
            var instructorForm = document.getElementById("instructor-form");
            if (form.style.display === "none") {
                form.style.display = "block";
                instructorForm.style.display = "none"; // Hide instructor form if visible
            } else {
                form.style.display = "none";
            }
        }
    </script>
</body>

</html>
