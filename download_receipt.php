<?php
// Include database connection or configuration file
include 'config.php';

// Check if order ID is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $order_id = $_GET['id'];

    // Fetch order details from the database based on the order_id
    $order_query = mysqli_query($conn, "SELECT * FROM `order` WHERE id = '$order_id'");

    // Check if order details are found
    if(mysqli_num_rows($order_query) > 0) {
        $order_details = mysqli_fetch_assoc($order_query);

        // Extract order details
        $name = $order_details['name'];
        $email = $order_details['email'];
        $number = $order_details['number'];
        $method = $order_details['method'];
        $price_total = $order_details['total_price'];
        $flat = $order_details['flat'];
        $street = $order_details['street'];
        $city = $order_details['city'];
        $state = $order_details['state'];
        $country = $order_details['country'];
        $pin_code = $order_details['pin_code'];
        $booking_option = $order_details['booking_option'];
        $event_type = $order_details['event_type'];
        $event_date = $order_details['event_date'];
        $qr_image_path = $order_details['qr_image'];

        // Start PDF generation
        require_once 'tcpdf/tcpdf.php'; // Include TCPDF library

        // Create PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator('Your Company');
        $pdf->SetAuthor('Your Company');
        $pdf->SetTitle('Order Receipt');
        $pdf->SetSubject('Order Receipt');
        $pdf->SetKeywords('Order, Receipt');

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('dejavusans', '', 12);

        // Add content to the PDF
        $html = <<<EOF
        <h1>Order Receipt</h1>
        <p>Order ID: ID-{$order_id}</p>
        <p>Name: {$name}</p>
        <p>Email: {$email}</p>
        <p>Phone: {$number}</p>
        <p>Payment Method: {$method}</p>
        <p>Total Price: RM{$price_total}</p>
        <p>Address:</p>
        <p>{$flat}, {$street}, {$city}, {$state}, {$country} - {$pin_code}</p>
        <p>Booking Option: {$booking_option}</p>
EOF;
        if ($booking_option == 'yes') {
            $html .= "<p>Event Type: {$event_type}</p>";
            $html .= "<p>Event Date: {$event_date}</p>";
        }
        if ($method == 'QR Pay' && !empty($qr_image_path)) {
            $html .= "<p>Payment Proof:</p>";
            $html .= "<img src='{$qr_image_path}' alt='Payment Proof'>";
        }
        $html .= <<<EOF
        <!-- Add more order details here -->
EOF;

        $pdf->writeHTML($html, true, false, true, false, '');

        // Close and output PDF document
        $pdf->Output('order_receipt.pdf', 'D');
    } else {
        echo "Order not found.";
    }
} else {
    echo "Order ID is missing.";
}
?>
