<?php
// Include the database configuration file
include 'config.php';

// Check if the order ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $order_id = $_GET['id'];

    // Fetch additional details of the order from the database based on the order_id
    $order_query = mysqli_query($conn, "SELECT * FROM `order` WHERE id = '$order_id'");

    // Check if order details are found
    if (mysqli_num_rows($order_query) > 0) {
        while ($order_details = mysqli_fetch_assoc($order_query)) {
?>
            <div class="modal-heading">
                <h1>Order Details for Order ID: <?php echo $order_id ?></h1>
            </div>
            
            <div class='order-details-table'>
                <table class='order-details'>
                    <thead>
                        <tr>
                            <th>Details</th>
                            <th>Payment Prove</th>
                            <!--<th>Customer Name</th>
                            <th>Total Product</th>
                            <th>Total Price</th>
                            <th>Event</th>
                            <th>Event Date</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Customer Name: <?php echo $order_details['name']; ?>
                                <br><br>Product Details: <?php echo $order_details['total_products']; ?>
                                <br><br>Total Price: RM<?php echo $order_details['total_price']; ?>
                                <br><br>Event Type: <?php echo $order_details['event_type']; ?>
                                <br><br>Event Date: <?php echo $order_details['event_date']; ?>
                            </td>
                            <td><img src="../uploads/<?php echo $order_details['qr_image']; ?>" class="payment-proof"></td>
                            <!--<td><?php echo $order_details['name']; ?></td>
                            <td><?php echo $order_details['total_products']; ?></td>
                            <td>RM<?php echo $order_details['total_price']; ?></td>
                            <td><?php echo $order_details['event_type']; ?></td>
                            <td><?php echo $order_details['event_date']; ?></td>
                            -->
                        </tr>
                    </tbody>
                </table>
            </div>
<?php
        }
    } else {
        echo "Order details not found.";
    }
} else {
    echo "Order ID is missing.";
}
?>