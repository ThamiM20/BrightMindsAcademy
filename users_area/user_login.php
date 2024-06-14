<?php 
include('../includes/connect.php'); 
include('../functions/common.fuction.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
          crossorigin="anonymous">
    <style>
        overflow-x:hidden
    </style>
</head>
<body>
<div class="container-fluid my-3">
    <h2 class="text-center">User Login</h2>
    <div class="row d-flex align-items-center justify-content-center mt-5">
        <div class="col-lg-12 col-xl-6">
            <form action="" method="post" >
                <!-- Username field -->
                <div class="form-outline mb-4">
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username"/>
                </div>
                <!-- Password field -->
                <div class="form-outline mb-4">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password"/>
                </div>
                <!-- Submit button -->
                <div class="mt-4 pt-2">
                    <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="user_login">
                    <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="user_registration.php" class="text-danger">Register</a></p>
                    <!-- Link to admin login page -->
                    <p class="small fw-bold mt-2 pt-1 mb-0">Admin? <a href="../admin_area/admin_login.php" class="text-danger">Login Here</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

<?php
if (isset($_POST['user_login'])) {
    $user_username = mysqli_real_escape_string($conn, $_POST['user_username']);
    $user_password = $_POST['user_password'];
    $user_ip = getIPAddress();

    // Prepared statement to prevent SQL injection
    $select_query = "SELECT * FROM `user_table` WHERE username = ?";
    $stmt = mysqli_prepare($conn, $select_query);
    mysqli_stmt_bind_param($stmt, "s", $user_username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row_count = mysqli_num_rows($result);

    // Cart item query
    $select_query_cart = "SELECT * FROM `cart_details` WHERE ip_address = ?";
    $stmt_cart = mysqli_prepare($conn, $select_query_cart);
    mysqli_stmt_bind_param($stmt_cart, "s", $user_ip);
    mysqli_stmt_execute($stmt_cart);
    $select_cart = mysqli_stmt_get_result($stmt_cart);
    $row_count_cart = mysqli_num_rows($select_cart);

    if ($row_count > 0) {
        $row_data = mysqli_fetch_assoc($result);
        if (password_verify($user_password, $row_data['user_password'])) {
            $_SESSION['username'] = $user_username;
            if ($row_count == 1 && $row_count_cart == 0) {
                echo "<script>alert('Login successful');</script>";
                echo "<script>window.open('profile.php', '_self');</script>";
            } else {
                echo "<script>alert('Login successful');</script>";
                echo "<script>window.open('payment.php', '_self');</script>";
            }
        } else {
            echo "<script>alert('Invalid Credentials');</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials');</script>";
    }
}
?>
