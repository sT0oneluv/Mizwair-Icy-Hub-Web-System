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
    <title>Mizwair Ais Krim | How To Order</title>
</head>

<body>
    <!-- Header section -->
    <?php
    include 'menu.php';
    ?>
    <!-- End Header section -->

    <div class="container-h2order">
        <div class="content-section">
            <h1>How To Order</h1>
            <p>First time with Mizwair Ice Cream? Don't worry, we're here to help!</p>
            <div class="section">
                <h3> Watch demo below. It only takes minutes!</h3>
                <video id="video" controls>
                    <source src="video/mizwair_demo.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
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