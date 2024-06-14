<?php
include('../includes/connect.php');
include('../functions/common.fuction.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialize variables
$invoice_number = '';
$amount_due = '';

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    
    // Fetch order details from the database
    $select_data = "SELECT * FROM user_orders WHERE order_id = $order_id";
    $result = mysqli_query($conn, $select_data);

    if ($result && mysqli_num_rows($result) > 0) {
        $row_fetch = mysqli_fetch_assoc($result);
        $invoice_number = $row_fetch['invoice_number'];
        $amount_due = $row_fetch['amount_due'];
    } else {
        echo "Error fetching order data: " . mysqli_error($conn);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm_payment"])) {
    $invoice_number = $_POST["invoice_number"];
    $amount = $_POST["amount"];
    $payment_mode = $_POST["payment_mode"];

    $insert_query = "INSERT INTO user_payments (order_id, invoice_number, amount, payment_mode)
                     VALUES ('$order_id', '$invoice_number', '$amount', '$payment_mode')";
    $result = mysqli_query($conn, $insert_query);

    if ($result) {
        echo "<h3 class='text-center text-light'>Successfully completed the payment</h3>";
        echo "<script>window.open('profile.php?myorders','_self');</script>";

        $update_orders = "UPDATE user_orders SET order_status = 'complete' WHERE order_id = $order_id";
        $result_orders = mysqli_query($conn, $update_orders);
    } else {
        echo "Error inserting payment data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            background-color: #6c757d; /* bg-secondary */
        }
        .text-light {
            color: #f8f9fa !important;
        }
    </style>
</head>
<body class="bg-secondary">
<div class="container my-5">
    <h1 class="text-center text-light">Confirm Payment</h1>
    <form action="" method="post">
        <!-- Invoice Number Field -->
        <div class="form-outline my-4 text-center w-50 m-auto">
            <label for="invoice_number" class="text-light">Invoice Number</label>
            <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo htmlspecialchars($invoice_number); ?>" readonly>
        </div>
        
        <!-- Amount Field -->
        <div class="form-outline my-4 text-center w-50 m-auto">
            <label for="amount" class="text-light">Amount</label>
            <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo htmlspecialchars($amount_due); ?>" readonly>
        </div>
        
        <!-- Payment Mode Field -->
        <div class="form-outline my-4 text-center w-50 m-auto">
            <label for="payment_mode" class="text-light">Payment Mode</label>
            <select name="payment_mode" class="form-select w-50 m-auto">
                <option value="">Select Payment Mode</option>
                <option value="upi">UPI</option>
                <option value="netbanking">Netbanking</option>
                <option value="paypal">Paypal</option>
                <option value="cod">Cash on Delivery</option>
                <option value="offline">Pay Offline</option>
            </select>
        </div>
        
        <!-- Submit Button -->
        <div class="form-outline my-4 text-center w-50 m-auto">
            <input type="submit" class="bg-info py-2 px-3 border-0" value="Confirm" name="confirm_payment">
        </div>
    </form>
</div>
</body>
</html>
