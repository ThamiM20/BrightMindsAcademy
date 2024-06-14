<?php
include('includes/connect.php'); 
include('functions/common.fuction.php'); 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bright Minds Academy-Cart details</title>
    <!-- Bootstrap link CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
    <!-- FONT AWESOME link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS code -->
    <link rel="stylesheet" href="style.css">
    <!-- Visual Studio IntelliSense Plugin: jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .cart_img {
            width: 100px;
            height: auto;
            object-fit: contain;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="container-fluid">
        <!-- First child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info p-0">
            <div class="container-fluid">
                <img src="./pictures/logo.png" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./users_area/user_resgistration.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Calling cart function -->
        <?php cart(); ?>

        <!-- Second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <?php
                  if(!isset($_SESSION['username'])) {
                    echo "' <li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome Guest</a>
                </li>";
                } else {
                    echo "<li class='nav-item'>
                            <a class='nav-link' href=''>Welcome " . $_SESSION['username']."</a>
                          </li>";
                }
                
                if(!isset($_SESSION['username'])) {
                  echo "<li class='nav-item'>
                          <a class='nav-link' href='./users_area/user_login.php'>Login</a>
                        </li>";
                } else {
                  echo "<li class='nav-item'>
                          <a class='nav-link' href='./users_area/logout.php'>Logout</a>
                        </li>";
                }
                ?>
                </li>
            </ul>
        </nav>

        <!-- Third child -->
        <div class="bg-light">
            <h3 class="text-center">Bright Academy Store</h3>
            <p class="text-center">Excellence Begins Here</p>
        </div>

        <!-- Fourth child table -->
        <div class="container">
        <div class="row">
            <form action="" method="post">
            <?php
            $get_ip_add = getIPAddress();
            $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
            $result = mysqli_query($conn, $cart_query);
            $result_count = mysqli_num_rows($result);

            if($result_count > 0) {
            ?>
            <table class="table table-bordered text-center">
                <!-- Table headers -->
                <thead>
                            <th>Product Title</th>
                            <th>Product Image</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Remove</th>
                            <th colspan="2">Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- PHP code to display dynamic data -->
                        <?php
                        $total_price = 0.0;
                        $get_ip_add = getIPAddress();
                        $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
                        $result = mysqli_query($conn, $cart_query);

                        if (!$result) {
                            die("Query failed: " . mysqli_error($conn));
                        }

                        $result_count = mysqli_num_rows($result);
                        if($result_count > 0){
                            while ($row = mysqli_fetch_array($result)) {
                                $product_id = $row['product_id'];
                                $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
                                $result_products = mysqli_query($conn, $select_products);

                                if (!$result_products) {
                                    die("Query failed: " . mysqli_error($conn));
                                }

                                while ($row_product_price = mysqli_fetch_array($result_products)) {
                                    $product_price = (float)$row_product_price['product_price'];
                                    $product_title = $row_product_price['product_title'];
                                    $product_image1 = $row_product_price['product_image1'];
                                    $total_price += $product_price;
                                    ?>
                                
                                    <tr>
                                        <td><?php echo $product_title; ?></td>
                                        <td><img src="./product_images/<?php echo $product_image1; ?>" alt="<?php echo $product_title; ?>" class="cart_img"></td>
                                        <td><input type="text" name="qty" id="" class="form-control w-50"></td>
                                        <?php  
                                        if (isset($_POST['update_cart'])) {
                                            $get_ip_add = getIPAddress();
                                            $quantities = (int)$_POST['qty']; // Convert $quantities to an integer
                                            $update_cart = "UPDATE `cart_details` SET quantity = $quantities WHERE ip_address = '$get_ip_add' AND product_id = '$product_id'";
                                            $update_result = mysqli_query($conn, $update_cart);
                                            if (!$update_result) {
                                                die("Update failed: " . mysqli_error($conn));
                                            }
                                            $total_price = (float)$total_price * $quantities; // Ensure $total_price is treated as a float
                                        }
                                        ?>
                                        <td>R<?php echo $product_price; ?></td>
                                        <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id; ?>"></td>
                                        <td>
                                            <input type="submit" value="Update cart" class="bg-info px-3 py-2 border-0 mx-3" name="update_cart">
                                            <input type="submit" value="Remove cart" class="bg-info px-3 py-2 border-0 mx-3" name="remove_cart">
                                        </td>
                                    </tr>
                                    
                                <?php
                                }
                            }
                        } else {
                            echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
                        }
                    }
                        ?>
                    </tbody>
                </table>
                <!-- Subtotal -->
                <?php
                    $get_ip_add = getIPAddress();
                    $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
                    $result = mysqli_query($conn, $cart_query);
                    if (!$result) {
                        die("Query failed: " . mysqli_error($conn));
                    }
                    $result_count = mysqli_num_rows($result);
                    if($result_count> 0){
                        echo "<h4 class='px-3'>Subtotal: <strong class='text-info'> $total_price/-</strong></h4>
                        <input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>
                        <button class='bg-secondary p-3 py-2 border-0'><a href='./users_area/payment.php' class='text-light text-decoration-none'>Checkout</a></button>";                  
                    }else{
                           echo "<input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-8 mx-3' name='continue_shopping'>";
                    }
                    if(isset($_POST['continue_shopping'])){
                        echo"<script>window.open('index.php','_self')</script>";
                    }
                ?>
                <div class="d-flex mb-3">
                
                </div> 
            </div>
        </div>
        </form>
        <!-- function to remove item -->
        <?php
        function remove_cart_item (){
            global $conn;  
            if(isset($_POST['remove_cart'])){
                foreach($_POST['removeitem'] as $remove_id) {
                    echo $remove_id;
                    $delete_query = "DELETE FROM `cart_details` WHERE product_id='$remove_id'";
                    $run_delete = mysqli_query($conn, $delete_query);
                    if($run_delete){
                        echo "<script>window.open('cart.php', '_self')</script>";
                    } else {
                        die("Deletion failed: " . mysqli_error($conn));
                    }
                }
            }
        }
        remove_cart_item();

        ?>
        <!-- Last child -->
        <!-- Include footer -->
        <?php include("./includes/footer.php"); ?>

        <!-- Bootstrap link JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
        crossorigin="anonymous"></script>
</body>
</html>
