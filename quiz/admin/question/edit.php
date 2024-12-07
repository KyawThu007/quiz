<?php require_once('../../php_action/db_connect.php');?>
<?php
if($_POST){
    $question=$_POST['question'];
    $choice1=$_POST['choice1'];
    $choice2=$_POST['choice2'];
    $choice3=$_POST['choice3'];
    $answer=$_POST['answer'];
    $id=$_POST['id'];
    $sql1="UPDATE quiz SET question='$question', choice1='$choice1', choice2='$choice2', choice3='$choice3', answer='$answer' WHERE id='{$id}'";
    if($connect->query($sql1)===TRUE){
        header("Location:../question/question.php");
    }else {
        echo "Error updating : " . $conect->error;
    }
    $connect->close();
}else{
    $id=$_GET['id'];
    $sql="SELECT * FROM quiz WHERE id='{$id}'";
    $result=$connect->query($sql);
    if($result->num_rows>0){
       while($row=$result->fetch_assoc()){
           $question=$row['question'];
           $choice1=$row['choice1'];
           $choice2=$row['choice2'];
           $choice3=$row['choice3'];
           $answer=$row['answer'];
       }
    }
    $connect->close();
}
echo <<<_END
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Question</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <style type="text/css">
            body{font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;font-size: large;padding: 0;margin: 0;}
            table{
                width:100%;
            }
            table tr th{
                padding:10px;
                width: 60px;
            }
            .question{
                width: 100%;
                display: flex;
            }
            .question-div:nth-child(1){
                width: 10%;
                justify-content: right;
                align-items: right;
                text-align: right;
            
            }
            .question-div:nth-child(2){
                width: 80%;
                margin-right: 10%;
            }
            .back{
                margin: 1rem;
                width: 100px;
            }
            .update{
                margin-top: 1rem;
            }
            table tr:last-child td{
                justify-content: center;
                align-items: center;
                text-align: center;
            
            }
            table tr:first-child,table tr:nth-child(2){
                display:none;
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
                    <legend class="float-none w-auto p-2">Edit Question</legend>
                    <form action="edit.php" method="post">
                    <table>
                        <tr>
                        <th>Id</th>
                        </tr>
                        <tr>
                        <td><input type="text" readonly class="form-control" name="id" placeholder="ID" value='{$id}' required/></td>
                        </tr>
                        <tr>
                            <th>Question</th>
                        </tr>
                        <tr>
                            <td><textarea type="text" class="form-control" name="question" placeholder="Write here..." rows="3" required>$question</textarea></td>
                        </tr>
                        <tr>
                            <th>Choice1</th>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="choice1" placeholder="Write here..." value='{$choice1}' required/></td>
                        </tr>
                        <tr>
                            <th>Choice2</th>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="choice2" placeholder="Write here..." value='{$choice2}' required/></td>
                        </tr>
                        <tr>
                            <th>Choice3</th>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="choice3" placeholder="Write here..." value='{$choice3}' required/></td>
                        </tr>
                        <tr>
                            <th>Answer</th>
                        </tr>
                        <tr>
                            <td><input type="number" class="form-control" name="answer" value='{$answer}' placeholder="1 or 2 or 3" required/></td>
                        </tr>
                        <tr>
                            <td><button type="submit" class="btn btn-primary update">Update Changes</button></td>
                        </tr>
                    </table>
                    </form>
                </fieldset>
            </div>
        </div>
        
    </body>
</html>
_END
?>