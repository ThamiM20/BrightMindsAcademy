<?php
include('../includes/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bright Minds Academy Check out page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
          crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
    .logo{
width:7%;
height: 7%;

    }</style>
</head>
<body>
    <!-- Navbar -->
    <div class="container-fluid">
        <!-- First Child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info p-0">
            <div class="container-fluid">
                <img src="../pictures/logo.png" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user_resgistration.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                    <form class="d-flex" action="search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>

        <!-- Second Child -->
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
                
                if (!isset($_SESSION['username'])) {
                    // If 'username' is not set, display the Login link
                    echo "<li class='nav-item'>
                            <a class='nav-link' href='./user_login.php'>Login</a>
                          </li>";
                } else {
                    // If 'username' is set, display the Logout link
                    echo "<li class='nav-item'>
                            <a class='nav-link' href='logout.php'>Logout</a>
                          </li>";
                }
                ?>
            </ul>
        </nav>

        <!-- Third Child -->
        <div class="bg-light">
            <h3 class="text-center">Bright Academy Store</h3>
            <p class="text-center">Excellence Begins Here</p>
        </div>

        <!-- Fourth Child -->
        <div class="row px-1">
            <div class="col-md-12">
                <div class="row">
                    <?php
                    if (!isset($_SESSION['username'])) {
                        include('user_login.php');
                    } else {
                        include('./payment.php');
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Last Child -->
        <!-- Include Footer -->
        <?php include("../includes/footer.php"); ?>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
                crossorigin="anonymous"></script>
    </div>
</body>
</html>
