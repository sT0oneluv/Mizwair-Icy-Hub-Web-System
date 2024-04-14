<?php

@include 'config.php';

//Add the product in the database
if (isset($_POST['add_product'])) {
   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_image = $_FILES['p_image']['name'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = 'uploaded_img/' . $p_image;

   //insert into sql table
   $insert_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image) VALUES('$p_name', '$p_price', '$p_image')") or die('query failed');

   //Message Pop-up
   if ($insert_query) {
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'product add succesfully';
   } else {
      $message[] = 'could not add the product';
   }
};

//Delete the product in the database
if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id ") or die('query failed');

   //Message Pop-up
   if ($delete_query) {
      $message[] = 'product has been deleted';
      header('location:admin.php');
   } else {
      $message[] = 'product could not be deleted';
      header('location:admin.php');
   };
};

//Action after product being update
if (isset($_POST['update_product'])) {
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'uploaded_img/' . $update_p_image;

   $update_query = mysqli_query($conn, "UPDATE `products` SET name = '$update_p_name', price = '$update_p_price', image = '$update_p_image' WHERE id = '$update_p_id'");

   //Message Pop-up
   if ($update_query) {
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $message[] = 'product updated succesfully';
      header('location:admin.php');
   } else {
      $message[] = 'product could not be updated';
      header('location:admin.php');
   }
}

// Search products in the database
if (isset($_POST['search'])) {
   $search_query = $_POST['search_query'];
   $search_query = mysqli_real_escape_string($conn, $search_query);
   $search_query = htmlspecialchars($search_query);

   $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%$search_query%'");

   // Display search result message
   if (mysqli_num_rows($select_products) > 0) {
      $message[] = 'Search results for "' . $search_query . '"';
   } else {
      $message[] = 'No search results found for "' . $search_query . '"';
   }
} else {
   // Fetch all products from the database if search is not performed
   $select_products = mysqli_query($conn, "SELECT * FROM `products`");
}


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
   <title>Admin Page | Home</title>

</head>

<body style="background-color: #D7D7CB;">

   <?php

   //Display the message base on the result
   if (isset($message)) {
      foreach ($message as $message) {
         echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></div>';
      };
   };

   ?>

   <?php include 'header.php'; ?>

   <div class="container">
      <section>
         <!-- form to add new product -->
         <form action="" method="post" class="add-product-form" enctype="multipart/form-data">
            <h3>add a new product</h3>
            <input type="text" name="p_name" placeholder="enter the product name" class="box" required>
            <input type="number" step=".01" name="p_price" min="0" placeholder="enter the product price" class="box" required>
            <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
            <input type="submit" value="add the product" name="add_product" class="btn">
         </form>

         <!-- Add search form -->
         <form action="" method="post" class="search-form">
            <input type="text" name="search_query" placeholder="Search products here" class="box" required>
            <button type="submit" name="search" class="btn"><i class="fas fa-search"></i></button>
         </form>

      </section>

      <!-- Product Table -->
      <section class="display-product-table">
         <table>
            <thead>
               <th>product image</th>
               <th>product name</th>
               <th>product price</th>
               <th>action</th>
            </thead>
            <tbody>
               <?php
               if (isset($_POST['search'])) {
                  // If a search query is performed, filter the products accordingly
                  if (mysqli_num_rows($select_products) > 0) {
                     while ($row = mysqli_fetch_assoc($select_products)) {
                        // Display search result rows...
               ?>
                        <tr>
                           <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                           <td><?php echo $row['name']; ?></td>
                           <td>RM<?php echo $row['price']; ?></td>
                           <td>
                              <a href="admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
                              <a href="admin.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
                           </td>
                        </tr>
                        <?php
                     }
                  } else {
                     // Display all product rows when search query doesn't match any product...
                     $select_products = mysqli_query($conn, "SELECT * FROM `products`");
                     if (mysqli_num_rows($select_products) > 0) {
                        while ($row = mysqli_fetch_assoc($select_products)) {
                           // Display all product rows...
                        ?>
                           <tr>
                              <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                              <td><?php echo $row['name']; ?></td>
                              <td>RM<?php echo $row['price']; ?></td>
                              <td>
                                 <a href="admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
                                 <a href="admin.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
                              </td>
                           </tr>
                        <?php
                        }
                     }
                  }
               } else {
                  // Display all product rows by default
                  if (mysqli_num_rows($select_products) > 0) {
                     while ($row = mysqli_fetch_assoc($select_products)) {
                        // Display all product rows...
                        ?>
                        <tr>
                           <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                           <td><?php echo $row['name']; ?></td>
                           <td>RM<?php echo $row['price']; ?></td>
                           <td>
                              <a href="admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
                              <a href="admin.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
                           </td>
                        </tr>
               <?php
                     }
                  }
               }
               ?>
            </tbody>
         </table>
      </section>

      <section class="edit-form-container">
         <?php

         //Edit the product
         if (isset($_GET['edit'])) {
            $edit_id = $_GET['edit'];
            $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id");
            if (mysqli_num_rows($edit_query) > 0) {
               while ($fetch_edit = mysqli_fetch_assoc($edit_query)) {
         ?>
                  <!-- Pop-up display edit form -->
                  <form action="" method="post" enctype="multipart/form-data">
                     <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
                     <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
                     <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
                     <input type="number" step=".01" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
                     <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
                     <input type="submit" value="update the product" name="update_product" class="btn">
                     <input type="reset" value="cancel" id="close-edit" class="option-btn">
                  </form>

         <?php
               };
            };
            echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
         };
         ?>
      </section>
   </div>

   <!-- custom js file link  -->
   <script src="./js/script.js"></script>

</body>

</html>