<?php

@include 'config.php';

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $flat = mysqli_real_escape_string($conn, $_POST['flat']);
    $street = mysqli_real_escape_string($conn, $_POST['street']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $pin_code = mysqli_real_escape_string($conn, $_POST['pin_code']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = 'user';

    $select = " SELECT * FROM user_form WHERE email = '$email' & password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {

        $error[] = 'user already exist!';
    } else {

        if ($pass != $cpass) {
            $error[] = 'password not matched!';
        } else {

            // Validate phone number format (optional)
            if (!preg_match('/^\d{10,12}$/', $phone)) {

                $error[] = 'Phone number must be a 10 - 12-digit number!';
            } else {
                $insert = "INSERT INTO user_form(name, email, phone, flat, street, city, state, 
                country, pin_code, password, user_type) 
                VALUES('$name','$email', '$phone', '$flat', '$street', '$city', '$state', '$country',
                '$pin_code', '$pass','$user_type')";

                if (mysqli_query($conn, $insert)) {
                    header('location: login_form.php');
                    exit;
                } else {
                    $error[] = 'Error: ' . mysqli_error($conn);
                }
            }
        }
    }
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mizwair Ais Krim | Registration</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="form-container">

        <form action="" method="post">
            <h3>register now</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                };
            };
            ?>
            <input type="text" name="name" required placeholder="name">
            <input type="email" name="email" required placeholder="email">
            <input type="tel" name="phone" required placeholder="phone number">
            <input type="password" name="password" required placeholder="password">
            <input type="password" name="cpassword" required placeholder="confirm your password">
            <div class="address">
                <input type="text" name="flat" placeholder="Address Line 1">
                <input type="text" name="street" placeholder="Address Line 2">

            </div>
            <div class="address">
                <input type="text" name="city" placeholder="City">
                <input type="text" name="state" placeholder="State">
            </div>
            <div class="address">
                <input type="text" name="country" placeholder="Country">
                <input type="text" name="pin_code" placeholder="Pin Code">
            </div>
            <input type="submit" name="submit" value="register now" class="form-btn">
            <p>Already have an account? <a href="login_form.php">Login Now</a></p>
        </form>

    </div>
</body>

</html>