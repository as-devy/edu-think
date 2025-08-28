const questions = [
    { question: "What is the correct syntax to declare a variable in Java?", options: ["int x = 10;", "var x = 10;", "x = 10;"], answer: 0 },
    { question: "Which keyword is used to define a class in Java?", options: ["class", "define", "object"], answer: 0 },
    { question: "What is the entry point of a Java program?", options: ["main() method", "start() method", "init() method"], answer: 0 },
    { question: "Which data type is used to store a single character in Java?", options: ["char", "string", "Character"], answer: 0 },
    { question: "Which operator is used to compare two values in Java?", options: ["==", "=", "equals"], answer: 0 },
    { question: "What does JVM stand for?", options: ["Java Virtual Machine", "Java Value Manager", "Java Version Maker"], answer: 0 },
    { question: "Which keyword is used to inherit a class in Java?", options: ["extends", "implements", "inherits"], answer: 0 },
    { question: "What is used to handle exceptions in Java?", options: ["try-catch", "if-else", "for loop"], answer: 0 },
    { question: "Which Java package contains the ArrayList class?", options: ["java.util", "java.lang", "java.io"], answer: 0 },
    { question: "What is the default value of an int variable in Java?", options: ["0", "null", "undefined"], answer: 0 },
    { question: "Which keyword is used to create an object in Java?", options: ["new", "create", "object"], answer: 0 },
    { question: "Which loop is used to iterate over a collection in Java?", options: ["for-each loop", "while loop", "do-while loop"], answer: 0 },
    { question: "Which method is used to get the length of a string in Java?", options: ["length()", "size()", "getLength()"], answer: 0 },
    { question: "Which keyword is used to declare a constant in Java?", options: ["final", "const", "static"], answer: 0 },
    { question: "Which of the following is not a valid access modifier in Java?", options: ["protected", "public", "secure"], answer: 2 },
    { question: "What is the size of an int in Java?", options: ["4 bytes", "2 bytes", "8 bytes"], answer: 0 },
    { question: "Which keyword is used to implement an interface in Java?", options: ["implements", "extends", "inherits"], answer: 0 },
    { question: "What is the correct way to create an array in Java?", options: ["int[] arr = new int[10];", "int arr = new int[10];", "int arr[10];"], answer: 0 },
    { question: "What does OOP stand for?", options: ["Object-Oriented Programming", "Object-Oriented Process", "Object Optimization Program"], answer: 0 },
    { question: "Which keyword is used to terminate a loop in Java?", options: ["break", "exit", "stop"], answer: 0 },
    { question: "Which method is used to convert a string to an integer in Java?", options: ["Integer.parseInt()", "String.toInt()", "convertToInt()"], answer: 0 },
    { question: "What is the purpose of the 'this' keyword in Java?", options: ["Refers to the current object", "Refers to the parent class", "Refers to a static method"], answer: 0 },
    { question: "Which of the following is a wrapper class in Java?", options: ["Integer", "int", "String"], answer: 0 },
    { question: "What is the use of the 'final' keyword in Java?", options: ["To declare constants", "To define static methods", "To create interfaces"], answer: 0 },
    { question: "Which of the following is not a primitive data type in Java?", options: ["String", "int", "boolean"], answer: 0 },
    { question: "What does the 'super' keyword do in Java?", options: ["Refers to the parent class", "Creates a new object", "Declares a static variable"], answer: 0 },
    { question: "What is the difference between '==' and 'equals()' in Java?", options: ["'==' compares references, 'equals()' compares values", "Both compare values", "Both compare references"], answer: 0 },
    { question: "Which exception is thrown when dividing by zero in Java?", options: ["ArithmeticException", "NullPointerException", "IOException"], answer: 0 },
    { question: "What is the output of 5/2 in Java if both operands are integers?", options: ["2", "2.5", "3"], answer: 0 },
    { question: "What is the purpose of the 'static' keyword in Java?", options: ["To define class-level variables and methods", "To create objects", "To declare constants"], answer: 0 },
    { question: "Which of the following is not a loop structure in Java?", options: ["foreach", "for", "while"], answer: 0 },
    { question: "What does JDK stand for?", options: ["Java Development Kit", "Java Deployment Kit", "Java Debugging Kit"], answer: 0 },
    { question: "What is the default value of a boolean in Java?", options: ["false", "true", "null"], answer: 0 }
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
                certificateLink.href = "https://www.canva.com/design/DAGa2opLTd4/Scu7GB1LL0AQ-r7pMmc3kQ/edit";
                certificateLink.textContent = "Click here to get your certificate!";
                certificateLink.target = "_blank";
                resultDiv.appendChild(certificateLink);
            }
        }
    }, 2000);
});

// Start the timer for the first question
startTimer(15, timerDiv, () => {
    alert("Time's up for this question!");
    nextBtn.click();
});
