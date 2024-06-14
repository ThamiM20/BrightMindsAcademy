<?php
include('../includes/connect.php'); 

if(isset($_GET['delete_brands'])){
    $delete_brands = $_GET['delete_brands'];

    // SQL delete query
    $delete_query = "DELETE FROM brands WHERE brand_id = $delete_brands";
    $result = mysqli_query($conn, $delete_query);

    if($result){
        echo "<script>alert('Brand has been deleted successfully');</script>";
        echo "<script>window.open('./index.php?view_brand', '_self');</script>";
    } else {
        echo "<script>alert('Failed to delete brand');</script>";
    }
}
?>
