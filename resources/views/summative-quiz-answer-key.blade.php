<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PhleboLab | Summative Assessment Answers</title>

    <link rel="icon" href="assets/images/favicon.ico.png" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        body {
            font-family: "Roboto", sans-serif;
            margin: 30px;
            background-color: whitesmoke;
            color: #FFFFFF;
        }

        h1 {
            color: black;
            text-align: center;
            margin-bottom: 30px;
        }

        .question {
            margin-bottom: 25px;
            background-color: #25396d;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .options {
            list-style-type: none;
            padding: 0;
            margin-top: 10px;
        }

        .option {
            margin-bottom: 5px;
        }

        p {
            margin: 0;
        }

        strong {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>PhleboLab Summative Assessment Answer Key</h1>
    <ol>
        <script>
            const questions = <?php echo json_encode($questions); ?>;

            // HTML Function to generate question HTML
            function generateQuestionHTML(question) {
                let questionHTML = `<li class="question">
            <p>${question.question}</p>
            <ul class="options">`;

                // Add options dynamically
                if (question.choice_a) {
                    questionHTML += `<li class="option">${question.choice_a}</li>`;
                }
                if (question.choice_b) {
                    questionHTML += `<li class="option">${question.choice_b}</li>`;
                }
                if (question.choice_c) {
                    questionHTML += `<li class="option">${question.choice_c}</li>`;
                }
                if (question.choice_d) {
                    questionHTML += `<li class="option">${question.choice_d}</li>`;
                }

                questionHTML += `</ul>
        <p><strong>Correct Answer:</strong> ${question.correct_answer}</p>
        </li>`;

                return questionHTML;
            }

            // Loop through questions array and generate HTML
            questions.forEach(question => {
                document.write(generateQuestionHTML(question));
            });
        </script>

    </ol>


</body>

</html>