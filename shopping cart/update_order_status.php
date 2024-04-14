<?php
// Include the database configuration file
include 'config.php';

    // Get the order ID and new status from the POST data
    $orderId = $_POST['record'];

    // Fetch the current status of the order
    $status_query = mysqli_query($conn, "SELECT order_status FROM `order` WHERE id='$orderId'");
    $row = mysqli_fetch_assoc($status_query);

    // Update the order status in the database
    if ($row["order_status"] == 0) {
        $update = mysqli_query($conn, "UPDATE `order` SET order_status = 1 where id='$orderId'");
    } else if ($row["order_status"] == 1) {
        $update = mysqli_query($conn, "UPDATE `order` SET order_status = 0 where id='$orderId'");
    }

?>
