<?php require_once("db_connect.php") ?>
<?php
if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM user WHERE username='{$username}' AND password='{$password}'";
    $result = $connect->query($sql);
    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['active'] == 1) {
                $error = "Account is active";
            } else {
                $error = "Account is not active";
            }
        } else {
            $error = 'User not found';
        }
    } else {
        $error = 'Server not found';
    }

    if ($error == "Account is active") {
        header("Location:../main/quiz.php");
        exit;
    } else {
        echo "<script>window.location.href = '../index.html?result=' + encodeURIComponent('{$error}');</script>";
    }

    $connect->close();
}
?>