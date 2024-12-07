<!DOCTYPE html>
<html>
    <head>
        <title>Add User</title>
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
            .save{
                margin-top: 1rem;
            }
            table tr:last-child td{
                justify-content: center;
                align-items: center;
                text-align: center;
            
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
                    <legend class="float-none w-auto p-2">Add User</legend>
                    <form action="create.php" method="post">
                    <table>
                        <tr>
                            <th>Username</th>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="username" placeholder="Write here..." required/></td>
                        </tr>
                        <tr>
                            <th>Password</th>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="password" placeholder="Write here..." required/></td>
                        </tr>
                        <tr>
                            <th>Active</th>
                        </tr>
                        <tr>
                            <td><input type="number" class="form-control" name="active" placeholder="1 or 0" required/></td>
                        </tr>
                        <tr>
                            <td><button type="submit" class="btn btn-primary save">Save Changes</button></td>
                        </tr>
                    </table>
                    </form>
                </fieldset>
            </div>
        </div>
    </body>
</html>
<?php require_once('../../php_action/db_connect.php');
if($_POST){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $active=$_POST['active'];
    $sql="INSERT INTO user (username,password,active) VALUES('$username','$password','$active')";
    if($connect->query($sql)===TRUE){
        header("Location:../user/user.php");
    }
}
$connect->close();
?>