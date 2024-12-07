<?php require_once('../../php_action/db_connect.php');?>
<?php
if($_POST){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $active=$_POST['active'];
    $id=$_POST['id'];
    $sql1="UPDATE user SET username='$username', password='$password', active='$active' WHERE id='{$id}'";
    if($connect->query($sql1)===TRUE){
        header("Location:../user/user.php");
    }else {
        echo "Error updating : " . $conect->error;
    }
    $connect->close();
}else{
    $id=$_GET['id'];
    $sql="SELECT * FROM user WHERE id='{$id}'";
    $result=$connect->query($sql);
    if($result->num_rows>0){
       while($row=$result->fetch_assoc()){
           $username=$row['username'];
           $password=$row['password'];
           $active=$row['active'];
       }
    }
    $connect->close();
}
echo <<<_END
<!DOCTYPE html>
<html>
    <head>
        <title>Edit User</title>
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
            .user{
                width: 100%;
                display: flex;
            }
            .user-div:nth-child(1){
                width: 10%;
                justify-content: right;
                align-items: right;
                text-align: right;
            
            }
            .user-div:nth-child(2){
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
        <div class="user">
            <a href="user.php" class="user-div">
                <button type="button" class="btn btn-secondary back">Back</button>
            </a>
            <div class="user-div">
                <fieldset class="border p-2">
                    <legend class="float-none w-auto p-2">Edit User</legend>
                    <form action="edit.php" method="post">
                    <table>
                        <tr>
                        <th>Id</th>
                        </tr>
                        <tr>
                        <td><input type="text" readonly class="form-control" name="id" placeholder="ID" value='{$id}' required/></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="username" placeholder="Write here..." value='{$username}' required/></td>
                        </tr>
                        <tr>
                            <th>Password</th>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="password" placeholder="Write here..." value='{$password}' required/></td>
                        </tr>
                        <tr>
                            <th>Active</th>
                        </tr>
                        <tr>
                            <td><input type="number" class="form-control" name="active" placeholder="1 or 0" value='{$active}' required/></td>
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