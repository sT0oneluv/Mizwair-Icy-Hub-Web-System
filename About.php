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

    <!-- Page Tittle -->
    <title>Mizwair Ais Krim | About Us</title>
</head>

<body>
    <!-- Header section -->
    <?php
    include 'menu.php';
    ?>
    <!-- End Header section -->

    <!-- Body Content -->
    <div class="about-us">
        <div class="section">
            <div class="container">
                <div class="content-section">
                    <div class="title">
                        <h1>Story Of Mizwair Ice Cream</h1>
                    </div>
                    <div class="content">
                        <h3>Our Own Family Business</h3>
                        <p>We are delighted to share the joy
                            <br>with everyone.
                            <br><br>Despite many challenges, we still strive to
                            <br>provide the best ice cream for our customers.
                            <br>We offer a variety of interesting flavors and unique tastes.                            
                        </p><p style="font-style:italic;">(Owner Of Mizwair Ice Cream)</p>
                    </div>
                    <div class="social">
                        <a href="https://www.facebook.com/profile.php?id=100063697684270&mibextid=LQQJ4d"><i class="fa-brands fa-facebook"></i></a>
                        <a href="http://wasap.my/601137120484/SayaNakOrderAisKrimMizwair"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="image-section">
                    <img src="image/Screenshot 2024-03-10 133320.png" alt="">
                </div>
            </div>
        </div>
        <div class="second-section">
            <div class="content-2">
                <h1>Discover Our Unique Creations</h1>
                <p>Our flavors are crafted with care, ensuring each one is a unique experience.
                    <br>Chocolate, the king of indulgence, reigns as the all-time favorite flavor.
                    <br>Chocolate, the king of indulgence, reigns as the all-time favorite flavor.
                    <br>Indulge in our velvety creations, made to delight every palate!
                </p>
                <button class="button" onclick="window.location.href='productPage.php'">Grab Yours Now</button><br><br>
            </div>
        </div>
    </div>


    <!-- Footer section -->
    <?php
    include 'Footer.php';
    ?>
    <!-- End Footer section -->

    <!-- include the Javascript file -->
    <script src="JavaScript/script.js"></script>
</body>

</html>