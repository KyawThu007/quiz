<?php require_once("db_connect.php");

$sql = "SELECT * FROM quiz ORDER BY RAND() LIMIT 1";
$result = $connect->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $question = $row['question'];
        $choice1 = $row['choice1'];
        $choice2 = $row['choice2'];
        $choice3 = $row['choice3'];
        $answer = $row['answer'];

        // Return the data as a JSON response
        echo json_encode(array($question, $choice1, $choice2, $choice3, $answer));
    } else {
        // No data found in the database
        echo json_encode(array('error' => 'No data found.'));
    }
} else {
    // Query failed, return an error message
    echo json_encode(array('error' => 'Database query failed.'));
}

$connect->close();
?>