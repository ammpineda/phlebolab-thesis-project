<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PhleboLab | Laboratory Exercise 3 - Practice Quiz</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
            @import url('https://fonts.googleapis.com/css?family=Roboto:300');
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Roboto', sans-serif;
            }

            body{
                background-color: whitesmoke;
            }

            ::selection{
                color: #25396d;
                background: #35b0e2;
            }

            .instr_box,
            .quiz_box,
            .result_box{
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 
                            0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }

            .instr_box.activeInfo,
            .quiz_box.activeQuiz,
            .result_box.activeResult{
                opacity: 1;
                z-index: 5;
                pointer-events: auto;
                transform: translate(-50%, -50%) scale(1);
            }

            .instr_box{
                width: 540px;
                background: #25396d;
                border-radius: 25px;
                transform: translate(-50%, -50%) scale(0.9);
                opacity: 0;
                pointer-events: none;
            }

            .instr_box .info-title{
                height: 60px;
                width: 100%;
                border-bottom: 1px solid white;
                display: flex;
                align-items: center;
                padding: 0 30px;
                border-radius: 5px 5px 0 0;
                font-size: 20px;
                font-weight: 600;
                color: white;
            }

            .instr_box .info-list{
                padding: 15px 30px;
                color: white;
            }

            .instr_box .info-list .info{
                margin: 5px 0;
                font-size: 17px;
                color: white;
            }

            .instr_box .info-list .info span{
                font-weight: bolder;
                color: white;
            }
            .instr_box .buttons{
                height: 60px;
                display: flex;
                align-items: center;
                justify-content: flex-end;
                padding: 0 30px;
            }

            .instr_box .buttons button{
                margin: 0 5px;
                height: 40px;
                width: 100px;
                font-size: 16px;
                font-weight: 500;
                cursor: pointer;
                border: none;
                outline: none;
                border-radius: 5px;
                border: 1px solid #25396d;
            }

            .quiz_box{
                width: 550px;
                background: #fff;
                border-radius: 25px;
                transform: translate(-50%, -50%) scale(0.9);
                pointer-events: none;
            }

            .quiz_box header{
                position: relative;
                z-index: 2;
                height: 70px;
                padding: 0 30px;
                background: #25396d;
                color: white;
                border-radius: 5px 5px 0 0;
                display: flex;
                align-items: center;
                justify-content: space-between;
                box-shadow: 0px 3px 5px 1px rgba(0,0,0,0.1);
            }

            .quiz_box header .title{
                font-size: 20px;
                font-weight: 600;
            }

            section{
                padding: 25px 30px 20px 30px;
                background: #25396d;
                color: white;
            }

            section .question_text{
                font-size: 18px;
                font-weight: 600;
                height: auto;
            }

            section .option_list{
                padding: 20px 0px;
                display: block;   
            }

            section .option_list .option{
                background: white;
                color: black;
                border: 1px solid #25396d;
                border-radius: 5px;
                padding: 8px 15px;
                font-size: 17px;
                margin-bottom: 15px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            section .option_list .option:last-child{
                margin-bottom: 1px;
            }

            section .option_list .option:hover{
                color: white;
                background: #35b0e2;
                border: 1px solid #25396d;
            }

            section .option_list .option.correct{
                color: #155724;
                background: #d4edda;
            }

            section .option_list .option.incorrect{
                color: #721c24;
                background: #f8d7da;
            }

            section .option_list .option.disabled{
                pointer-events: none;
            }

            section .option_list .option .icon{
                height: 20px;
                width: 20px;
                border-radius: 50%;
                text-align: center;
                font-size: 10px;
                pointer-events: none;
                line-height: 24px;
            }

            .option_list .option .icon.tick{
                color: #23903c;
                border-color: #23903c;
                background: #d4edda;
            }

            .option_list .option .icon.cross{
                color: #a42834;
                background: #f8d7da;
                border-color: #a42834;
            }

            footer{
                height: 60px;
                padding: 0 30px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                border-top: 1px solid #25396d;
                background: #25396d;
                color: white;
            }

            footer .total_que span{
                display: flex;
                user-select: none;
            }

            footer .total_que span p{
                font-weight: 500;
                padding: 0 5px;
            }

            footer .total_que span p:first-child{
                padding-left: 0px;
            }

            footer button{
                height: 30px;
                padding: 0 13px;
                font-size: 18px;
                font-weight: 400;
                cursor: pointer;
                border: none;
                outline: none;
                color: #fff;
                border-radius: 5px;
                background: white;
                color: black;
                line-height: 10px;
                opacity: 0;
                pointer-events: none;
                transform: scale(0.95);
            }

            footer button:hover{
                background: #35b0e2;
                color: white;
            }

            footer button.show{
                opacity: 1;
                pointer-events: auto;
                transform: scale(1);
            }

            .result_box{
                background: white;
                color: black;
                border-radius: 25px;
                border-color: #25396d;
                display: flex;
                padding: 25px 30px;
                width: 450px;
                align-items: center;
                flex-direction: column;
                justify-content: center;
                transform: translate(-50%, -50%) scale(0.9);
                opacity: 0;
                pointer-events: none;
            }

            .result_box .complete_text{
                font-size: 20px;
                font-weight: 500;
            }

            .result_box .score_text span{
                display: flex;
                margin: 10px 0;
                font-size: 18px;
                font-weight: 500;
            }

            .result_box .score_text span p{
                padding: 0 4px;
                font-weight: 600;
            }

            .result_box .buttons{
                display: flex;
                margin: 20px 0;
            }

            .result_box .buttons button{
                margin: 0 10px;
                height: 45px;
                padding: 0 20px;
                font-size: 18px;
                font-weight: 500;
                cursor: pointer;
                border: none;
                outline: none;
                border-radius: 5px;
            }

            .buttons button.continue{
                color: white;
                background: #35b0e2;
            }

            .buttons button.continue:hover{
                background: green;
            }

            .buttons button.quit{
                color: white;
                background: #25396d;
            }

            .buttons button.quit:hover{
                color: white;
                background: red;
            }
        </style>
</head>
<body>
        <div class="instr_box">
            <div class="info-title"><span>Lab 3 Review Instructions</span></div>
            <div class="info-list">
                <div class="info">1. This is a multiple choice type of test. Select the best answer.</div>
                <div class="info">2. The correct answer will be shown if the answer selected is incorrect. </div>
            </div>
            <div class="buttons">
                <button class="continue">Continue</button>
            </div>
        </div>
        <div class="quiz_box">
            <header>
                <div class="title">PhleboLab Lab 3 Review</div>
            </header>
            <section>
                <div class="question_text">
                </div>
                <div class="option_list">
                </div>
            </section>
            <footer>
                <div class="total_que">
                </div>
                <button class="next_btn">Submit</button>
            </footer>
        </div>
        <div class="result_box">
            <div class="complete_text">Test Result:</div>
            <div class="score_text">
            </div>
            <div class="buttons">
                <form action="{{ route('lab3-done') }}" method="POST">
                    @csrf
                    <button class="quit" type="submit" class="toggle-button"> Back to Laboratory Exercises</button>
                </form>
            </div>
        </div>
        <script src="{{ asset('/js/practice quiz 3/questions.js') }}"></script>
        <script src="{{ asset('/js/practice quiz 3/script.js') }}"></script>
        
</body>
</html>
