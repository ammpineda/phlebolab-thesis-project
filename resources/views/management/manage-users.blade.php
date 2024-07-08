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

        h1, th, td, button {
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

        .container {
            display: flex;
            flex-direction: row;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            flex-shrink: 0;
            background-color: #f8f9fa;
            height: 100vh;
            overflow-y: auto;
            position: fixed;
            z-index: 1;
        }

        .content-container {
            flex-grow: 1;
            margin-left: 250px;
            padding: 20px;
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
            border-collapse: collapse;
        }

        th, td {
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

        .modal-backdrop {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
}

.modal {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    z-index: 1000;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    max-width: 90%;
    width: 250px; /* Adjust width as needed */
    max-height: 90%;
    overflow-y: auto;
}

.modal-close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 5px 10px;
    background-color: #ccc;
    border: none;
    cursor: pointer;
    font-size: 16px;
    border-radius: 50%;
}

.modal-close-btn:hover {
    background-color: #aaa;
}

.modal h2 {
    margin-top: 0;
}

        @media (max-width: 1024px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .content-container {
                margin-left: 0;
            }
        }

        @media (max-width: 768px) {
            .button-bar {
                flex-direction: column;
                align-items: center;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 8px;
            }

            .table-wrapper {
                overflow-x: auto;
            }

            .table-wrapper table {
                display: block;
                width: 100%;
                overflow-x: auto;
                white-space: nowrap;
            }
        }

        @media (max-width: 480px) {
            .welcome-message {
                font-size: 24px;
                text-align: center;
            }

            .table-wrapper table, .table-wrapper th, .table-wrapper td {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }

            .table-wrapper th, .table-wrapper td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            .table-wrapper th::before, .table-wrapper td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 15px;
                font-weight: bold;
                text-align: left;
            }

            .table-wrapper th {
                background-color: var(--primary-color);
                color: #fff;
                padding-left: 0;
            }
        }
    </style>
</head>

<body>
    @include('management/admin-sidebar')
    <div class="content-container">
        <div class="main-content">

        <div class="modal-backdrop"></div>
            <div class="welcome-message">
                <h2>Manage Users</h2>
            </div>

            <div class="content">
            @if (session('is_instructor') && !session('is_admin'))
            <h2 style="display: inline-block; ">List of Instructors</h2>
            <p style="color: red; display: inline-block;">The 'add' feature is not accessible to instructors.</p>
            @else
            <div class="button-bar">
                <h2 style="display: inline-block; margin-left:-450px;">List of Instructors</h2>
                <button class="add-button" onclick="toggleInstructorForm()" style="display: inline-block; margin-left: 10px;">+ Add Instructor</button>
            </div>
            @endif
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
                                    <button class="button" onclick="toggleEditForm('edit-instructor-form-{{ $user->id }}')">Edit</button>
                                    <form action="{{ route('updateAccountStatus', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button class="delete-button">Disable</button>
                                    </form>
                                    @elseif(!$user->is_active)
                                    <button class="button" onclick="toggleEditForm('edit-instructor-form-{{ $user->id }}')">Edit</button>
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
            <div id="instructor-form" class="modal" style="display: none;">
            <button class="modal-close-btn" onclick="closeModal('instructor-form')">X</button>
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
            <h2 style="display: inline-block; ">List of Students</h2>
            <p style="color: red; display: inline-block;">The 'add' feature is not accessible to instructors.</p>
            @else
            <div class="button-bar">
                <h2 style="display: inline-block; margin-left:-450px;">List of Students</h2>
                <button class="add-button" onclick="toggleStudentForm()" style="display: inline-block; margin-left: 10px;">+ Add Student</button>
            </div>
            @endif

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
                                        <input type="password" id="edit_password" name="password" value="{{ $user->password }}"><br>

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
            <div id="student-form" class="modal" style="display: none;">
            <button class="modal-close-btn" onclick="closeModal('student-form')">X</button>
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
    var modalBackdrop = document.querySelector('.modal-backdrop');
    var modal = document.querySelector('#instructor-form.modal');
    modalBackdrop.style.display = 'block';
    modal.style.display = 'block';
}

function toggleStudentForm() {
    var modalBackdrop = document.querySelector('.modal-backdrop');
    var modal = document.querySelector('#student-form.modal');
    modalBackdrop.style.display = 'block';
    modal.style.display = 'block';
}

function closeModal(modalId) {
    var modalBackdrop = document.querySelector('.modal-backdrop');
    var modal = document.getElementById(modalId);
    modalBackdrop.style.display = 'none';
    modal.style.display = 'none';
}

    </script>
</body>

</html>
