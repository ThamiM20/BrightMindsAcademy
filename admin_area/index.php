<?php
session_start(); // Start the session

include('../includes/connect.php'); 
include('../functions/common.fuction.php'); 

// Assuming admin name is stored in a session variable
$admin_name = isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : 'Admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap link CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
          crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../style.css">
    <style>
        .admin_image {
            width: 100px;
            object-fit: contain;
        }
        .footer {
            position: absolute;
            bottom: 0;
        }
        .profile_img {
            width: 100%;
            height: 100%;
        }
        .product_img {
            width: 100px;
            object-fit: contain;
        }
    </style>
</head>
<body>
<!--navbar-->
<div class="container-fluid p-0">
    <!--first child-->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <img src="../pictures/logo.png" alt="" class="logo">
            <nav class="navbar navbar-expand-lg">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="" class="nav-link">Welcome, <?php echo htmlspecialchars($admin_name); ?></a>
                    </li>
                </ul>
            </nav>
        </div>
    </nav>

    <!--second child-->
    <div class="bg-light">
        <h3 class="text-center p-2">Manage details</h3>
    </div>

    <!--third child-->
    <div class="row">
        <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
            <div>
                <div class="px-5">
                    <a href="#"><img src="../pictures/Stationery/Erasers.jpg" alt="" class="admin_image"></a>
                    <p class="text-light text-center"><?php echo htmlspecialchars($admin_name); ?></p>
                </div>
            </div>
            <!--button*10>a.nav-link.text-light.bg-info.my-1-->
            <div class="button text-center">
                <button class="my-3"><a href="insert_product.php" class="nav-link text-light bg-info my-1">Insert Products</a></button>
                <button><a href="index.php?view_products" class="nav-link text-light bg-info my-1">View Products</a></button>
                <button><a href="index.php?insert_category" class="nav-link text-light bg-info my-1">Insert Categories</a></button>
                <button><a href="index.php?view_category" class="nav-link text-light bg-info my-1">View Categories</a></button>
                <button><a href="index.php?insert_brand" class="nav-link text-light bg-info my-1">Insert Brand</a></button>
                <button><a href="index.php?view_brand" class="nav-link text-light bg-info my-1">View Brand</a></button>
                <button><a href="index.php?list_orders" class="nav-link text-light bg-info my-1">All Orders</a></button>
                <button><a href="index.php?list_payments" class="nav-link text-light bg-info my-1">All Payments</a></button>
                <button><a href="index.php?list_users" class="nav-link text-light bg-info my-1">List Users</a></button>
                <button><a href="admin_logout.php" class="nav-link text-light bg-info my-1">Logout</a></button>
            </div>
        </div>
    </div>

    <!-- fourth child -->
    <div class="container my-5">
        <?php 
        if(isset($_GET['insert_category'])){
            include('insert_categories.php');
        }
        if(isset($_GET['insert_brand'])){
            include('insert_brands.php');
        }
        if(isset($_GET['view_products'])){
            include('view_products.php');
        }
        if(isset($_GET['edit_products'])){
            include('edit_products.php');
        }
        if(isset($_GET['delete_product'])){
            include('delete_product.php');
        }
        if(isset($_GET['view_category'])){
            include('view_categories.php');
        }
        if(isset($_GET['view_brand'])){
            include('view_brands.php');
        }
        if(isset($_GET['edit_category'])){
            include('edit_categories.php');
        }
        if(isset($_GET['edit_brands'])){
            include('edit_brands.php');
        }
        if(isset($_GET['delete_category'])){
            include('delete_category.php');
        }
        if(isset($_GET['list_orders'])){
            include('list_orders.php');
        }
        if(isset($_GET['list_payments'])){
            include('list_payments.php');
        }
        if(isset($_GET['list_users'])){
            include('list_users.php');
        }
        ?>
    </div>

    <!-- last child -->
    <?php 
    if (file_exists("../includes/footer.php")) {
        include("../includes/footer.php"); 
    } else {
        echo '<p>Footer file not found.</p>';
    }
    ?>
</div>

<!--bootstrap link JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
        crossorigin="anonymous"></script>
</body>
</html>
