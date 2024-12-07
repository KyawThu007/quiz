<!DOCTYPE html>
<html>

<head>
    <title>Add Question</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style type="text/css">
        body {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: large;
            padding: 0;
            margin: 0;
        }

        table {
            width: 100%;
        }

        table tr th {
            padding: 10px;
            width: 60px;
        }

        .question {
            width: 100%;
            display: flex;
        }

        .question-div:nth-child(1) {
            width: 10%;
            justify-content: right;
            align-items: right;
            text-align: right;

        }

        .question-div:nth-child(2) {
            width: 80%;
            margin-right: 10%;
        }

        .back {
            margin: 1rem;
            width: 100px;
        }

        .save {
            margin-top: 1rem;
        }

        table tr:last-child td {
            justify-content: center;
            align-items: center;
            text-align: center;

        }
    </style>
</head>

<body>
    <div class="question">
        <a href="question.php" class="question-div">
            <button type="button" class="btn btn-secondary back">Back</button>
        </a>

        <div class="question-div">
            <fieldset class="border p-2">
                <legend class="float-none w-auto p-2">Add Question</legend>
                <form action="create.php" method="post">
                    <table>
                        <tr>
                            <th>Question</th>
                        </tr>
                        <tr>
                            <td><textarea type="text" class="form-control" name="question" placeholder="Write here..."
                                    rows="3" required></textarea></td>
                        </tr>
                        <tr>
                            <th>Choice1</th>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="choice1" placeholder="Write here..."
                                    required /></td>
                        </tr>
                        <tr>
                            <th>Choice2</th>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="choice2" placeholder="Write here..."
                                    required /></td>
                        </tr>
                        <tr>
                            <th>Choice3</th>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="choice3" placeholder="Write here..."
                                    required /></td>
                        </tr>
                        <tr>
                            <th>Answer</th>
                        </tr>
                        <tr>
                            <td>
                                <input list="answers" name="answer" class="form-control">

                                <datalist id="answers">
                                    <option value="1">
                                    <option value="2">
                                    <option value="3">
                                </datalist>
                            </td>
                        </tr>
                        <tr>
                            <td><button type="submit" class="btn btn-primary save">Save Changes</button></td>

                        </tr>
                    </table>
                </form>
            </fieldset>
        </div>
    </div>
</body>

</html>
<?php require_once('../../php_action/db_connect.php');
if ($_POST) {
    $question = $_POST['question'];
    $choice1 = $_POST['choice1'];
    $choice2 = $_POST['choice2'];
    $choice3 = $_POST['choice3'];
    // $answer = $_POST['answer'];
    $answer = isset($_POST['answer']) ? $_POST['answer'] : '0';

    $sql = "INSERT INTO quiz (question,choice1,choice2,choice3,answer) VALUES('$question','$choice1','$choice2','$choice3','$answer')";
    if ($connect->query($sql) === TRUE) {
        header("Location:../question/question.php");
    }
}
$connect->close();
?>