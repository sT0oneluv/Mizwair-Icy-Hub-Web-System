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
    <title>Mizwair | Gallery</title>

<body>
    <!-- Header section -->
    <?php
    include 'menu.php';
    ?>
    <!-- End Header section -->

    <!-- Event gallery section -->
    <section class="gallery" id="products">
        <div class="header">
            <h1 style="text-transform: uppercase;font-style: italic;"> Take a look at some of our customer experience </h1>
        </div>
        <h1> Corporate Event </h1>
        <p>Make your corporate events unforgettable with our premium ice cream selections! <br>Can be enjoy anytime, everywhere!</p>
        <div class="box-container">
            <div class="image">
                <img src="image/event/c1.jpg" alt="">
            </div>
            <div class="image">
                <img src="image/event/c2.jpg" alt="">
            </div>
            <div class="image">
                <img src="image/event/c3.jpg" alt="">
            </div>
        </div>
        <h1> Wedding Celebration </h1>
        <p>Elevate your wedding festivities with our exquisite selection of artisanal ice cream creations!
            <br>Add a touch of sweetness to your special day. 🍨💍
        </p>
        <div class="box-container">
            <div class="image">
                <img src="image/event/w1.jpg" alt="">
            </div>
            <div class="image">
                <img src="image/event/w2.jpg" alt="">
            </div>
            <div class="image">
                <img src="image/event/w3.jpg" alt="">
            </div>
        </div>
        <h1> Birthday Event </h1>
        <p>Indulge in delightful celebrations with our handcrafted, delectable, and one-of-a-kind ice cream treats!
            <br>Our ice cream collection is tailored to elevate every birthday occasion. 🎉🍦
        </p>
        <div class="box-container">
            <div class="image">
                <img src="image/event/b1.jpg" alt="">
            </div>
            <div class="image">
                <img src="image/event/b4.jpg" alt="">
            </div>
            <div class="image">
                <img src="image/event/b3.jpg" alt="">
            </div>
        </div>

        <button class="button" onclick="window.location.href='productPage.php'">Don't wait any longer and order now</button>
        <br>
        <div class="text">
            <a>If there any inquiries </a><a href="http://wasap.my/601137120484/SayaNakOrderAisKrimMizwair">click here</a><a> to chat live</a>
        </div>
    </section>

    <!-- Footer section -->
    <?php
    include 'Footer.php';
    ?>
    <!-- End Footer section -->

</body>

</html>