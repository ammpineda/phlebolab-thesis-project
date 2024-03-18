<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PhleboLab | Summative Assessment Answers</title>

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
            color:black;
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
            let questions = [
                {
                    numb: 1,
                    question: "Phlebotomists often have many duties and tasks. Which of the following is the primary duty?",
                    answer: "c. collecting venous blood samples",
                    options: [
                        "a. sample processing",
                        "b. sample accession",
                        "c. collecting venous blood samples",
                        "d. collecting arterial blood samples"
                    ]
                },
                {
                    numb: 2,
                    question: "What laboratory procedure tests a routine urine sample?",
                    answer: "c. urinalysis",
                    options: [
                        "a. chemistry",
                        "b. cytology",
                        "c. urinalysis",
                        "d. microbiology"
                    ]
                },
                {
                    numb: 3,
                    question: "The single most important way to prevent the spread of infection in a hospital or other facility is",
                    answer: "b. handwashing",
                    options: [
                        "a. gowning and gloving",
                        "b. handwashing",
                        "c. always wearing masks",
                        "d. avoiding breathing on patients"
                    ]
                },
                {
                    numb: 4,
                    question: "A potential source of infectious material from a patient in protective isolation includes",
                    answer: "b. none (the phlebotomist is considered a potential source of infection to the patient)",
                    options: [
                        "a. feces",
                        "b. none (the phlebotomist is considered a potential source of infection to the patient)",
                        "c. urine",
                        "d. blood"
                    ]
                },
                {
                    numb: 5,
                    question: "The process in which oxygen-rich blood diffuses into tissue cells is",
                    answer: "c. internal respiration",
                    options: [
                        "a. exhaling",
                        "b. external respiration",
                        "c. internal respiration",
                        "d. breathing"
                    ]
                },
                {
                    numb: 6,
                    question: "The most common disorder of the endocrine system is",
                    answer: "b. diabetes mellitus",
                    options: [
                        "a. rheumatoid arthritis",
                        "b. diabetes mellitus",
                        "c. infertility",
                        "d. respiratory distress"
                    ]
                },
                {
                    numb: 7,
                    question: "The formed elements make up about __ percent of the whole blood volume",
                    answer: "d. 45",
                    options: [
                        "a. 30",
                        "b. 60",
                        "c. 55",
                        "d. 45"
                    ]
                },
                {
                    numb: 8,
                    question: "The two components of blood found in a tube of blood drawn without anticoagulant are",
                    answer: "d. serum and clot",
                    options: [
                        "a. plasma and clot",
                        "b. buffy coat and erythrocytes",
                        "c. serum and buffy coat",
                        "d. serum and clot"
                    ]
                },
                {
                    numb: 9,
                    question: "The fluid portion of the whole blood that contains fibrinogen is called",
                    answer: "c. plasma",
                    options: [
                        "a. the buffy coat",
                        "b. erythrocytes",
                        "c. plasma",
                        "d. serum"
                    ]
                },
                {
                    numb: 10,
                    question: "When serum is needed for blood chemistry testing, blood must be collected in which of the following colored tubes?",
                    answer: "d. red",
                    options: [
                        "a. light blue",
                        "b. green",
                        "c. lavender",
                        "d. red"
                    ]
                },
                {
                    numb: 11,
                    question: "The tourniquet should be applied how many inches above the proposed venipuncture site?",
                    answer: "b. 3 to 4 inches",
                    options: [
                        "a. 1 to 2 inches",
                        "b. 3 to 4 inches",
                        "c. 4 to 5 inches",
                        "d. 5 to 6 inches"
                    ]
                },
                {
                    numb: 12,
                    question: "Leaving the tourniquet on a patient's arm for an extended length of time before drawing blood may cause",
                    answer: "a. hemoconcentration",
                    options: [
                        "a. hemoconcentration",
                        "b. sample hemolysis",
                        "c. stress",
                        "d. bruising"
                    ]
                },
                {
                    numb: 13,
                    question: "A phlebotomist is requested to go to a patient's hospital room and draw a sample from an unconscious patient. The room number and the name on the door agree with the request form and the patient identification bracelet. What else should be done to ensure patient identification?",
                    answer: "c. nothing else is necessary",
                    options: [
                        "a. refuse to draw the patient until he or she is conscious",
                        "b. attempt to find the name of the patient on some other item in the room",
                        "c. nothing else is necessary",
                        "d. verify if the identity of the patient from a relative or nurse"
                    ]
                },
                {
                    numb: 14,
                    question: "When drawing multiple samples in evacuated tubes, it is important to fill which of the following color-stoppered tubes first?",
                    answer: "a. light-blue",
                    options: [
                        "a. light-blue",
                        "b. green",
                        "c. lavender",
                        "d. red"
                    ]
                },
                {
                    numb: 15,
                    question: "The doctor orders tests requiring a light-blue-stoppered tube for coagulation studies, a lavender-stoppered tube, a red-stoppered tube, and a set of blood cultures. What is the correct order of draw?",
                    answer: "b. blood cultures, light-blue, red, lavender",
                    options: [
                        "a. red, light-blue, blood cultures, lavender",
                        "b. blood cultures, light-blue, red, lavender",
                        "c. blood cultures, red, light-blue, lavender",
                        "d. blood cultures, lavender, light-blue, red"
                    ]
                }
            ];

            // HTML Function 
            function generateQuestionHTML(question) {
                let questionHTML = `<li class="question">
                    <p>${question.numb}. ${question.question}</p>
                    <p><strong>Answer:</strong> ${question.answer}</p>
                    <ul class="options">`;
                
                question.options.forEach(option => {
                    questionHTML += `<li class="option">${option}</li>`;
                });

                questionHTML += `</ul>
                </li>`;

                return questionHTML;
            }

            
            questions.forEach(question => {
                document.write(generateQuestionHTML(question));
            });
        </script>
    </ol>

        
</body>
</html>
