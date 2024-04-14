<?php

@include 'config.php';

//for update function
if (isset($_POST['update_update_btn'])) {
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
   if ($update_quantity_query) {
      header('location:addToCart.php');
   };
};

//remove order
if (isset($_GET['remove'])) {
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
   header('location:addToCart.php');
};

//delete OR clear cart
if (isset($_GET['delete_all'])) {
   mysqli_query($conn, "DELETE FROM `cart`");
   header('location:addToCart.php');
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
   <title>Mizwair Ais Krim | Shopping Cart</title>
</head>

<body>

   <!-- Header section -->
   <?php
   include 'menu.php';
   ?>
   <!-- End Header section -->

   <div class="container-cart">
      <section class="shopping-cart">
         <h1 class="heading">shopping cart</h1>

         <!-- cart content -->
         <table>
            <thead>
               <th>product</th>
               <th>name</th>
               <th>price</th>
               <th>quantity</th>
               <th>total price</th>
               <th>action</th>
            </thead>

            <tbody>

               <?php

               $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
               $grand_total = 0;
               if (mysqli_num_rows($select_cart) > 0) {
                  while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
               ?>

                     <tr>
                        <td><img src="./shopping cart/uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
                        <td><?php echo $fetch_cart['name']; ?></td>
                        <td>RM<?php echo number_format($fetch_cart['price'],2); ?></td>
                        <td>
                           <form action="" method="post">
                              <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
                              <input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['quantity']; ?>">
                              <input type="submit" value="+" name="update_update_btn">
                           </form>
                        </td>
                        
                        <!-- calculate total -->
                        <td>RM<?php echo $sub_total = number_format(($fetch_cart['price'] * $fetch_cart['quantity']),2); ?></td>
                        <td><a href="addToCart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i></a></td>
                     </tr>
               <?php
                     $grand_total += $sub_total;
                  };
               };
               ?>
               <!-- last row -->
               <tr class="table-bottom">
                  <td><a href="productPage.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
                  <td colspan="3">total</td>
                  <td>RM<?php echo number_format($grand_total, 2); ?></td>
                  <td><a href="addToCart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> clear cart </a></td>
               </tr>

            </tbody>

         </table>

         <div class="checkout-btn">
            <a href="checkout.php" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">proceed to checkout</a>
         </div>

      </section>
   </div>

   <!-- Footer section -->
   <?php
   include 'Footer.php';
   ?>
   <!-- End Footer section -->

   <!-- custom js file link  -->
   <script src="./shopping cart/js/script.js"></script>

</body>

</html>