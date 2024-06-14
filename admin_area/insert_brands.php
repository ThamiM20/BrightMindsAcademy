<?php
include('../includes/connect.php'); 

if(isset($_POST['insert_brand'])){
    // Check if the "brand_title" key is set in the $_POST array
    if(isset($_POST['brand_title'])){
        $brand_title = $_POST['brand_title'];
        
        // Prepare the SQL query
        $select_query = "SELECT * FROM `brands` WHERE brand_title='$brand_title'";
        $result_select = mysqli_query($conn, $select_query);
        $number = mysqli_num_rows($result_select);
        
        if($number > 0){
            echo "<script>alert('Brand already exists')</script>";
        } else {
            // Prepare and execute the SQL query to insert the brand
            $insert_query = "INSERT INTO `brands` (brand_title) VALUES ('$brand_title')";
            $result = mysqli_query($conn, $insert_query);
            
            // Check if the query was successful
            if($result){
                echo "<script>alert('Brand has been successfully added')</script>";
            } else {
                echo "<script>alert('Error adding brand: " . mysqli_error($conn) . "')</script>";
            }
        }
    } else {
        // Handle case where "brand_title" key is not set in $_POST array
        echo "<script>alert('Brand title is not set')</script>";
    }
}
?>

<h2 class="text-center">Insert  Brands</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1">
            <i class="fa-solid fa-receipt"></i>
        </span>
        <input type="text" class="form-control" name="brand_title" placeholder="Insert Brands" aria-label="Brands" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_brand" value="Insert Brands">
    </div>
</form>
