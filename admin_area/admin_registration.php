<?php 
include('../includes/connect.php'); 
include('../functions/common.fuction.php');

if (isset($_POST['admin_registration'])) {
    $admin_name = $_POST['username'];
    $admin_email = $_POST['email'];
    $admin_password = $_POST['password'];
    $hash_password = password_hash($admin_password, PASSWORD_DEFAULT);
    $conf_admin_password = $_POST['confirm_password'];

    // Select query
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$admin_name' OR admin_email='$admin_email'";
    $result = mysqli_query($conn, $select_query);

    // Check for query execution error
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $rows_count = mysqli_num_rows($result);
    if ($rows_count > 0) {
        echo "<script>alert('Username or Email already exists');</script>";
    } elseif ($admin_password != $conf_admin_password) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        // Insert query
        $insert_query = "INSERT INTO `admin_table` (admin_name, admin_email, admin_password) 
        VALUES ('$admin_name', '$admin_email', '$hash_password')";
        $sql_execute = mysqli_query($conn, $insert_query);

        if ($sql_execute) {
            echo "<script>alert('Data inserted successfully');</script>";
        } else {
            die(mysqli_error($conn));
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
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
        <h2 class="text-center mb-5">Admin Registration</h2>
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
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required class="form-control">
                    </div>
                    <div>
                        <input type="submit" class="btn btn-info py-2 px-3" name="admin_registration" value="Register">
                        <p class="small">Already have an account? <a href="admin_login.php">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
