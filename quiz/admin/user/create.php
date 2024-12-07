<?php
require_once('../../php_action/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $password = $_POST['password'];
    $active = filter_input(INPUT_POST, 'active', FILTER_VALIDATE_INT);

    if ($username && $password && in_array($active, [0, 1])) {

        // Prepare and execute the SQL statement
        $stmt = $connect->prepare("INSERT INTO user (username, password, active) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $username, $password, $active);

        if ($stmt->execute()) {
            header("Location: ../user/user.php");
            exit;
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $error = "Invalid input. Please fill out all fields correctly.";
    }

    $connect->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add User</title>
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
    <div class="container-fluid bg-dark p-4" style="height:100vh">
        <div class="form-container bg-light p-3 rounded">
            <a href="user.php" class="btn btn-secondary btn-back">Back</a>

            <form action="create.php" method="post">
                <fieldset class="border p-3">
                    <legend class="w-auto">Add User</legend>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter username" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Active</label>
                        <select id="active" name="active" class="form-control" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save User</button>
                </fieldset>
            </form>
        </div>
    </div>

</body>

</html>