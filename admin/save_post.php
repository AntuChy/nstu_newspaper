<?php
include "config.php";
if(isset($_FILES['fileToUpload']))
{
    $errors=array();
    $file_name=$_FILES['fileToUpload']['name'];
    $file_size=$_FILES['fileToUpload']['size'];
    $file_tmp=$_FILES['fileToUpload']['tmp_name'];
    $file_type=$_FILES['fileToUpload']['type'];
    $file_ext=strtolower(end(explode('.',$file_name)));
    $extention=array("jpg","jpeg","png");
    if(in_array($file_ext,$extention)===false)
    {
        $errors[]="This extension file format is not allowed!";
    }
    if($file_size>3145728){
        $errors[]="File size is too large, must be lower than 3MB!";
    }
    
    
    if(empty($errors)==true)
    {
        move_uploaded_file($file_tmp,'upload/'.$file_name);
    }
    else 
    {
        print_r($errors);
        die();
    }
}
session_start();
$title=mysqli_real_escape_string($conn,$_POST['post_title']);
    $description=mysqli_real_escape_string($conn,$_POST['postdesc']);
    $category=mysqli_real_escape_string($conn,$_POST['category']);
    $date=date("d M, Y");
    $author=$_SESSION['user_id'];
    $sql="INSERT INTO post(title,description,category,post_date,author,post_img)
    values ('{$title}','{$description}','{$category}','{$date}','{$author}','{$file_name}');";
    $sql .="UPDATE category SET post=post+1 WHERE category_id={$category}";
    
    if(mysqli_multi_query($conn,$sql))
    {
        header("Location:http://localhost/NSTU_NEWSPAPER/admin/post.php");
    }
    else
    {
        echo "<div> CAN'T RUN QUERY</div>";
    }
?>