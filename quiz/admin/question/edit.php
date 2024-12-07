<?php
require_once('../../php_action/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Securely retrieve and parse POST data
    $id = intval($_POST['id']);
    $question = trim($_POST['question']);
    $choice1 = trim($_POST['choice1']);
    $choice2 = trim($_POST['choice2']);
    $choice3 = trim($_POST['choice3']);
    $answer = intval($_POST['answer']);

    // Prepare and execute SQL update statement
    $sql = "UPDATE quiz SET question = ?, choice1 = ?, choice2 = ?, choice3 = ?, answer = ? WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ssssii", $question, $choice1, $choice2, $choice3, $answer, $id);

    if ($stmt->execute()) {
        header("Location: ../question/question.php");
        exit;
    } else {
        echo "Error updating: " . $stmt->error;
    }

    $stmt->close();
    $connect->close();
} else {
    $id = intval($_GET['id']);

    // Prepare and execute SQL select statement
    $stmt = $connect->prepare("SELECT * FROM quiz WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $question = htmlspecialchars($row['question']);
        $choice1 = htmlspecialchars($row['choice1']);
        $choice2 = htmlspecialchars($row['choice2']);
        $choice3 = htmlspecialchars($row['choice3']);
        $answer = htmlspecialchars($row['answer']);
    } else {
        echo "No record found.";
        exit;
    }

    $stmt->close();
    $connect->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Question</title>
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

        .update-btn {
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <div class="container-fluid bg-dark p-4" style="height:100%">
        <div class="form-container bg-light p-3 rounded">
            <a href="question.php" class="btn btn-secondary mb-3">Back</a>

            <form action="edit.php" method="post">
                <fieldset class="border p-3">
                    <legend class="w-auto">Edit Question</legend>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="form-group">
                        <label>Question</label>
                        <textarea class="form-control" name="question" rows="3"
                            required><?php echo $question; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Choice 1</label>
                        <input type="text" class="form-control" name="choice1" value="<?php echo $choice1; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Choice 2</label>
                        <input type="text" class="form-control" name="choice2" value="<?php echo $choice2; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Choice 3</label>
                        <input type="text" class="form-control" name="choice3" value="<?php echo $choice3; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Answer</label>
                        <input list="answers" name="answer" class="form-control" value="<?php echo $answer; ?>"
                            required>
                        <datalist id="answers">
                            <option value="1">
                            <option value="2">
                            <option value="3">
                        </datalist>
                    </div>

                    <button type="submit" class="btn btn-primary update-btn">Update Changes</button>
                </fieldset>
            </form>

        </div>
    </div>

</body>

</html>