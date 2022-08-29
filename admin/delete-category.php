    <?php
    include 'config.php';
    if($_SESSION["user_role"] == '0'){
      header("Location:http://localhost/NSTU_NEWSPAPER/admin/post.php");
    }
    $cat_id = $_GET["id"];

    /*sql to delete a record*/
    $sql = "DELETE FROM category WHERE category_id ='{$cat_id}'";

    if (mysqli_query($conn, $sql)) {
        header("Location:http://localhost/NSTU_NEWSPAPER/admin/category.php");
    }

    mysqli_close($conn);

?>