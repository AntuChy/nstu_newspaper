<?php include "header.php"; 
if($_SESSION["user_role"]==0){
    header("Location:http://localhost/NSTU_NEWSPAPER/admin/post.php");   
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
              <?php
                include 'config.php';// database configuration
                 /* Calculate Offset Code */
                  $limit = 3;
                  if(isset($_GET["page"])){
                      $page = $_GET["page"];
                  }
                  else{
                      $page = 1;
                  };
                  $offset = ($page-1)* $limit;
              /* select query with offset and limit */
              $sql = "SELECT * FROM  category ORDER BY category_id  Limit $offset,$limit";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                  $table = '<table class="content-table">';
                  $table .= '<thead>
                                  <th>S.No.</th>
                                  <th>Category Name</th>
                                  <th>No. of Posts</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                              </thead>
                              <tbody>';
                    $serial = $offset + 1;
                  while($row = mysqli_fetch_assoc($result)) {
                    $table .= "<tr>
                            <td class='id'>{$serial}</td>
                            <td>{$row["category_name"]}</td>
                            <td>{$row["post"]}</td>
                            <td class='edit'><a href='update-category.php?id={$row['category_id']}' ><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id={$row['category_id']}'><i class='fa fa-trash-o'></i></a></td>
                        </tr>";
                        $serial++;
                  }
                  $table .= '</tbody></table>';
                  // show table
                  echo $table;
              } else {
                  echo "<h3>No Results Found.</h3>";
              }
              $sql1 = "SELECT * FROM category";
              $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

              if(mysqli_num_rows($result1) > 0){

                $total_records = mysqli_num_rows($result1);

                $total_page = ceil($total_records / $limit);

                echo '<ul class="pagination admin-pagination">';
                
                for($i = 1; $i <= $total_page; $i++){
                  if($i == $page){
                    $active = "active";
                  }else{
                    $active = "";
                  }
                  echo "<li class=$active><a href='category.php?page={$i}' >{$i}</a></li>";
                }
                
                echo '</ul>';
              }
              ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
