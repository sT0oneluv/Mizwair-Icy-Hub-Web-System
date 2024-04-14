<?php
// Include the database configuration file
include 'config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FontAwsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Javascript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/style.css">

    <!-- Page title -->
    <title>Admin Page | Order</title>
    
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container">
        <section class="order-details">
            <!-- Add header content here -->
            <h1 class="heading">Order Details</h1>

            <table>
                <thead>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Order Placed</th>
                    <th>Payment Method</th>
                    <th>Action</th>
                </thead>

                <tbody>

                    <?php
                    // Fetch orders from the database
                    $select_orders = mysqli_query($conn, "SELECT * FROM `order`");
                    
                    if (mysqli_num_rows($select_orders) > 0) {
                        while ($order = mysqli_fetch_assoc($select_orders)) {
                            // Define status text based on order status
                    ?>

                            <tr>
                                <td>ID-<?php echo $order['id']; ?></td>
                                <td><?php echo $order['name']; ?></td>
                                <td><?php echo $order['number']; ?></td>
                                <td><?php echo $order['email']; ?></td>
                                <td><?php echo $order['flat'] . ', ' . $order['street'] . ', ' . $order['city'] . ', ' . $order['state'] . ', ' . $order['country'] . ' - ' . $order['pin_code']; ?></td>
                                <td><?php echo $order['created_at']; ?></td>
                                <td><?php echo $order['method']; ?></td>
                                <td>
                                    <!-- Action buttons -->
                                    <?php
                                    if ($order["order_status"] == 0) {
                                    ?>
                                        <button id="orderStatusButton_<?php echo $order['id']; ?>" class="btn" onclick="ChangeOrderStatus('<?php echo $order['id']; ?>')">Pending</button>
                                    <?php
                                    } else {
                                    ?>
                                        <button id="orderStatusButton_<?php echo $order['id']; ?>" class="btn" onclick="ChangeOrderStatus('<?php echo $order['id']; ?>')">Delivered</button>
                                    <?php
                                    }

                                    if ($order["pay_status"] == 0) {
                                    ?>
                                        <button id="paymentStatusButton_<?php echo $order['id']; ?>" class="btn" onclick="ChangePay('<?php echo $order['id']; ?>')">Unpaid</button>
                                    <?php
                                    } else if ($order["pay_status"] == 1) {
                                    ?>
                                        <button id="paymentStatusButton_<?php echo $order['id']; ?>" class="btn" onclick="ChangePay('<?php echo $order['id']; ?>')">Paid</button>
                                    <?php
                                    }
                                    ?>
                                    <button class="btn" onclick="showOrderDetails(<?php echo $order['id']; ?>)">More Details</button>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<p style='font-size: 2rem;'>No orders available</p>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <!-- Modal for displaying order details -->
    <div id="orderDetailsModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeOrderDetailsModal()">&times;</span>
            <div id="orderDetailsContent"></div>
        </div>
    </div>
    
    <script src="./js/script.js"></script>

</body>

</html>