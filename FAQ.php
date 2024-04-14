<?php
	include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- FontAwsome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
	<!-- Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Stylesheet -->
	<link rel="stylesheet" href="style.css">

	<!-- Page title -->
    <title>Mizwair Ais Krim | FAQ</title>
</head>
<body>
    <!-- Header section -->  
	<?php 
		include 'menu.php';
	?>
    <!-- End Header section -->
    
    <section class="faq-section">
        <div class="container">        
            <!-- Title -->
            <h2 class="title">Frequently Asked Question</h2>

            <!-- Question -->
            <div class="category">
                <i class="fa-regular fa-credit-card"></i><h2>Order</h2>            
            </div>
            <div class="faq">            
                <div class="question">
                    <h3>What is the maximum amount of ice cream in one order?</h3>
                    <svg width="15" height="10" viewBox="0 0 42 25">
                        <path d="M3 3L21 21L39 3" 
                        stroke="white" 
                        stroke-width="7" 
                        stroke-linecap="round"/>
                   </svg>
                </div>  

                <!-- Answer -->
                <div class="answer">
                    <p>
                        Any amount that you want. For booking, we usually will make a new batch for our beloved customer
                        so they will get to feel the unique taste of our ice cream Malaysia
                    </p>
                </div>   
            </div>

            <div class="faq">
                <div class="question">
                    <h3>How do I make an order?</h3>
                    <svg width="15" height="10" viewBox="0 0 42 25">
                        <path d="M3 3L21 21L39 3" 
                        stroke="white" 
                        stroke-width="7" 
                        stroke-linecap="round"/>
                    </svg>
                </div>         
                <div class="answer">
                    <p>
                        Follow the step bellow
                        <br>
                        <br>Step 1: Go to Shop page in the navigation
                        <br>Step 2: Select the product you like
                        <br>Step 3: Add to cart, and you need to add quantity if you want more
                        <br>Step 4: Proceed to checkout
                        <br>Step 5: Insert your details and shipping details; if you want to book please insert the date
                        <br>Step 6: Choose payment and submit your order<br>
                        <br>
                        You’ll receive a order chat from our staff to confirm your order.
                    </p>
                </div>   
            </div>       

            <br><br><br>
            <div class="category">
                <i class="fa-solid fa-wallet"></i><h2>Payment</h2>            
            </div>
            <div class="faq">
                <div class="question">
                    <h3>What payment methods do you accept?</h3>
                    <svg width="15" height="10" viewBox="0 0 42 25">
                        <path d="M3 3L21 21L39 3" 
                        stroke="white" 
                        stroke-width="7" 
                        stroke-linecap="round"/>
                    </svg>
                </div>         
                <div class="answer">
                    <p>
                        Cash On Delivery (COD) and QR Pay. You need to select one option during checkout.
                        <br><br>If payment via QR Pay please insert your receipt/payment prove.
                    </p>
              </div>   
            </div>

            <br><br><br>
            <div class="category">
                <i class="fa-solid fa-wallet"></i><h2>Delivery</h2>            
            </div>
            <div class="faq">
                <div class="question">
                    <h3>Where do you deliver?</h3>
                    <svg width="15" height="10" viewBox="0 0 42 25">
                        <path d="M3 3L21 21L39 3" 
                        stroke="white" 
                        stroke-width="7" 
                        stroke-linecap="round"/>
                    </svg>
                </div>         
                <div class="answer">
                    <p>
                        We provide FREE delivery to Pokok Tampang(Tasek Gelugor). For certain far-off locations, there is an additional surcharge based on your delivery area.
                    </p>
                </div>   
            </div>
            <div class="faq">
                <div class="question">
                    <h3>Can I choose a specific delivery time?</h3>
                    <svg width="15" height="10" viewBox="0 0 42 25">
                        <path d="M3 3L21 21L39 3" 
                        stroke="white" 
                        stroke-width="7" 
                        stroke-linecap="round"/>
                    </svg>
                </div>         
                <div class="answer">
                    <p>
                        We provide three delivery slots:
                        <br>
                        1: Morning (9 AM - 2 PM) 
                        <br>
                        2: Standard (9 AM - 6 PM)
                        <br>
                        3: Evening (4 PM - 8 PM)
                        <br>
                        We don’t do midnight deliveries past 9 PM :) Don't worry usually we will delivered one day before the event date
                    </p>
                </div>   
            </div>
        </div>
    </section>   

    <!-- Footer section -->
	<?php 
		include 'Footer.php';
	?>
	<!-- End Footer section -->

    <!-- Javascript file -->
    <script src="./JavaScript/script.js"></script>
    
</body>
</html>