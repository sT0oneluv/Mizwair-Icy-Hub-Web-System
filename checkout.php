<?php
@include 'config.php';

session_start();

// Check if the user is logged in
if (isset($_SESSION['user_email'])) {
   // User is logged in, fetch user details from session
   $user_email = $_SESSION['user_email'];

   // Query the database to fetch user details
   $user_query = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$user_email'");

   // Check if user details are found
   if (mysqli_num_rows($user_query) > 0) {
      $user_details = mysqli_fetch_assoc($user_query);

      // Assign user details to variables
      $name = $user_details['name'];
      $email = $user_details['email'];
      $phone = $user_details['phone'];
      $flat = $user_details['flat'];
      $street = $user_details['street'];
      $city = $user_details['city'];
      $state = $user_details['state'];
      $country = $user_details['country'];
      $pin_code = $user_details['pin_code'];
   } else {
      // User details not found, handle accordingly
      // For example, redirect the user to the login page
      header('location: login_form.php');
      exit;
   }
} else {
   // User is not logged in, initialize variables
   $name = '';
   $email = '';
   $phone = '';
   $flat = '';
   $street = '';
   $city = '';
   $state = '';
   $country = '';
   $pin_code = '';
}

// Action for the order button
if (isset($_POST['order_btn'])) {
   // Variables from the order form
   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];
   $booking_option = $_POST['booking_option'];
   $event_type = ($booking_option == 'yes') ? $_POST['event_type'] : null; // Set event_type to null if booking_option is 'no'
   $event_date = ($booking_option == 'yes') ? $_POST['event_date'] : null; // Set event_date to null if booking_option is 'no'

   // Handling QR image upload
   $qr_image_path = '';
   if ($method == 'QR Pay' && isset($_FILES['qr_image']) && $_FILES['qr_image']['error'] === UPLOAD_ERR_OK) {
      $image = $_FILES['qr_image']['name'];
      $qr_image_tmp_name = $_FILES['qr_image']['tmp_name'];
      $target_dir = 'uploads/' . $image; // Directory where uploaded QR images will be saved

      // Move the uploaded file to the target directory
      if (move_uploaded_file($qr_image_tmp_name, $target_dir)) {
         $qr_image_path = $image; // Assigning just the file name to $qr_image_path
      } else {
         echo "Sorry, there was an error uploading your file.";
      }
   }

   // Calculate the total
   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if (mysqli_num_rows($cart_query) > 0) {
      while ($product_item = mysqli_fetch_assoc($cart_query)) {
         // Calculate product * quantity
         $product_name[] = $product_item['name'] . ' (' . $product_item['quantity'] . ') ';
         $product_price = number_format($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
      };
   }

   $total_product = implode(', ', $product_name);
   // Insert into the ORDER database
   $detail_query = mysqli_query($conn, "INSERT INTO `order` (name, number, email, method, 
                  flat, street, city, state, country, pin_code, total_products, total_price, 
                  booking_option, event_type, event_date, qr_image) 
                  VALUES ('$name','$number','$email','$method','$flat','$street','$city','$state',
                  '$country','$pin_code','$total_product','$price_total', '$booking_option','$event_type','$event_date','$qr_image_path')") or die('query failed');

   if ($detail_query) {

      $order_id = mysqli_insert_id($conn);
      $price_tot = number_format($price_total,2);
      
      // Output HTML for the order confirmation message
      echo <<<HTML
<div class='order-message-container'>
   <div class='message-container'>
      <h3>Thank you for shopping!</h3>
      <div class='order-detail'>
         <span>{$total_product}</span>
         <br><span class='total'> Total: RM{$price_tot}  </span>
      </div>
      <div class='customer-details'>
         <p> Your name: <span>{$name}</span> </p>
         <p> Your number: <span>{$number}</span> </p>
         <p> Your email: <span>{$email}</span> </p>
         <p> Your address: <span>{$flat}, {$street}, {$city}, {$state}, {$country} - {$pin_code}</span> </p>
         <p> Your payment mode: <span>{$method}</span> </p>
HTML;

      if ($booking_option == 'yes') {
         echo "<p> Booking for event: <span>{$booking_option}</span> </p>";
         echo "<p> Event Type: <span>{$event_type}</span> </p>";
         echo "<p> Event Date: <span>{$event_date}</span> </p>";
      } else {
         echo "<p> Booking for event: <span>No</span> </p>";
      }

      echo <<<HTML
      <form action="download_receipt.php" method="get">
         <input type="hidden" name="id" value="{$order_id}">
         <p><button type="submit" class="btn">Download Receipt</button></p>
      </form>
   </div>
   <a href='productPage.php?orderSuccess=1' class='btn'>Continue Shopping</a>
   </div>
</div>
HTML;
   } else {
      echo "Failed to process the order.";
   }
}
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
   <link rel="stylesheet" href="style.css">

   <!-- Page title -->
   <title>Mizwair Ais Krim | Checkout</title>
</head>

