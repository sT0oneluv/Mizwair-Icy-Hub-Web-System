<?php
// Include the database configuration file
include 'config.php';

    // Get the order ID from the POST data
    $orderId = $_POST['record'];

    // Fetch the current payment status of the order
    $status_query = mysqli_query($conn, "SELECT pay_status FROM `order` WHERE id='$orderId'");
    $row = mysqli_fetch_assoc($status_query);

    // Update the payment status in the database
    if ($row["pay_status"] == 0) {
        $update = mysqli_query($conn, "UPDATE `order` SET pay_status=1 where id='$orderId'");
    } else if ($row["pay_status"] == 1) {
        $update = mysqli_query($conn, "UPDATE `order` SET pay_status=0 where id='$orderId'");    }

?>
