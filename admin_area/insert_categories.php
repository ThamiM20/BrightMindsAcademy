<?php
include('../includes/connect.php'); 

if(isset($_POST['insert_cat'])){
    $category_title = $_POST['cat_title'];

    // Prepare the SQL query;
    $select_query="Select * from `categories` where category_title='$category_title'";
    $result_select= mysqli_query($conn, $select_query);
    $number=mysqli_num_rows($result_select);
    if($number> 0){
        echo "<script>alert('Category alreadt exists')</script>";
    }else{
    $insert_query = "INSERT INTO `categories` (category_title) VALUES ('$category_title')";
    $result = mysqli_query($conn, $insert_query);
    
    // Check if the query was successful
    if($result){
        echo "<script>alert('Category has been successfully added')</script>";
    } else {
        echo "<script>alert('Error adding category: " . mysqli_error($conn) . "')</script>";
    }
}}
?>

<h2 class="text-center">Insert Categories</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1">
            <i class="fa-solid fa-receipt"></i>
        </span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert Categories" aria-label="Categories" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_cat" value="Insert Categories">
    </div>
</form>
