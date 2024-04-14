<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);

    $select = "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_array($result);

        // Store user details in session variables
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_phone'] = $row['phone'];

        // Store address attributes in session variables
        $_SESSION['user_address'] = $row['flat'] . ', ' . $row['street'] . ', ' . $row['city'] . ', ' . $row['state'] . ', ' . $row['country'] . ', ' . $row['pin_code'];

        // Redirect user to appropriate page
        if ($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            header('location:../shopping cart/admin.php');
        } elseif ($row['user_type'] == 'user') {
            header('location:../Mizwair.php');
        }
    } else {
        $error[] = 'Incorrect email or password!';
    }
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mizwair Ais Krim | Log In Account</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="form-container">
        <form action="" method="post">
            <h3>login now</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                };
            };
            ?>
            <input type="email" name="email" required placeholder="enter your email">
            <input type="password" name="password" required placeholder="enter your password">
            <input type="submit" name="submit" value="login now" class="form-btn">
            <p>Don't have an account? <a href="register_form.php">Register Now</a></p>
            <button class="form-btn" onclick="window.location.href='../Mizwair.php'">be a guest</button>
        </form>

    </div>

</body>

</html>