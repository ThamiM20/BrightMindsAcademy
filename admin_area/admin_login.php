<?php 
include('../includes/connect.php'); 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['admin_login'])) {
    $admin_username = mysqli_real_escape_string($conn, $_POST['username']);
    $admin_password = $_POST['password'];

    // Prepared statement to prevent SQL injection
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name = ?";
    $stmt = mysqli_prepare($conn, $select_query);
    mysqli_stmt_bind_param($stmt, "s", $admin_username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row_count = mysqli_num_rows($result);

    if ($row_count > 0) {
        $row_data = mysqli_fetch_assoc($result);
        if (password_verify($admin_password, $row_data['admin_password'])) {
            $_SESSION['admin_username'] = $admin_username;
            echo "<script>alert('Login successful');</script>";
            echo "<script>window.open('../admin_area/index.php', '_self');</script>";
        } else {
            echo "<script>alert('Invalid Credentials');</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap link CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- FONT AWESOME link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Login</h2>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-6 col">
                <img src="../images/adminreg.png" alt="Admin Registration" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required class="form-control">
                    </div>
                    <div>
                        <input type="submit" class="btn btn-info py-2 px-3" name="admin_login" value="Login">
                        <p class="small"> Don't have an account? <a href="admin_registration.php">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
