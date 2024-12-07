<?php
require_once('../../php_action/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $active = filter_input(INPUT_POST, 'active', FILTER_VALIDATE_INT);
    $id = $_POST['id'];

    // Prepare the SQL query with placeholders
    $sql = "UPDATE user SET username = ?, password = ?, active = ? WHERE id = ?";
    if ($stmt = $connect->prepare($sql)) {
        $stmt->bind_param("ssii", $username, $password, $active, $id);

        if ($stmt->execute()) {
            header("Location: ../user/user.php");
            exit;
        } else {
            $error = "Error updating user: " . $stmt->error;
        }
        $stmt->close();
    }
    $connect->close();
} else {
    // Fetch existing user data
    $id = $_GET['id'];
    $sql = "SELECT username, password, active FROM user WHERE id = ?";

    if ($stmt = $connect->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($username, $password, $active);
        $stmt->fetch();
        $stmt->close();
    }
    $connect->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
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
            <form action="edit.php" method="post"">
                <fieldset class=" border p-3">
                <legend class="w-auto">Edit User</legend>
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" class="form-control" name="username"
                        value="<?= htmlspecialchars($username) ?>" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" name="password"
                        placeholder="Leave blank to keep current password">
                </div>

                <div class="form-group">
                    <label for="active">Active</label>
                    <select id="active" name="active" class="form-control" required>
                        <option value="1" <?= $active == 1 ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?= $active == 0 ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update User</button>
                </fieldset>
            </form>
        </div>
    </div>
</body>

</html>