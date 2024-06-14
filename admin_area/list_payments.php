<h3 class="text-center text-success">All Payments</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr class="text-center">
            <th>Sr. No</th> 
            <th>Invoice number</th>
            <th>Amount</th>
            <th>Payment Order</th>
            <th>Orderdate</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class='bg-secondary text-light'>
        <?php
        $get_payments = 'SELECT * FROM `user_payments`';
        $result = mysqli_query($conn, $get_payments);
        $row_count = mysqli_num_rows($result);

        if ($row_count == 0) {
            echo "<tr><td colspan='7' class='text-center text-danger'>No payments yet</td></tr>";
        } else {
            $number = 0;
            while ($row_data = mysqli_fetch_assoc($result)) {
                $order_id = $row_data['order_id'];
                $payment_id = $row_data['payment_id'];
                $amount = $row_data['amount'];
                $invoice_number = $row_data['invoice_number'];
                $payment_mode = $row_data['payment_mode'];
                $date = $row_data['date'];
                $number++;
                echo "
                <tr class='text-center'>
                    <td>$number</td>
                    <td>$invoice_number</td>
                    <td>$amount</td>
                    <td>$payment_mode</td>
                    <td>$date</td>
                    <td><a href='?delete_payment=$payment_id' class='text-light'><i class='fas fa-trash'></i></a></td>
                </tr>";
            }
        }
        ?>
    </tbody>
</table>
