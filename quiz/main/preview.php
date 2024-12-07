<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <style>
    body {
      font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
      font-size: medium;
    }

    button {
      margin: 5px;
      width: 5.5rem;
      height: 40px;
    }
  </style>
  <title>Preview</title>
</head>

<body>
  <script>

    window.onload = (event) => {

      let quizzes = [];
      let storedMap = localStorage.getItem("myMap");
      if (storedMap) {
        storedMap = JSON.parse(storedMap);
        quizzes.push(...storedMap);
      } else {
        console.log("No valid data found in localStorage");
      }

      let current = 0;

      const no = document.querySelector("#no");
      const ratio = document.querySelector("#raito");
      const question = document.querySelector("#question");
      const choice1 = document.querySelector("#choice1");
      const radio1 = document.querySelector("#radio1");
      const choice2 = document.querySelector("#choice2");
      const radio2 = document.querySelector("#radio2");
      const choice3 = document.querySelector("#choice3");
      const radio3 = document.querySelector("#radio3");
      const result = document.querySelector("#result");
      const answer = document.querySelector("#answer");
      const btnPrev = document.querySelector("#btn-prev");
      const btnNext = document.querySelector("#btn-next");
      const btnExit = document.querySelector("#btn-exit");

      renderQuiz(quizzes, current);

      function renderQuiz(quizzes, i) {
        const quiz = quizzes[i];

        no.textContent = i + 1;
        ratio.textContent = `${i + 1}/${quizzes.length}`;

        question.textContent = quiz.Question;
        choice1.textContent = quiz.Choice1;
        choice1.value = quiz.Choice1;
        radio1.checked = quiz.Choose === 0;

        choice2.textContent = quiz.Choice2;
        choice2.value = quiz.Choice2;
        radio2.checked = quiz.Choose === 1;

        choice3.textContent = quiz.Choice3;
        choice3.value = quiz.Choice3;
        radio3.checked = quiz.Choose === 2;

        result.textContent =
          quiz.Answer == quiz.Choose ? "Correct" : "Incorrect";
        result.style.color = quiz.Answer == quiz.Choose ? "green" : "red";

        if (quiz.Answer == 0) {
          answer.textContent = quiz.Choice1;

        } else if (quiz.Answer == 1) {
          answer.textContent = quiz.Choice2;
        } else {
          answer.textContent = quiz.Choice3;
        }

        btnPrev.style.display = i < 1 ? "none" : "inline";
        btnNext.style.display = i >= quizzes.length - 1 ? "none" : "inline";

        btnExit.style.display = i === quizzes.length - 1 ? "inline" : "none";
      }

      function updateCurrent(value) {
        current += value;
        renderQuiz(quizzes, current);
      }

      btnPrev.addEventListener("click", () => updateCurrent(-1));
      btnNext.addEventListener("click", () => updateCurrent(1));
      btnExit.addEventListener("click", () => {
        window.location.href = "quiz.php";
      });
    };

  </script>

  <main class="container-fluid vh-100 bg-dark d-flex justify-content-center align-items-center">
    <div class="card bg-white w-50 shadow-sm border-none">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <span>Quiz - <span id="no"></span></span>
          <span id="raito"></span>
        </div>
      </div>
      <div class="card-body">
        <h5 class="card-title mb-3" id="question"></h5>
        <div class="mb-2">
          <input type="radio" class="form-check-input me-2" id="radio1" name="choice" disabled />
          <label for="radio1" class="form-check-label" id="choice1"></label>
        </div>
        <div class="mb-2">
          <input type="radio" class="form-check-input me-2" id="radio2" name="choice" disabled />
          <label for="radio2" class="form-check-label" id="choice2"></label>
        </div>
        <div class="mb-2">
          <input type="radio" class="form-check-input me-2" id="radio3" name="choice" disabled />
          <label for="radio3" class="form-check-label" id="choice3"></label>
        </div>
      </div>
      <div class="card-footer">
        <span id="result"></span>
        <div class="d-flex justify-content-between align-items-center">
          <span>Answer: <span id="answer"></span></span>
          <span>
            <button class="btn btn-success" id="btn-prev" style="display: none;">
              Prev
            </button>
            <button class="btn btn-success" id="btn-next">
              Next
            </button>
            <button class="btn btn-danger" id="btn-exit" style="display: none;">
              Exit
            </button>
          </span>
        </div>
      </div>
    </div>
  </main>
</body>

</html>