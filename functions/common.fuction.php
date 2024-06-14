<?php

// include('./includes/connect.php'); 

// getting products
function getproducts(){
    global $conn;
    if(!isset($_GET['category']) && !isset($_GET['brand'])) {
        $select_query = "SELECT * FROM `products` ORDER BY RAND() LIMIT 9";
        $result_query = mysqli_query($conn, $select_query);

        if ($result_query) {
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_price = $row['product_price'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];

                echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price:R $product_price</p>
                                <a href='index.php?add_to_cart= $product_id' class='btn btn-info'>Add to cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                
                            </div>
                        </div>
                    </div>";
            }
        } else {
            echo "Query failed: " . mysqli_error($conn);
        }
    }
}

// getting all products
function get_all_products(){
    global $conn;

    if(!isset($_GET['category']) && !isset($_GET['brand'])) {
        $select_query = "SELECT * FROM `products` ORDER BY RAND()";
        $result_query = mysqli_query($conn, $select_query);

        if ($result_query) {
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];

                echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price:R $product_price</p>
                                <a href='index.php?add_to_cart= $product_id' class='btn btn-info'>Add to cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div>";
            }
        } else {
            echo "Query failed: " . mysqli_error($conn);
        }
    }
}

// getting unique categories
function getunique_categories() {
    global $conn;

    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];
        $select_query = "SELECT * FROM `products` WHERE category_id = $category_id";
        $result_query = mysqli_query($conn, $select_query);

        if ($result_query) {
            $num_of_rows = mysqli_num_rows($result_query);

            if ($num_of_rows == 0) {
                echo "<h2 class='text-center text-danger'>No stock for this category</h2>";
            } else {
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_description = $row['product_description'];
                    $product_image1 = $row['product_image1'];
                    $product_price = $row['product_price'];

                    echo "<div class='col-md-4 mb-2'>
                            <div class='card'>
                                <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text'>$product_description</p>
                                    <p class='card-text'>Price:R $product_price</p>
                                    <a href='index.php?add_to_cart= $product_id' class='btn btn-info'>Add to cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                </div>
                            </div>
                        </div>";
                }
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// getting unique brands
function getunique_brands() {
    global $conn;

    if (isset($_GET['brand'])) {
        $brand_id = $_GET['brand'];
        $select_query = "SELECT * FROM `products` WHERE brand_id = $brand_id";
        $result_query = mysqli_query($conn, $select_query);

        if ($result_query) {
            $num_of_rows = mysqli_num_rows($result_query);

            if ($num_of_rows == 0) {
                echo "<h2 class='text-center text-danger'>This brand is not available</h2>";
            } else {
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_description = $row['product_description'];
                    $product_image1 = $row['product_image1'];
                    $product_price = $row['product_price'];

                    echo "<div class='col-md-4 mb-2'>
                            <div class='card'>
                                <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text'>$product_description</p>
                                    <p class='card-text'>Price:R $product_price</p>
                                    <a href='index.php?add_to_cart= $product_id' class='btn btn-info'>Add to cart</a>
                                    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                </div>
                            </div>
                        </div>";
                }
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// displaying brands inside nav
function getbrands(){
    global $conn;

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $select_brands = "SELECT * FROM `brands`";
    $result_brands = mysqli_query($conn, $select_brands);

    if (!$result_brands) {
        die("Error executing query: " . mysqli_error($conn));
    }

    while ($row_brand = mysqli_fetch_assoc($result_brands)) {
        $brand_title = $row_brand['brand_title'];
        $brand_id = $row_brand['brand_id'];

        echo "<li class='nav-item'>
                  <a href='index.php?brand=$brand_id' class='nav-link text-light'><h4>$brand_title</h4></a>
              </li>";
    }
}

// display categories inside nav
function getcategories(){
    global $conn;

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $select_categories = "SELECT * FROM `categories`";
    $result_categories = mysqli_query($conn, $select_categories);

    if (!$result_categories) {
        die("Error executing query: " . mysqli_error($conn));
    }

    while ($row_category = mysqli_fetch_assoc($result_categories)) {
        $category_title = $row_category['category_title'];
        $category_id = $row_category['category_id'];

        echo "<li class='nav-item'>
                  <a href='index.php?category=$category_id' class='nav-link text-light'><h4>$category_title</h4></a>
              </li>";
    }
}

// searching products
function search_products(){
    global $conn;

    if (isset($_GET['search_data_product'])) {
        $search_data_value = $_GET['search_data'];
        $search_query = "SELECT * FROM `products` WHERE product_keywords LIKE '%$search_data_value%'";

        $result_query = mysqli_query($conn, $search_query);

        if ($result_query) {
            $num_of_rows = mysqli_num_rows($result_query);

            if ($num_of_rows == 0) {
                echo "<h2 class='text-center text-danger'>No results match. No products found on this category!</h2>";
            } else {
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_description = $row['product_description'];
                    $product_image1 = $row['product_image1'];
                    $product_price = $row['product_price'];

                    echo "<div class='col-md-4 mb-2'>
                            <div class='card'>
                                <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text'>$product_description</p>
                                    <p class='card-text'>Price:R $product_price</p>
                                    <a href='index.php?add_to_cart= $product_id' class='btn btn-info'>Add to cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                </div>
                            </div>
                        </div>";
                }
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// view details function
function view_details(){
    global $conn;
    if (isset($_GET["product_id"])) {
        if (!isset($_GET['category']) && !isset($_GET['brand'])) {
            $product_id = $_GET['product_id']; // Correct variable usage
            $select_query = "SELECT * FROM `products` WHERE product_id=$product_id";
            $result_query = mysqli_query($conn, $select_query);
    
            if ($result_query) {
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_description = $row['product_description'];
                    $product_image1 = $row['product_image1'];
                    $product_image2 = $row['product_image2'];
                    $product_price = $row['product_price'];
                    echo "<div class='col-md-4 mb-2'>
                            <div class='card'>
                                <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text'>$product_description</p>
                                    <p class='card-text'>Price:R $product_price</p>
                                    <a href='index.php?add_to_cart= $product_id' class='btn btn-info'>Add to cart</a>
                                    <a href='index.php' class='btn btn-secondary'>Go home</a>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-8'>
                            <div class='row'>
                                <div class='col-md-12'>
                                    <h4 class='text-center text-info mb-5'>Related products</h4>
                                </div>
                                <div class='col-md-6'>
                                <img src='./admin_area/product_images/$product_image2' class='card-img-top' alt='$product_title'>
                                </div>
                            </div>
                        </div>";
                }
            } else {
                echo "Query failed: " . mysqli_error($conn);
            }
        }
    }
    
}
// get ip address function
function getIPAddress() {
    // Function to get the IP address of the user
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// cart function
function cart(){
    if(isset($_GET['add_to_cart'])) {
        global $conn; // Use the global connection variable
        $get_ip_add = getIPAddress();
        $get_product_id = $_GET['add_to_cart'];

        // Build the SELECT query to check if the product is already in the cart
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add' AND product_id=$get_product_id";
        $result_query = mysqli_query($conn, $select_query);

        // Check if the query was successful
        if ($result_query) {
            $num_of_rows = mysqli_num_rows($result_query);
            if($num_of_rows > 0) {
                echo "<script>alert('This item is already present inside cart');</script>";
                echo "<script>window.open('index.php', '_self');</script>";
            } else {
                // Build the INSERT query to add the product to the cart
                $insert_query = "INSERT INTO `cart_details` (product_id, ip_address, quantity) VALUES ($get_product_id, '$get_ip_add', 1)";
                $result_query = mysqli_query($conn, $insert_query);

                // Check if the insert query was successful
                if ($result_query) {
                    echo "<script>window.open('index.php', '_self');</script>";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// function to get cart item numbers
function cart_item(){
    global $conn;
    $get_ip_add = getIPAddress();
    $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
    $result_query = mysqli_query($conn, $select_query);
    $count_cart_items = mysqli_num_rows($result_query);
    echo $count_cart_items;
}

// total price function
function total_cart_price(){
    global $conn; // Ensure the database connection is available
    $get_ip_add = getIPAddress();
    $total = 0;

    // Corrected SQL query
    $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
    $result = mysqli_query($conn, $cart_query);

    if(!$result){
        echo "Error: " . mysqli_error($conn);
        return 0; // Return 0 in case of an error
    }

    // Loop through each cart item
    while($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        
        // Corrected SQL query
        $select_products = "SELECT product_price FROM `products` WHERE product_id='$product_id'";
        $result_products = mysqli_query($conn, $select_products);

        if(!$result_products){
            echo "Error: " . mysqli_error($conn);
            return 0; // Return 0 in case of an error
        }

        // Fetch the product price
        while($row_product_price = mysqli_fetch_array($result_products)){
            $product_price = $row_product_price['product_price'];
            $total += $product_price;
        }
    }

    return $total;
}

// Call the function and echo the result
$total = total_cart_price();
echo $total;


    // get user order details
    function get_user_order_details(){
        if (isset($_SESSION['username'])) {
            global $conn; // Ensure the global variable is used correctly
            $username = $_SESSION['username'];
        
            // Correct SQL query to get user details
            $get_details = "SELECT * FROM `user_table` WHERE username='$username'";
            $result_query = mysqli_query($conn, $get_details);
        
            while ($row_query = mysqli_fetch_array($result_query)) {
                $user_id = $row_query['user_id'];
        
                // Check if none of the specified GET parameters are set
                if (!isset($_GET['edit_account']) && !isset($_GET['my_orders']) && !isset($_GET['delete_account'])) {
                    // Correct SQL query to get pending orders
                    $get_orders = "SELECT * FROM `user_orders` WHERE user_id='$user_id' AND order_status='pending'";
                    $result_order_query = mysqli_query($conn, $get_orders);
                    $row_count = mysqli_num_rows($result_order_query);
        
                    if ($row_count > 0) {
                        echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-danger'>$row_count</span> pending orders</h3>";
                        echo "<p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Order Details</a></p>";
                    } else {
                        echo "<h3 class='text-center text-success mt-5 mb-2'>You have zero pending orders</h3>";
                        echo "<p class='text-center'><a href='../index.php' class='text-dark'>Explore more products</a></p>";
                    }
                }
            }
        }
}
?>
