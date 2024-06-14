<?php
if(isset($_GET['delete_product'])){
    $delete_id = $_GET['delete_product'];

    // Delete query
    $delete_product = "DELETE FROM `products` WHERE product_id=$delete_id";
    $result_product = mysqli_query($conn, $delete_product);  // Corrected the variable name to $delete_product

    if($result_product){
        echo "<script>alert('Product deleted successfully');</script>";  // Corrected the alert script
        echo "<script>window.open('./index.php', '_self');</script>";
    } else {
        echo "<script>alert('Failed to delete product');</script>";  // Added error handling
    }
}
?>
