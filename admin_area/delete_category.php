<?php
include('../includes/connect.php'); 

if(isset($_GET['delete_category'])){
    $delete_category = $_GET['delete_category'];

    // SQL delete query
    $delete_query = "DELETE FROM categories WHERE category_id = $delete_category";
    $result = mysqli_query($conn, $delete_query);

    if($result){
        echo "<script>alert('Category has been deleted successfully');</script>";
        echo "<script>window.open('./index.php?view_category', '_self');</script>";
    } else {
        echo "<script>alert('Failed to delete category');</script>";
    }
}
?>
