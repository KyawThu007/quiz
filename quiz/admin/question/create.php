<?php
require_once('../../php_action/db_connect.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $question = filter_input(INPUT_POST, 'question', FILTER_SANITIZE_STRING);
    $choice1 = filter_input(INPUT_POST, 'choice1', FILTER_SANITIZE_STRING);
    $choice2 = filter_input(INPUT_POST, 'choice2', FILTER_SANITIZE_STRING);
    $choice3 = filter_input(INPUT_POST, 'choice3', FILTER_SANITIZE_STRING);
    $answer = filter_input(INPUT_POST, 'answer', FILTER_VALIDATE_INT);

    if ($question && $choice1 && $choice2 && $choice3 && $answer) {
        // Insert data using prepared statement
        $stmt = $connect->prepare("INSERT INTO quiz (question, choice1, choice2, choice3, answer) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssii", $question, $choice1, $choice2, $choice3, $answer);

        if ($stmt->execute()) {
            header("Location: ../question/question.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Invalid input. Please fill out all fields correctly.";
    }
    $connect->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Question</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: medium;
        }

        .form-container {
            max-width: 600px;
            margin: auto;
        }

        .btn-back {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="container-fluid bg-dark p-4" style="height:100%">
        <div class="form-container bg-light p-3 rounded">
            <a href="question.php" class="btn btn-secondary btn-back">Back</a>

            <form action="create.php" method="post">
                <fieldset class="border p-3">
                    <legend class="w-auto">Add Question</legend>
                    <div class="form-group">
                        <label>Question</label>
                        <textarea class="form-control" name="question" placeholder="Write here..." rows="3"
                            required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Choice 1</label>
                        <input type="text" class="form-control" name="choice1" placeholder="Write here..." required>
                    </div>

                    <div class="form-group">
                        <label>Choice 2</label>
                        <input type="text" class="form-control" name="choice2" placeholder="Write here..." required>
                    </div>

                    <div class="form-group">
                        <label>Choice 3</label>
                        <input type="text" class="form-control" name="choice3" placeholder="Write here..." required>
                    </div>

                    <div class="form-group">
                        <label>Answer</label>
                        <input list="answers" name="answer" class="form-control" required>
                        <datalist id="answers">
                            <option value="1">
                            <option value="2">
                            <option value="3">
                        </datalist>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </fieldset>
            </form>

        </div>
    </div>
</body>

</html>