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
            margin-left: 120px;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
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
                            <td><button class="button edit-button" data-id="{{ $material->id }}" data-lesson-title="{{ $material->lesson_title }}" data-display-image="{{ $material->display_image }}" data-reading-material-pdf="{{ $material->reading_material_pdf }}">Edit</button></td>
                        </tr>
                        @endforeach

                        <!-- The Modal -->
                        <div id="editModal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <h2>Edit Material</h2>
                                <form id="editForm" action="{{ route('materials.update', ':material_id') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label for="lesson_title">Lesson Title:</label>
                                        <input type="text" id="lesson_title" name="lesson_title" required>
                                    </div>
                                    <div>
                                        <label for="display_image">Display Image:</label>
                                        <input type="file" id="display_image" name="display_image" accept="image/*">
                                        <img id="current_display_image" src="" alt="Current Display Image" style="width:200px; height:200px; border: solid 1px black;">
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

                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <script>
    var modal = document.getElementById("editModal");
    var editForm = document.getElementById("editForm");
    var btns = document.getElementsByClassName("edit-button");
    var span = document.getElementsByClassName("close")[0];

    Array.from(btns).forEach(function(btn) {
        btn.onclick = function() {
            modal.style.display = "block";
            document.getElementById('lesson_title').value = this.getAttribute('data-lesson-title');
            document.getElementById('current_display_image').src = '/storage/thumbnail/' + this.getAttribute('data-display-image');
            document.getElementById('current_reading_material_pdf').href = '/storage/pdf/' + this.getAttribute('data-reading-material-pdf');
            // Set the action attribute of the form dynamically
            editForm.action = '{{ route("materials.update", ":material_id") }}'.replace(':material_id', this.getAttribute('data-id'));
        }
    });

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</body>

</html>