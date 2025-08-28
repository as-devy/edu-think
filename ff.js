const questions = [
    { question: "What does HTML stand for?", options: ["Hyper Text Markup Language", "Home Tool Markup Language", "Hyperlinks and Text Markup Language"], answer: 0 },
    { question: "What is the correct HTML element for the largest heading?", options: ["<h1>", "<heading>", "<h6>"], answer: 0 },
  
      ];


const quizForm = document.getElementById("quizForm");
const resultDiv = document.getElementById("result");
const nextBtn = document.getElementById("nextBtn");
const loadingDiv = document.getElementById("loading");
const timerDiv = document.getElementById("timer");

let currentQuestionIndex = 0;
let score = 0;

function startTimer(duration, display, callback) {
    let timer = duration, seconds;
    const interval = setInterval(() => {
        seconds = parseInt(timer % 60, 10);
        display.textContent = `Time left: ${seconds}s`;

        if (--timer < 0) {
            clearInterval(interval);
            callback();
        }
    }, 1000);
}

questions.forEach((q, index) => {
    const questionDiv = document.createElement("div");
    questionDiv.classList.add("question");
    if (index === 0) questionDiv.classList.add("active");

    const questionTitle = document.createElement("h2");
    questionTitle.textContent = `${index + 1}. ${q.question}`;
    questionDiv.appendChild(questionTitle);

    const optionsList = document.createElement("ul");
    optionsList.classList.add("options");

    q.options.forEach((option, i) => {
        const optionItem = document.createElement("li");

        const optionInput = document.createElement("input");
        optionInput.type = "radio";
        optionInput.name = `question${index}`;
        optionInput.value = i;

        const optionLabel = document.createElement("label");
        optionLabel.textContent = option;

        optionItem.appendChild(optionInput);
        optionItem.appendChild(optionLabel);
        optionsList.appendChild(optionItem);
    });

    questionDiv.appendChild(optionsList);
    quizForm.appendChild(questionDiv);
});

nextBtn.addEventListener("click", () => {
    const currentQuestion = document.querySelector(".question.active");
    const selectedOption = currentQuestion.querySelector("input[type=radio]:checked");

    if (!selectedOption) {
        alert("Please select an answer before proceeding.");
        return;
    }

    const selectedValue = parseInt(selectedOption.value);
    if (selectedValue === questions[currentQuestionIndex].answer) {
        score++;
    }

    currentQuestion.classList.remove("active");
    loadingDiv.classList.add("active");
    nextBtn.style.display = "none";

    setTimeout(() => {
        loadingDiv.classList.remove("active");
        nextBtn.style.display = "block";

        currentQuestionIndex++;

        if (currentQuestionIndex < questions.length) {
            const nextQuestion = quizForm.children[currentQuestionIndex];
            nextQuestion.classList.add("active");

            startTimer(15, timerDiv, () => {
                alert("Time's up for this question!");
                nextBtn.click();
            });
        } else {
            nextBtn.style.display = "none";
            const percentage = (score / questions.length) * 100;
            resultDiv.textContent = `You scored ${score} out of ${questions.length} (${percentage.toFixed(2)}%)`;

            if (percentage >= 75) {
                const certificateLink = document.createElement("a");
                certificateLink.href = "https://www.canva.com/design/DAGaxiq5E5Q/ZGVnnC-Apo0JM6cYeek4GQ/edit";
                certificateLink.textContent = "Click here to get your certificate!";
                certificateLink.target = "_blank";
                resultDiv.appendChild(certificateLink);
            }
        }
    }, 2000);
});

