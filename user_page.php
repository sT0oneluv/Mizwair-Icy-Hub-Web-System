<?php
@include 'config.php';

session_start();

if (isset($_SESSION['user_name']) && isset($_SESSION['user_email']) && isset($_SESSION['user_phone'])) {
    $name = $_SESSION['user_name'];
    $email = $_SESSION['user_email'];
    $phone = $_SESSION['user_phone'];
    /*$flat = $_SESSION['flat'];
    $street = $_SESSION['street'];
    $city = $_SESSION['city'];
    $state = $_SESSION['state'];
    $country = $_SESSION['country'];
    $pin_code = $_SESSION['pin_code'];*/
} else {
    // If the user is not logged in, initialize variables to empty strings
    $name = '';
    $email = '';
    $phone = '';
    /*$flat = '';
    $street = '';
    $city = '';
    $state = '';
    $country = '';
    $pin_code = '';*/
}

if (!isset($_SESSION['user_name']) || !isset($_SESSION['user_email']) || !isset($_SESSION['user_phone'])) {
    header('location: ./LoginSystem/login_form.php');
    exit;
}

$email = $_SESSION['user_email'];
$select_address = "SELECT * FROM user_form WHERE email = '$email'";
$result_address = mysqli_query($conn, $select_address);

if (mysqli_num_rows($result_address) > 0) {
    $row = mysqli_fetch_assoc($result_address);

    // Extract address fields
    $user_flat = $row['flat'];
    $user_street = $row['street'];
    $user_city = $row['city'];
    $user_state = $row['state'];
    $user_country = $row['country'];
    $user_pin_code = $row['pin_code'];

    $user_address = $user_flat . ', ' . $user_street . ', ' . $user_pin_code . ', ' . $user_city . ', ' . $user_state . ', ' . $user_country;
}

//Action after product being update
if (isset($_POST['update_profile'])) {
    $update_id = $_POST['update_id'];
    $update_name = $_POST['update_name'];
    $update_email = $_POST['update_email'];
    $update_phone = $_POST['update_phone'];
    $update_flat = $_POST['update_flat'];
    $update_street = $_POST['update_street'];
    $update_city = $_POST['update_city'];
    $update_state = $_POST['update_state'];
    $update_country = $_POST['update_country'];
    $update_p_code = $_POST['update_p_code'];

    $update_query = mysqli_query($conn, "UPDATE `user_form` SET name = '$update_name', email = '$update_email', 
    phone = '$update_phone', flat = '$update_flat', street = '$update_street', city = '$update_city', 
    state = '$update_state', country = '$update_country', pin_code = '$update_p_code' WHERE id = '$update_id'");

    // Update session variables with new values
    $_SESSION['user_name'] = $update_name;
    $_SESSION['user_email'] = $update_email;
    $_SESSION['user_phone'] = $update_phone;

    // Update user address session variable
    $user_address = $update_flat . ', ' . $update_street . ', ' . $update_pin_code . ', ' . $update_city . ', ' . $update_state . ', ' . $update_country;
    $_SESSION['user_address'] = $user_address;

    // Redirect to user_page.php after updating the profile
    header('Location: user_page.php');
    exit;
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
    <title>Mizwair Ais Krim | Profile</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <!-- Header section -->
    <?php
    include 'menu.php';
    ?>
    <!-- End Header section -->

    <section class="userPage">
        <div class="container">
            <div class="content">
                <h3 class="user-heading">Profile</h3>
                <div class="user-details">
                    <p><strong>Name:</strong> <span><?php echo $_SESSION['user_name'] ?></span></p>
                    <p><strong>Email:</strong> <span><?php echo $_SESSION['user_email'] ?></span></p>
                    <p><strong>Phone Number:</strong> +6<span><?php echo $_SESSION['user_phone'] ?></span></p>
                    <p><strong>Address:</strong> <span><?php echo isset($user_address) ? $user_address : 'Address not available'; ?></span></p>
                </div>
                <div class="buttons">
                    <a href="productPage.php" class="btn">Shop Now</a>
                    <a href="user_page.php?edit=<?php echo $row['id']; ?>" id="editProfileBtn" class="btn">Edit Profile</a>
                    <a href="./LoginSystem/logout.php" class="btn">Logout</a>
                </div>

                <!-- Edit profile form -->
                <?php

                //Edit the product
                if (isset($_GET['edit'])) {
                    $edit_id = $_GET['edit'];
                    $edit_query = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = $edit_id");
                    if (mysqli_num_rows($edit_query) > 0) {
                        while ($fetch_edit = mysqli_fetch_assoc($edit_query)) {
                ?>

                            <div id="editProfileForm" class="edit-form-container">
                                <h3>Edit Profile</h3>
                                <form action="" method="POST">
                                    <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
                                    <input type="text" name="update_name" placeholder="Enter new name" class="box" value="<?php echo $name; ?>" required>
                                    <input type="email" name="update_email" placeholder="Enter new email" class="box" value="<?php echo $email; ?>" required>
                                    <input type="text" name="update_phone" placeholder="Enter new phone number" class="box" value="<?php echo $phone; ?>" required>
                                    <p>Enter new home address</p>
                                    <div class="box2">
                                        <input type="text" name="update_flat" placeholder="Address Line 1" value="<?php echo $user_flat; ?>" required>
                                        <input type="text" name="update_street" placeholder="Address Line 2" value="<?php echo $user_street; ?>" required>
                                    </div>
                                    <div class="box2">
                                        <input type="text" name="update_city" placeholder="City" value="<?php echo $user_city; ?>" required>
                                        <input type="text" name="update_state" placeholder="State" value="<?php echo $user_state; ?>" required>
                                    </div>
                                    <div class="box2">
                                        <input type="text" name="update_country" placeholder="Country" value="<?php echo $user_country; ?>" required>
                                        <input type="text" name="update_p_code" placeholder="Pin Code" value="<?php echo $user_pin_code; ?>" required>
                                    </div>
                                    <input type="submit" id="updateProfile" value="Save Changes" name="update_profile" class="btn">
                                    <button type="reset" id="cancelEditBtn" class="option-btn">Cancel</button>
                                </form>
                            </div>
                <?php
                        };
                    };
                    echo "<script>document.querySelector('.edit-form-container').style.display = 'block';</script>";
                };
                ?>
            </div>
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