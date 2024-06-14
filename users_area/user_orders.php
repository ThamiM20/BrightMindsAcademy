<?php


include('../includes/connect.php');

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $get_user = "SELECT * FROM `user_table` WHERE username='$username'";
    $result = mysqli_query($conn, $get_user);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row_fetch = mysqli_fetch_assoc($result);
        $user_id = $row_fetch['user_id'];
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>User Orders</title>
            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                .bg-secondary {
                    background-color: #6c757d !important;
                }
                .bg-info {
                    background-color: #17a2b8 !important;
                }
                .text-light {
                    color: #f8f9fa !important;
                }
                .text-success {
                    color: #28a745 !important;
                }
            </style>
        </head>
        <body>
        <div class="container mt-5">
            <h3 class="text-success">All my Orders</h3>
            <table class="table table-bordered mt-3">
                <thead class="bg-info">
                    <tr>
                        <th>S.No</th>
                        <th>Amount Due</th>
                        <th>Total Products</th>
                        <th>Invoice Number</th>
                        <th>Date</th>
                        <th>Complete/Incomplete</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="bg-secondary text-light">
                <?php
                $get_order_details = "SELECT * FROM `user_orders` WHERE user_id=$user_id";
                $result_orders = mysqli_query($conn, $get_order_details);
                $number = 1;

                while ($row_orders = mysqli_fetch_assoc($result_orders)) {
                    $order_id = $row_orders['order_id'];
                    $amount_due = $row_orders['amount_due'];
                    $total_products = $row_orders['total_products'];
                    $invoice_number = $row_orders['invoice_number'];
                    $order_date = $row_orders['order_date'];
                    $order_status = $row_orders['order_status'] == 'pending' ? 'Incomplete' : 'Complete';
                    
                    echo "<tr>
                            <td>$number</td>
                            <td>$amount_due</td>
                            <td>$total_products</td>
                            <td>$invoice_number</td>
                            <td>$order_date</td>
                            <td>$order_status</td>";
                    
                    if ($order_status == 'Complete') {
                        echo "<td>Paid</td>";
                    } else {
                        echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-light'>Confirm</a></td>";
                    }

                    echo "</tr>";
                    $number++;
                }
                ?>
                </tbody>
            </table>
        </div>
        </body>
        </html>

        <?php
    } else {
        echo "User not found.";
    }
} else {
    echo "Please log in to view your orders.";
}
?>