<body>

   <!-- Header section -->
   <?php include 'menu.php'; ?>
   <!-- End Header section -->

   <div class="container-checkout">
      <section class="checkout-form">
         <h1 class="heading">Complete Your Order</h1>

         <form action="" method="post" enctype="multipart/form-data">
            <div class="display-order">
               <?php
               $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
               $total = 0;
               $grand_total = 0;
               if (mysqli_num_rows($select_cart) > 0) {
                  while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                     // Calculate the total price for each order
                     $total_price = number_format(($fetch_cart['price'] * $fetch_cart['quantity']),2);
                     // Calculate the total overall order
                     $grand_total = $total += $total_price;
               ?>
                     <span><?= $fetch_cart['name']; ?> x <?= $fetch_cart['quantity']; ?></span>
               <?php
                  }
               } else {
                  echo "<div class='display-order'><span>Your cart is empty!</span></div>";
               }
               ?>

               <!-- Order Price Output -->
               <span class="grand-total">Total: RM<?= number_format($grand_total, 2); ?></span>
            </div>

            <!-- Form for checkout -->
            <div class="flex">

               <!-- Add booking option -->
               <div class="inputBox">
                  <span>Book for an event?</span>
                  <select name="booking_option" id="bookingOption" onchange="toggleEventTypeContainer()">
                     <option value="no">No</option>
                     <option value="yes">Yes</option>
                  </select>
               </div>

               <!-- Add event type container -->
               <div id="eventTypeContainer" style="display: none;">
                  <div class="inputBox">
                     <span>Event Type</span>
                     <select name="event_type">
                        <option value="wedding">Wedding</option>
                        <option value="birthday">Birthday</option>
                        <option value="corporate">Corporate</option>
                        <option value="other">Other</option>
                     </select>
                  </div>
                  <div class="inputBox">
                     <span>Event Date</span>
                     <input type="date" name="event_date">
                  </div>
               </div>

               <div class="inputBox">
                  <span>your name</span>
                  <input type="text" placeholder="enter your name" name="name" value="<?php echo $name; ?>" required>
               </div>
               <div class="inputBox">
                  <span>your number</span>
                  <input type="tel" placeholder="enter your number" name="number" value="<?php echo $phone; ?>" required>
               </div>
               <div class="inputBox">
                  <span>your email</span>
                  <input type="email" placeholder="enter your email" name="email" value="<?php echo $email; ?>" required>
               </div>

               <!-- Payment method selection -->
               <div class="inputBox">
                  <span>Payment Method</span>
                  <select name="method" onchange="toggleQRPaymentContainer()">
                     <option value="cash on delivery" selected>Cash on Delivery</option>
                     <option value="QR Pay">QR Pay</option>
                  </select>
               </div>

               <!-- Add QR payment container -->
               <div id="qrPaymentContainer" style="display: none;">
                  <div class="inputBox">
                     <span>QR Image</span>
                     <!-- Input field for displaying the QR image -->
                     <img src="./image/qr_image.jpg" alt="qr_image.jpg">
                     <br><input type="file" name="qr_image" accept="image/png, image/jpg, image/jpeg">
                  </div>
               </div>

               <!-- Address section -->
               <div class="inputBox">
                  <span>address line 1</span>
                  <input type="text" placeholder="e.g. flat no." name="flat" value="<?php echo $flat; ?>" required>
               </div>
               <div class="inputBox">
                  <span>address line 2</span>
                  <input type="text" placeholder="e.g. street name" name="street" value="<?php echo $street; ?>" required>
               </div>
               <div class="inputBox">
                  <span>city</span>
                  <input type="text" placeholder="e.g. Ipoh" name="city" value="<?php echo $city; ?>" required>
               </div>
               <div class="inputBox">
                  <span>state</span>
                  <input type="text" placeholder="e.g. Perak" name="state" value="<?php echo $state; ?>" required>
               </div>
               <div class="inputBox">
                  <span>country</span>
                  <input type="text" placeholder="e.g. Malaysia" name="country" value="<?php echo $country; ?>" required>
               </div>
               <div class="inputBox">
                  <span>pin code</span>
                  <input type="text" placeholder="e.g. 34100" name="pin_code" value="<?php echo $pin_code; ?>" required>
               </div>
            </div>
            <input type="submit" value="Order Now" name="order_btn" class="btn">
         </form>

      </section>

   </div>

   <!-- Footer section -->
   <?php include 'Footer.php'; ?>
   <!-- End Footer section -->

   <script>
      function toggleEventTypeContainer() {
         var bookingOption = document.getElementById('bookingOption');
         var eventTypeContainer = document.getElementById('eventTypeContainer');
         eventTypeContainer.style.display = bookingOption.value === 'yes' ? 'block' : 'none';
      }

      function toggleQRPaymentContainer() {
         var paymentMethod = document.getElementsByName('method')[0];
         var qrPaymentContainer = document.getElementById('qrPaymentContainer');
         qrPaymentContainer.style.display = paymentMethod.value === 'QR Pay' ? 'block' : 'none';
      }
   </script>

</body>

</html>