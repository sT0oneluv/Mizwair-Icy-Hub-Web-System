<?php
include 'config.php';

// Check if the user is logged in
session_start();

if (isset($_SESSION['user_name']) && isset($_SESSION['user_email']) && isset($_SESSION['user_phone'])) {
    $name = $_SESSION['user_name'];
    $email = $_SESSION['user_email'];
    $phone = $_SESSION['user_phone'];
} else {
    // If the user is not logged in, initialize variables to empty strings
    $name = '';
    $email = '';
    $phone = '';
}

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];

	$insert_query = "INSERT INTO contact_us (name, email, phone, subject, message) VALUES ('$name', '$email', '$phone', '$subject', '$message')";
	$result = mysqli_query($conn, $insert_query);

	if ($result) {
		echo '<script>alert("Message sent successfully!");</script>';
	} else {
		echo '<script>alert("Error sending message. Please try again.");</script>';
	}
}
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
	<title>Mizwair Ais Krim | Contact Us</title>
</head>

<body>
	<!-- Header section -->
	<?php
	include 'menu.php';
	?>
	<!-- End Header section -->

	<div class="container-contact">
		<h1 align="center">Contact Us</h1>
		<div class="contact-box">
			<div class="contact-left">
				<h3>Get in Touch</h3>
				<form action="" method="post">
					<div class="input-row">
						<div class="input-group">
							<label>Name</label>
							<input type="text" name="name" placeholder="John Amendo" id="contact-name" value="<?php echo $name;?>" onkeyup="validateName()">
							<span id="name-error"></span>
						</div>
						<div class="input-group">
							<label>Phone</label>
							<input type="text" name="phone" placeholder="014 1220 331" id="contact-phone" value="<?php echo $phone;?>" onkeyup="validatePhone()">
							<span id="phone-error"></span>
						</div>
					</div>
					<div class="input-row">
						<div class="input-group">
							<label>Email</label>
							<input type="text" name="email" placeholder="JohnAmendo@gmail.com" id="contact-email" value="<?php echo $email;?>" onkeyup="validateEmail()">
							<span id="email-error"></span>
						</div>
						<div class="input-group">
							<label>Subject</label>
							<input type="text" name="subject" placeholder="Undelivery Product" id="contact-subject" onkeyup="validateSubject()">
							<span id="subjectError"></span>
						</div>
					</div>

					<!-- Send Message Button -->
					<label>Message</label>
					<span id="message-error"></span>
					<textarea rows="5" name="message" placeholder="Your Message" id="contact-message" onkeyup="validateMessage()"></textarea>

					<input class="button" type="submit" name="submit" value="Send Message" onclick="return validateForm()">
					<span id="submit-error"></span>
				</form>
			</div>
			<div class="contact-right">
				<h3><br>Reach Us</h3>

				<table>
					<tr>
						<td><i class="fa-brands fa-whatsapp"></i></td>
						<td><a href="http://wasap.my/601137120484/SayaNakOrderAisKrimMizwair">Chat With Us</a></td>
					</tr>
					<tr>
						<td>Address</td>
						<td>MiZWair Ais Krim Malaysia <br> Pokok Tampang 13300 Tasek Gelugor
							51a</td>
					</tr>
					<tr>
					<td></td>	
					<td><iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d127092.75494036682!2d100.39502294597!3d5.4701626771292124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x304ad10f41ec2337%3A0xca1e8490d788a276!2sS%2Fb%2C%201175%2C%20lorong%205%2C%20Kampung%20Pokok%20Tampang%2C%2013300%20Tasek%20Gelugor%2C%20Penang!3m2!1d5.4701683!2d100.47742489999999!5e0!3m2!1sen!2smy!4v1710390598640!5m2!1sen!2smy" width="450" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></td>
					</tr>
				</table>


			</div>
		</div>
	</div>

	<!-- Footer section -->
	<?php
	include 'Footer.php';
	?>
	<!-- End Footer section -->

	<!-- include the Javascript file -->
	<script src="./JavaScript/script.js"></script>
</body>

</html>