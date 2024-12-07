<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Try Something</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

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

        .form {
            margin: auto;
            width: 30%;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container-fluid vh-100 bg-dark d-flex justify-content-center align-items-center">
        <div class="form shadow-sm bg-white rounded">
            <h1 style="padding-bottom: 5%;color: green;">
                Score
            </h1>
            <b>
                <p id="ans">3 / 3</p>
            </b>
            <div class="progress" style="margin: 30px;">
                <div id="percent" class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100">0%</div>
            </div>

            <button class="btn btn-success" onclick="preview()">Preview</button>
            <button class="btn btn-primary" onclick="finsih()">Finish</button>

        </div>
    </div>
    <script>
        var urlSParams = new URLSearchParams(window.location.search);
        var ans = urlSParams.get('sendans');
        document.getElementById('ans').innerText = ans + " / 3";
        ans = parseInt((ans / 3) * 100);
        document.getElementById('percent').innerText = ans + " %";
        document.getElementById('percent').style.width = ans + "%";
        function finsih() {
            window.location.href = "quiz.php";
        }
        function preview() {
            window.location.href = "preview.php";
        }
    </script>
</body>

</html>