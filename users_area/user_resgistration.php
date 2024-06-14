<?php 
include('../includes/connect.php'); 
include('../functions/common.fuction.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User registration</title>
        <!--bootstrap link CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
 rel="stylesheet" 
 integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
 crossorigin="anonymous">
</head>
<body>
<div class="container-fluid my-3 mb-3">
    <h2 class="text-center">New User Registration</h2>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-12 col-xl-6">
            <form action="" method="post" enctype="multipart/form-data">
                <!-- Username field -->
                <div class="form-outline mb-4">
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username"/>
                </div>
                <!-- Email field -->
                <div class="form-outline mb-4">
                    <label for="user_email" class="form-label">Email</label>
                    <input type="email" id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" name="user_email"/>
                </div>
                <!-- Image field -->
                <div class="form-outline mb-4">
                    <label for="user_image" class="form-label">User Image</label>
                    <input type="file" id="user_image" class="form-control" required="required" name="user_image"/>
                </div>
                <!-- Password field -->
                <div class="form-outline mb-4">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password"/>
                </div>
                <!-- Confirm Password field -->
                <div class="form-outline mb-4">
                    <label for="conf_user_password" class="form-label">Confirm Password</label>
                    <input type="password" id="conf_user_password" class="form-control" placeholder="Confirm your password" autocomplete="off" required="required" name="conf_user_password"/>
                </div>
                <!-- Address field -->
                <div class="form-outline mb-4">
                    <label for="user_address" class="form-label">Address</label>
                    <input type="text" id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required="required" name="user_address"/>
                </div>
                <!-- Contact field -->
                <div class="form-outline mb-4">
                    <label for="user_contact" class="form-label">Contact</label>
                    <input type="text" id="user_contact" class="form-control" placeholder="Enter your mobile number" autocomplete="off" required="required" name="user_contact"/>
                </div>
                <!-- Submit button -->
                <div class="mt-4 pt-2">
                    <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="user_register">
                    <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="user_login.php" class="text-danger">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<?php
if (isset($_POST['user_register'])) {
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();
// Select query
$select_query = "SELECT * FROM `user_table` WHERE username='$user_username' OR user_email='$user_email'";
$result = mysqli_query($conn, $select_query);

// Check for query execution error
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$rows_count = mysqli_num_rows($result);
if ($rows_count > 0) {
    echo "<script>alert('Username or Email already exists');</script>";
} elseif ($user_password != $conf_user_password) {
    echo "<script>alert('Passwords do not match');</script>";
} else {
    // Move uploaded image
    move_uploaded_file($user_image_tmp, "./user_images/$user_image");

    // Insert query
    $insert_query = "INSERT INTO `user_table` (username, user_email, user_password, user_image, user_ip, user_address, user_mobile) 
    VALUES ('$user_username', '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$user_contact')";
    $sql_execute = mysqli_query($conn, $insert_query);

    if ($sql_execute) {
        echo "<script>alert('Data inserted successfully');</script>";
    } else {
        die(mysqli_error($conn));
    }
}

//selecting cart items
$select_cart_items = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";

$result_cart=mysqli_query($conn, $select_cart_items);
$rows_count=mysqli_num_rows($result_cart);
if($rows_count>0){
$_SESSION['username']=$user_username;
echo "<script> alert('You have items in your cart')</script>";
echo "<script>window.open('checkout.php', '_self')</script>";
}else{
echo "<script>window.open('../index.php','_self')</script>";
}
}
?>
