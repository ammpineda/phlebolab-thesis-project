<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PhleboLab | Manage Materials</title>

    <link rel="icon" href="assets/images/favicon.ico.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
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

        .upload-button {
            background-color: gray;
            color: white;
            border: none;
            padding: 8px 18px;
            margin-top: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .content-container {
            display: flex;
            flex-direction: column;
            align-items: center;
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

            .content-container {
                padding: 10px;
            }

            .table-wrapper {
                overflow-x: scroll;
            }

            table {
                min-width: 600px;
                /* Ensure table doesn't collapse too much */
            }

            .modal-content {
                width: 90%;
                /* Adjust modal width for smaller screens */
                max-width: 90%;
                /* Adjust modal max-width for smaller screens */
                margin: 10% auto;
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
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
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
        .modal-content input[type="file"] {
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

        .modal-content img {
            margin-top: 10px;
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .modal-content a {
            margin-top: 10px;
            display: inline-block;
        }

        .delete-button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 18px;
            margin-top: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .delete-button:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>
    @include('management/admin-sidebar')
    <div class="content-container">
        <div class="main-content">
            <div class="welcome-message">
                <h2>Manage Materials</h2>
            </div>
            <br>
            <div class="button-bar">
                <button class="add-button" id="addButton">Add Material</button>
            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Lesson Number</th>
                            <th>Display Picture</th>
                            <th>Lesson Name</th>
                            <th>PDF File</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reading_materials as $index => $material)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><img src="{{ asset('storage/thumbnail/' . $material->display_image) }}" alt="Display Picture" style="width:100px; height:100px;"></td>
                            <td>{{ $material->lesson_title }}</td>
                            <td><a href="{{ asset('storage/pdf/' . $material->reading_material_pdf) }}" target="_blank"><button class="upload-button">View PDF</button></a></td>
                            <td>
                                <button class="button edit-button" data-id="{{ $material->id }}" data-lesson-title="{{ $material->lesson_title }}" data-display-image="{{ $material->display_image }}" data-reading-material-pdf="{{ $material->reading_material_pdf }}">Edit</button>
                                <form action="{{ route('materials.destroy', $material->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button delete-button" onclick="return confirm('Are you sure you want to delete this material?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        <!-- The Modal for Edit -->
                        <div id="editModal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <h2>Edit Material</h2>
                                <form id="editForm" action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label for="lesson_title">Lesson Title:</label>
                                        <input type="text" id="lesson_title" name="lesson_title" required>
                                    </div>
                                    <div>
                                        <label for="display_image">Display Image:</label>
                                        <input type="file" id="display_image" name="display_image" accept="image/*">
                                        <img id="current_display_image" src="" alt="Current Display Image">
                                    </div>
                                    <div>
                                        <label for="reading_material_pdf">PDF File:</label>
                                        <input type="file" id="reading_material_pdf" name="reading_material_pdf" accept="application/pdf">
                                        <a id="current_reading_material_pdf" href="" target="_blank">View current PDF</a>
                                    </div>
                                    <button type="submit">Update Material</button>
                                </form>
                            </div>
                        </div>

                        <!-- The Modal for Add -->
                        <div id="addModal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <h2 id="modalTitle">Add Material</h2>
                                <form id="addForm" action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <label for="lesson_title_add">Lesson Title:</label>
                                        <input type="text" id="lesson_title_add" name="lesson_title" required>
                                    </div>
                                    <div>
                                        <label for="display_image_add">Display Image:</label>
                                        <input type="file" id="display_image_add" name="display_image" accept="image/*">
                                    </div>
                                    <div>
                                        <label for="reading_material_pdf_add">PDF File:</label>
                                        <input type="file" id="reading_material_pdf_add" name="reading_material_pdf" accept="application/pdf">
                                    </div>
                                    <button type="submit">Add Material</button>
                                </form>
                            </div>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- JavaScript for modals and interactions -->
    <script>
        var editModal = document.getElementById("editModal");
        var addModal = document.getElementById("addModal");
        var editForm = document.getElementById("editForm");
        var addForm = document.getElementById("addForm");
        var editButtons = document.getElementsByClassName("edit-button");
        var deleteButtons = document.getElementsByClassName("delete-button");
        var addButton = document.getElementById("addButton");
        var closeButtons = document.getElementsByClassName("close");

        // Open edit modal when edit button is clicked
        Array.from(editButtons).forEach(function(btn) {
            btn.onclick = function() {
                editModal.style.display = "block";
                // Populate form fields with current data
                document.getElementById('lesson_title').value = this.getAttribute('data-lesson-title');
                document.getElementById('current_display_image').src = '/storage/thumbnail/' + this.getAttribute('data-display-image');
                document.getElementById('current_reading_material_pdf').href = '/storage/pdf/' + this.getAttribute('data-reading-material-pdf');
                // Set the action attribute of the form dynamically
                editForm.action = '{{ route("materials.update", ":material_id") }}'.replace(':material_id', this.getAttribute('data-id'));
            }
        });

        // Open add modal when add button is clicked
        addButton.onclick = function() {
            addModal.style.display = "block";
        }

        // Close modals when close button is clicked
        Array.from(closeButtons).forEach(function(btn) {
            btn.onclick = function() {
                editModal.style.display = "none";
                addModal.style.display = "none";
            }
        });

        // Close modals when user clicks outside of the modal
        window.onclick = function(event) {
            if (event.target == editModal || event.target == addModal) {
                editModal.style.display = "none";
                addModal.style.display = "none";
            }
        }

        
    </script>

</body>

</html>