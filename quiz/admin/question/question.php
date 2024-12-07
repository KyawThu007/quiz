<?php require_once("../../php_action/db_connect.php") ?>
<!DOCTYPE html>
<html>

<head>
    <title>
        Question
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style type="text/css">
        body {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: medium;
        }

        table {
            margin-top: 2.5rem;
            width: 100%;
        }

        table tr td:nth-child(1) {
            width: 34%;
        }

        table tr td:nth-child(2),
        table tr td:nth-child(3),
        table tr td:nth-child(4) {
            width: 16%;
        }

        table tr td:last-child {
            text-align: right;
        }

        .btnclone,
        .header .btn {
            width: 100px;
        }

        .btnclone:last-child {
            margin-top: 10px;
        }

        a {
            display: block;
        }

        .header {
            display: flex;
            margin-bottom: .5rem;
            top: 0;
            left: 0;
            padding: 10px;
            position: fixed;
            width: 100%;
        }

        .header-nav:nth-child(1) {
            width: 10%;
        }

        .header-nav:nth-child(2) {
            width: 80%;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .header-nav:nth-child(3) {
            width: 10%;
            justify-content: right;
            align-items: right;
            text-align: center;
        }
    </style>
</head>

<body class="bg-dark">
    <div class="container-fluid p-4">
        <div class="header bg-dark px-4">
            <a href="../index.html" class="header-nav">
                <button type="button" class="btn btn-secondary">Back</button>
            </a>
            <h2 class="header-nav text-white">Questions</h2>
            <a href="create.php" class="header-nav">
                <button type="button" class="btn btn-primary">Add</button>
            </a>
        </div>

        <table class="table table-info bg-light">
            <thead class="thead-light">
                <tr>
                    <th>Question</th>
                    <th>Choice1</th>
                    <th>Choice2</th>
                    <th>Choice3</th>
                    <th colspan="2">Answer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM quiz";
                $result = $connect->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row['question'] . "</td><td>" . $row['choice1'] . "</td><td>" . $row['choice2'] . "</td><td>" . $row['choice3'] . "</td><td>" . $row['answer'] . "</td><td><a href=\"edit.php?id={$row['id']}\"><button class='btn btn-secondary btnclone'>Edit</button></a><a href=\"delete.php?id={$row['id']}\"><button class='btn btn-danger btnclone'>Delete</button></a></td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'><center>No Data Available</center></td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>