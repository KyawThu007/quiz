<?php require_once("../../php_action/db_connect.php")?>
<?php
    $id=$_GET['id'];
    $sql="DELETE FROM quiz WHERE id={$id}";
    if(mysqli_query($connect,$sql)){
        header("Location:../question/question.php");
    }else{
        echo "Error while deleting record : ".$connect->error;
    }
    $connect->close();
?>