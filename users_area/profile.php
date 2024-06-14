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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bright Minds Academy</title>
 <!--bootstrap link CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
 rel="stylesheet" 
 integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
 crossorigin="anonymous">
  <!--FONT AWESOME link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
  integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
  crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- css code -->
  <link rel="stylesheet" href="../style.css">
  <!-- Visual Studio IntelliSense Plugin: jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
.profile_img{
    width: 90%;
    margin: auto;
    display: block;
    height: 90%;
    object-fit: contain;
}
.edit_image {
        width: 50px;
        height: 50px;
        object-fit: cover;
        margin-left: 10px;
}
</style>

</head>
<body>
    <!-- navbar  -->
    <div class="container-fluid">
        <!-- firstchild -->
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
           <a class="nav-link" href="../display_all.php">Products</a>
         </li>
         <li class="nav-item">
          <a class="nav-link" href="profile.php">My Account</a>
         </li>
         <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
         </li>
         <li class="nav-item">
          <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();?></sup></a>
         </li>
         <li class="nav-item">
    <a class="nav-link" href="#">Total Price: R <?php echo total_cart_price(); ?></a>
</li>
       </ul>
      <form class="d-flex" action="../search_product.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
        <input type="submit" value="search" class="btn btn-outline-light" name="search_data_product">
      </form>
    </div>
  </div>
</nav>

<!-- calling  -->
<?php
cart();
?>
<!-- second child -->
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
      // Step 3: If 'username' is not set, display the Login link
      echo "<li class='nav-item'>
              <a class='nav-link' href='./users_area/user_login.php'>Login</a>
            </li>";
  } else {
      // Step 4: If 'username' is set, display the Logout link
      echo "<li class='nav-item'>
              <a class='nav-link' href='./users_area/logout.php'>Logout</a>
            </li>";
  }
    ?>
      </li>
  </ul>
</nav>

<!-- third child -->
<div class="bg-light">
  <h3 class="text-center">Bright Acdemy Store</h3>
  <p class="text-center">Excellence Begins Here</p>
</div>

<!-- fourth child -->
<div class="row">
<div class="col-md-2 p-0">
<ul class="navbar-nav bg-secondary text-center" style="height:100vh">
<li class="nav-item bg-info">
          <a class="nav-link text-light" href="#"><h4>Your Profile</h4></a>
         </li>
         <?php 
      $username = $_SESSION['username'];
      $user_image_query = "SELECT user_image FROM user_table WHERE username='$username'";
      $user_image_result = mysqli_query($conn, $user_image_query);
      $row_image = mysqli_fetch_array($user_image_result);
      $user_image = $row_image['user_image'];
      
      echo "<li class='nav-item'>
              <img src='./user_images/$user_image' class='profile_img my-4' alt=''>
            </li>";
      ?>
         <li class="nav-item ">
          <a class="nav-link text-light" href="profile.php">Pending Orders</a>
         </li>
         <li class="nav-item ">
          <a class="nav-link text-light" href="profile.php?edit_account">Edit Account</a>
         </li>
         <li class="nav-item ">
          <a class="nav-link text-light" href="profile.php?my_orders">My Orders</a>
         </li>
         <li class="nav-item ">
          <a class="nav-link text-light" href="profile.php?delete_account">Delete Acoount</a>
         </li>
         <li class="nav-item ">
          <a class="nav-link text-light" href="logout.php">Logout</a>
         </li>
</ul>
</div>
<div class="col-md-10 text-center">
    <?php get_user_order_details();
    if(isset($_GET['edit_account'])){
        include('edit_account.php');
    }
    if(isset($_GET['my_orders'])){
      include('user_orders.php');
  }
  if(isset($_GET['delete_account'])){
    include('delete_account.php');
}
    ?>
    
</div>
</div>
<!-- last child -->
<!-- include footer -->
<?php include("../includes/footer.php"); ?>

 <!--bootstrap link JS -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
 integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
 crossorigin="anonymous"></script>
</body>
</html>

