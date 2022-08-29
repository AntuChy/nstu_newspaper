<?php
include "config.php";

if($_SESSION["user_role"]==0){
    header("Location:http://localhost/NSTU_NEWSPAPER/admin/post.php");   
}

$user_id=$_GET['id'];
$sql="DELETE FROM user where user_id='{$user_id}'";
if(mysqli_query($conn,$sql)){
    header("Location:http://localhost/NSTU_NEWSPAPER/admin/users.php");
}
    else{
        echo "<p style='color:red; margin:10px 0;'> Query unsuccessful!</P";
    }
        

?>
