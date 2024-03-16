const instr_box = document.querySelector(".instr_box");
const exit_btn = instr_box.querySelector(".buttons .quit");
const quiz_box = document.querySelector(".quiz_box");
const result_box = document.querySelector(".result_box");
const option_list = document.querySelector(".option_list");
const continue_btn = instr_box.querySelector(".buttons .continue");

instr_box.classList.add("activeInfo");

continue_btn.onclick = ()=>{
    instr_box.classList.remove("activeInfo");
    quiz_box.classList.add("activeQuiz"); 
    showQuetions(0); 
    queCounter(1); 
}

let timeValue =  20;
let que_count = 0;
let que_numb = 1;
let userScore = 0;
let counter;
let counterLine;
let widthValue = 0;

const quit_quiz = result_box.querySelector(".buttons .quit");

quit_quiz.onclick = ()=>{
    window.location.reload();
}

const next_btn = document.querySelector("footer .next_btn");
const bottom_ques_counter = document.querySelector("footer .total_que");

next_btn.onclick = ()=>{
    if(que_count < questions.length - 1){
        que_count++; 
        que_numb++; 
        showQuetions(que_count); 
        queCounter(que_numb); 
        clearInterval(counter); 
        clearInterval(counterLine); 
        next_btn.classList.remove("show");
    }else{
        clearInterval(counter); 
        clearInterval(counterLine); 
        showResult();
    }
}

function showQuetions(index){
    const question_text = document.querySelector(".question_text");

    let que_tag = '<span>'+ questions[index].numb + ". " + questions[index].question +'</span>';
    let option_tag = '';

    for (let i = 0; i < questions[index].options.length; i++) {
        option_tag += '<div class="option"><span>'+ questions[index].options[i] +'</span></div>';
    }

    question_text.innerHTML = que_tag;
    option_list.innerHTML = option_tag;
    
    const option = option_list.querySelectorAll(".option");

    for(let i = 0; i < option.length; i++){
        option[i].setAttribute("onclick", "optionSelected(this)");
    }
}

let tickIconTag = '<div class="icon tick"><i class="fas fa-check"></i></div>';
let crossIconTag = '<div class="icon cross"><i class="fas fa-times"></i></div>';

function optionSelected(answer){
    clearInterval(counter); 
    clearInterval(counterLine); 
    let userAns = answer.textContent;
    let correcAns = questions[que_count].answer; 
    const allOptions = option_list.children.length; 
    
    if(userAns == correcAns){ 
        userScore += 1;
        answer.classList.add("correct"); 
        answer.insertAdjacentHTML("beforeend", tickIconTag);
        console.log("Correct Answer");
        console.log("Your correct answers = " + userScore);
    }else{
        answer.classList.add("incorrect"); 
        answer.insertAdjacentHTML("beforeend", crossIconTag);
        console.log("Wrong Answer");

        for(i=0; i < allOptions; i++){
            if(option_list.children[i].textContent == correcAns)
            { 
                option_list.children[i].setAttribute("class", "option correct"); 
                option_list.children[i].insertAdjacentHTML("beforeend", tickIconTag);
                console.log("Correct answer.");
            }
        }
    }
    for(i=0; i < allOptions; i++){
        option_list.children[i].classList.add("disabled");
    }
    next_btn.classList.add("show");
}

function showResult(){
    instr_box.classList.remove("activeInfo");
    result_box.classList.add("activeResult");
    const scoreText = result_box.querySelector(".score_text");
    let scoreTag = '<span>You Scored <p>'+ userScore +'</p> out of <p>'+ questions.length +'.</p></span>';
    scoreText.innerHTML = scoreTag;

    saveScore(userScore);
}

function saveScore(score) {
    let formData = new FormData();
    formData.append('score', score);

    let xhr = new XMLHttpRequest();
    
    xhr.open("POST", "{{ route('test-done') }}", true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log("Score saved successfully.");
        } else {
            console.error("Error saving score:", xhr.statusText);
        }
    };

    xhr.send(formData);
}

function queCounter(index){
    let totalQueCounTag = '<span><p>'+ index +'</p> of <p>'+ questions.length +'</p> Questions</span>';
    bottom_ques_counter.innerHTML = totalQueCounTag;
}