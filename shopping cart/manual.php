<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- FontAwsome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Javascript -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

   <!-- Stylesheet -->
   <link rel="stylesheet" href="css/style.css">

   <!-- Page title -->
   <title>Admin Page | Manual</title>

</head>

<body>
    <!-- Header section -->
    <?php
    include 'header.php';
    ?>
    <!-- End Header section -->

    <div class="container-manual">
        <div class="content-section">
            <h1>Admin Manual</h1>
            <p>Check Out this manual to help you manage the system</p>
            <div class="section">
                <video id="video" controls>
                    <source src="../video/admin_demo.mp4" type="video/mp4">
                </video>
            </div>
        </div>
    </div>

    <!-- Footer section 
    <?php
    include 'Footer.php';
    ?>-->
    <!-- End Footer section -->

    <!-- include the Javascript file -->
    <script src="./js/script.js"></script>
</body>

</html>