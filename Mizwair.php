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
	<title>Mizwair Ais Krim | Home</title>
</head>

<body>
	<!-- Header section -->
	<?php
	include 'menu.php';
	?>
	<!-- End Header section -->


	<!-- First Section -->
	<section class="homepage-section">
		<div class="container">
			<img src="image/aiskrim-poster.png" alt="">
		</div>
	</section>

	<!-- Second Section -->
	<section class="homepage-section">
		<div class="container2">
			<div class="container2-first">
				<!-- Header text -->
				<h1 align="center"><br><br><br>SHOP OUR PRODUCT<br><br><br></h1>
				<!-- Image -->
				<img src="image/homeImage.png" alt="">
				<div class="middle-left">
					<h2><br><br><br><br>SWEETS FOR EVERY OCCASION</h2><br>
					<p>Mizwair Ice Cream, provide you the most<br>unique taste of sweetness that will bring a<br>smile to someone's face. That's why we offer<br>a wide variety of flavours<br>for every occasion.</p><br>
					<button class="button" onclick="window.location.href='productPage.php'">Get Your Ice Cream</button>
				</div>
			</div>
		</div>
	</section>

	<!-- About store section -->
	<section class="homepage-section">
		<div class="container3">
			<!-- photo gallery -->
			<div class="image-content-decoration">
				<div class="right">
					<img src="image/img2.jpg" alt="career.jpg">
					<div class="overlay-right">
						<div class="right-caption">
							Get your desire flavour
							<p><br>There is variety of<br>flavour that you can select here</p>
						</div>
					</div>
				</div>

				<div class="bottom">
					<img src="image/img1.jpg" alt="career.jpg">
					<div class="overlay-bottom">
						<div class="bottom-caption">
							Enjoy with everyone
							<p><br>Create a special memory with your belove one with our ice cream Malaysia</p>
						</div>
					</div>
				</div>
				<div class="left">
					<img src="image/event/b2.jpg" alt="career.jpg">
					<div class="overlay-left">
						<div class="left-caption">
							Book for any<br>celebration
							<p><br>We provide a booking<br>service for any occasions</p>
						</div>
					</div>
				</div>
			</div>
			<button style="margin-top: 7%; font-size:larger;" class="button" onclick="window.location.href='About.php'">Learn More</button><br><br>
		</div>
	</section>

	<!-- Footer section -->
	<?php
	include 'Footer.php';
	?>
	<!-- End Footer section -->

	<!-- include the Javascript file -->
	<script src="JavaScript/script.js"></script>

</body>

</html>