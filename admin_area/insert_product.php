<?php
include('../includes/connect.php'); 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert_product'])) {
    $product_title = mysqli_real_escape_string($conn, $_POST['product_title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $product_keywords = mysqli_real_escape_string($conn, $_POST['product_keywords']);
    $product_category = mysqli_real_escape_string($conn, $_POST['product_category']);
    $product_brands = mysqli_real_escape_string($conn, $_POST['product_brands']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];

    $target1 = "./product_images/" . basename($product_image1);
    $target2 = "./product_images/" . basename($product_image2);

    $sql = "INSERT INTO products (product_title, product_description, product_keywords, category_id, brand_id, product_image1, product_image2, product_price, date, status) 
            VALUES ('$product_title', '$description', '$product_keywords', '$product_category', '$product_brands', '$product_image1', '$product_image2', '$product_price', NOW(), 'true')";

    if ($conn->query($sql) === TRUE) {
        $success = true;
        if (!move_uploaded_file($_FILES['product_image1']['tmp_name'], $target1)) {
            $message = "Failed to upload image 1.";
            $success = false;
        }
        if (!move_uploaded_file($_FILES['product_image2']['tmp_name'], $target2) && $success) {
            $message .= " Failed to upload image 2.";
        }
        if ($success) {
            $message = "Product added successfully.";
        }
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inser products-Admni Dashboard</title>
     <!--bootstrap link CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
 rel="stylesheet" 
 integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
 crossorigin="anonymous">
 <!--FONT AWESOME link  -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
  integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
  crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="style.css">
  <!-- Visual Studio IntelliSense Plugin: jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <!-- css code -->
 <link rel="stylesheet" href="../style.css">

</head>
<body class="bg-light">
<div class="container mt-3">
    <h1 class="text-center">Insert Products</h1>
    <!-- form -->
    <form action="" method="post" enctype="multipart/form-data">
        <!-- title -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" name="product_title" id="product_title" class="form-control" 
                   placeholder="Enter product title" autocomplete="off" required="required">
        </div>

        <!-- description -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="description" class="form-label">Product Description</label>
            <input type="text" name="description" id="description" class="form-control" 
                   placeholder="Enter product description" autocomplete="off" required="required">
        </div>

        <!-- keywords -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" name="product_keywords" id="product_keywords" class="form-control" 
                   placeholder="Enter product keywords" autocomplete="off" required="required">
        </div>

        <!-- categories -->
        <div class="form-outline mb-4 w-50 m-auto">
            <select name="product_category" id="" class="form-select">
                <option value="">Select A Category</option>
                <?php
// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Execute the query to select categories
$select_query = "SELECT * FROM `categories`";
$result_query = mysqli_query($conn, $select_query);
// Check if the query was successful
if (!$result_query) {
    die("Query failed: " . mysqli_error($conn));
}
// Loop through the results and display the categories
while ($row = mysqli_fetch_assoc($result_query)) {
    $category_title = $row['category_title'];
    $category_id = $row['category_id'];

    echo "<option value='$category_id'>$category_title</option>";
}
?>

            </select>
        </div>

        <!-- Brands -->
        <div class="form-outline mb-4 w-50 m-auto">
            <select name="product_brands" id="" class="form-select">
                <option value="">Select A Brands</option>
                <?php
// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Execute the query to select brands
$select_query = "SELECT * FROM `brands`";
$result_query = mysqli_query($conn, $select_query);
// Check if the query was successful
if (!$result_query) {
    die("Query failed: " . mysqli_error($conn));
}
// Loop through the results and display the brands
while ($row = mysqli_fetch_assoc($result_query)) {
    $brand_title = $row['brand_title'];
    $brand_id = $row['brand_id'];
    echo "<option value='$brand_id'>$brand_title</option>";
}
?>

            </select>
        </div>
        
         <!-- Image 1 -->
         <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_image1" class="form-label">Product Image 1</label>
            <input type="file" name="product_image1" id="product_image1" class="form-control" 
             required="required">

        </div> 
         <!-- Image 2 -->
         <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_image2" class="form-label">Product Image 2</label>
            <input type="file" name="product_image2" id="product_image2" class="form-control" 
             required="required">
        </div> 

         <!-- Price -->
         <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_price" class="form-label">Product price</label>
            <input type="text" name="product_price" id="product_price" class="form-control" 
                   placeholder="Enter product price" autocomplete="off" required="required">
        </div>

          <!-- submit -->
          <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert Products" >
        </div>
        
    </form>
</div>

</body>
</html>