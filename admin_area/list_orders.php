<h3 class="text-center text-success">All orders</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr class="text-center">
            <th>Sr. No</th> 
            <th>Due Amount</th>
            <th>Invoice number</th>
            <th>Total products</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class='bg-secondary text-light'>
        <?php
        $get_orders = 'SELECT * FROM `user_orders`';
        $result = mysqli_query($conn, $get_orders);
        $row_count = mysqli_num_rows($result);

        if ($row_count == 0) {
            echo "<tr><td colspan='7' class='text-center text-danger'>No orders yet</td></tr>";
        } else {
            $number = 0;
            while ($row_data = mysqli_fetch_assoc($result)) {
                $order_id = $row_data['order_id'];
                $user_id = $row_data['user_id'];
                $amount_due = $row_data['amount_due'];
                $invoice_number = $row_data['invoice_number'];
                $total_products = $row_data['total_products'];
                $order_date = $row_data['order_date'];
                $order_status = $row_data['order_status'];
                $number++;
                echo "
                <tr class='text-center'>
                    <td>$number</td>
                    <td>$amount_due</td>
                    <td>$invoice_number</td>
                    <td>$total_products</td>
                    <td>$order_date</td>
                    <td>$order_status</td>
                    <td><a href='?delete_order=$order_id' class='text-light'><i class='fas fa-trash'></i></a></td>
                </tr>";
            }
        }
        ?>
    </tbody>
</table>
