<?php

@include 'config.php';

//Add to cart process
if (isset($_POST['add_to_cart'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    //insert products into CART table
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

    //message output
    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'product already added to cart';
    } else {
        $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) 
      VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
        $message[] = 'product added to cart succesfully';
    }
}

// Check if there's a parameter indicating a successful order
$orderSuccess = isset($_GET['orderSuccess']) ? true : false;

// Clear the cart if the order was successful
if ($orderSuccess) {
    // Add code to clear the cart (use the appropriate SQL query)
    mysqli_query($conn, "DELETE FROM `cart`");
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
    <title>Mizwair Ais Krim | Latest Product</title>
</head>

<body>
    <?php

    //Display the message base on the result
    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
        };
    };

    ?>

    <!-- Header section -->
    <?php
    include 'menu.php';
    ?>
    <!-- End Header section -->

    <!-- Products Container -->
    <div class="latest-section">
        <div class="container">
            <section class="products">
                <h1 class="heading">latest products</h1>

                <div class="box-container">
                    <?php

                    //select the data in the products page
                    $select_products = mysqli_query($conn, "SELECT * FROM `products`");
                    if (mysqli_num_rows($select_products) > 0) {
                        while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                    ?>

                            <form action="" method="post">
                                <div class="box">
                                    <img src="./shopping cart/uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
                                    <h3><?php echo $fetch_product['name']; ?></h3>
                                    <div class="price">RM<?php echo $fetch_product['price']; ?></div>
                                    <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                                    <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                                    <input type="submit" class="btn" value="add to cart" name="add_to_cart">
                                </div>
                            </form>

                    <?php
                        };
                    };
                    ?>

                </div>
            </section>
        </div>
    </div>
    <!-- End Products Container -->

    <!-- Footer section -->
    <?php
    include 'Footer.php';
    ?>
    <!-- End Footer section -->

    <!-- include the Javascript file -->
    <script src="JavaScript/script.js"></script>

</body>

</html>