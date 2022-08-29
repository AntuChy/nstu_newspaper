<?php
include "config.php";
if(empty($_FILES['new-image']['name']))
{
$file_name=$_POST['old_image'];
}
else{
    
        $errors=array();
        $file_name=$_FILES['new-image']['name'];
        $file_size=$_FILES['new-image']['size'];
        $file_tmp=$_FILES['new-image']['tmp_name'];
        $file_type=$_FILES['new-image']['type'];
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
    $title=mysqli_real_escape_string($conn,$_POST['post_title']);
    $description=mysqli_real_escape_string($conn,$_POST['postdesc']);
    $category=mysqli_real_escape_string($conn,$_POST['category']);
$sql="UPDATE post SET title='{$title}',description='{$description}',category='{$category}',post_img='{$file_name}'
WHERE post_id={$_POST['post_id']};";
if($_POST['old_category']!=$_POST['category'])
{
    $sql .="UPDATE category SET post=post-1 WHERE category_id={$_POST['old_category']};";
    $sql .="UPDATE category SET post=post+1 WHERE category_id={$_POST['category']}";
}

$result=mysqli_multi_query($conn,$sql);
if($result)
{
    header("Location:http://localhost/NSTU_NEWSPAPER/admin/post.php");
}
else
{
    echo "QUERY FAILED!";
}


?>



