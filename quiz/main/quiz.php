<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Try Something</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <!-- jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <style type="text/css">
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
</head>

<body>
  <main class="container-fluid vh-100 bg-dark d-flex justify-content-center align-items-center">
    <div class="card bg-white w-50 shadow-sm border-none">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <span>Quiz - <span id="no"></span></span>
          <span id="raito">1/3</span>
        </div>
      </div>
      <div class="card-body">
        <h5 class="card-title mb-3" id="question"></h5>
        <div class="mb-2">
          <input type="radio" class="form-check-input me-2 checkbox" id="radio1" name="choice" onclick="check(this)" />
          <label for="radio1" class="form-check-label" id="choice1"></label>
        </div>
        <div class="mb-2">
          <input type="radio" class="form-check-input me-2 checkbox" id="radio2" name="choice" onclick="check(this)" />
          <label for="radio2" class="form-check-label" id="choice2"></label>
        </div>
        <div class="mb-2">
          <input type="radio" class="form-check-input me-2 checkbox" id="radio3" name="choice" onclick="check(this)" />
          <label for="radio3" class="form-check-label" id="choice3"></label>
        </div>
      </div>
      <div class="card-footer">
        <span id="result"></span>
        <div class="d-flex justify-content-between align-items-center">
          <span>
            <button class="btn btn-secondary" onclick="preview()">
              Preview
            </button>
          </span>
          <span>
            <button class="btn btn-success" id="btn-prev" style="display: none;" onclick="back()">
              Prev
            </button>
            <button class="btn btn-success" id="btn-next" onclick="next()">
              Next
            </button>
            <button class=" btn btn-primary" id="btn-confirm" style="display: none;" onclick="confirm()">
              Submit
            </button>
          </span>
        </div>
      </div>
    </div>
  </main>

  <script>

    var count = 0;
    var choiceValue = null;
    var choice = null;
    var listMap = [];
    getMap();
    function getMap() {
      $.ajax({
        url: "../php_action/server.php",
        type: "GET",
        dataType: "json",
        success: function (data) {
          if (data) {
            var map = new Map();
            map.set("Question", data[0] || "No Question");
            map.set("Choice1", data[1] || "No Choice 1");
            map.set("Choice2", data[2] || "No Choice 2");
            map.set("Choice3", data[3] || "No Choice 3");
            map.set("Answer", data[4] || "No Answer");
            map.set("Choose", "");
            listMap[count] = map;
            setMap(listMap[count]);
          } else {
            console.error("Received invalid data:", data);
          }
        }
      });
    }

    function check(input) {
      var inputElements = document.getElementsByClassName("checkbox");
      for (var i = 0; inputElements[i]; i++) {
        inputElements[i].checked = false;
      }
      if (input != null) {
        input.checked = true;
      }
      checkButton(count);
    }
    function autocheck(a) {
      var inputElements = document.getElementsByClassName("checkbox");
      for (var i = 0; inputElements[i]; i++) {
        inputElements[i].checked = false;
      }
      inputElements[a].checked = true;
    }

    function setMap(getmap) {

      var question = document.getElementById("question");
      var label1 = document.getElementById("choice1");
      var label2 = document.getElementById("choice2");
      var label3 = document.getElementById("choice3");
      var no = document.getElementById("no");

      no.textContent = count + 1;
      question.textContent = getmap.get("Question");
      label1.textContent = getmap.get("Choice1");
      label2.textContent = getmap.get("Choice2");
      label3.textContent = getmap.get("Choice3");
      if (getmap.get("Choose") != null) {
        autocheck(getmap.get("Choose"));
      }
    }

    function action(a) {
      var inputElements = document.getElementsByClassName("checkbox");
      choiceValue = null;
      for (var i = 0; inputElements[i]; i++) {
        if (inputElements[i].checked) {
          choiceValue = i;
          replaceMap(choiceValue);
          break;
        }
      }
      if (choiceValue != null) {

      } else {
        choiceValue = 4;
        replaceMap("none");
      }
      if (count != listMap.length) {
        check();
      }
      if (a == "confirm") {
        sendResult();
      }
    }
    function sendResult() {
      let mapObj = [];
      listMap.forEach((map) => mapObj.push(Object.fromEntries(map)));
      localStorage.setItem("myMap", JSON.stringify(mapObj));
      var ans = 0;
      for (var i = 0; i < listMap.length; i++) {
        if (listMap[i].get("Answer") - 1 == listMap[i].get("Choose")) {
          ans++;
        }
      }
      window.location.href = "result.php?sendans=" + encodeURIComponent(ans);
    }

    function replaceMap(choose) {
      var replacemap = new Map();
      replacemap.set("Question", listMap[count].get("Question"));
      replacemap.set("Choice1", listMap[count].get("Choice1"));
      replacemap.set("Choice2", listMap[count].get("Choice2"));
      replacemap.set("Choice3", listMap[count].get("Choice3"));
      replacemap.set("Answer", listMap[count].get("Answer"));
      replacemap.set("Choose", choose);
      listMap[count] = replacemap;
    }
    function back() {
      if (count > 0) {
        count--;
        document.getElementById("raito").textContent = count + 1 + " / 3";

        checkButton(count);
        setMap(listMap[count]);
      }
    }
    function next() {
      if (count < listMap.length && count < 2) {
        action();
        if (choiceValue != null) {
          count++;
          document.getElementById("raito").textContent = count + 1 + " / 3";
          if (choice == "max") {
            setMap(listMap[count]);
          } else {
            getMap();
          }
          if (count == 2) {
            choice = "max";
          }
        }
        checkButton(count);
      }
    }

    function confirm() {
      if (count == 2) {
        action("confirm");
      }
    }
    function preview() {
      window.location.href = "preview.php";
    }

    function checkButton(b) {
      document.getElementById("btn-confirm").style.display = b == 2 ? "inline" : "none";
      document.getElementById("btn-prev").style.display = b == 0 ? "none" : "inline";
      document.getElementById("btn-next").style.display = b == 2 ? "none" : "inline";
    }

  </script>
</body>

</html>