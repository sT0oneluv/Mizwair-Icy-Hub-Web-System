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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Page title -->
    <title>Admin Page | Contact Messages</title>
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container">
        <section class="message-details">
            <!-- Add header content here -->
            <h1 class="heading">Contact Message</h1>

            <table>
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subject</th>
                    <th>Message</th>
                </thead>

                <tbody>

                    <?php

                    // Fetch orders from the database
                    $select_query = mysqli_query($conn, "SELECT * FROM `contact_us`");

                    if (mysqli_num_rows($select_query) > 0) {
                        while ($list = mysqli_fetch_assoc($select_query)) {
                    ?>

                            <tr>
                                <td><?php echo $list['id']; ?></td>
                                <td><?php echo $list['name']; ?></td>
                                <td><?php echo $list['email']; ?></td>
                                <td><?php echo $list['phone']; ?></td>
                                <td><?php echo $list['subject']; ?></td>
                                <td><?php echo $list['message']; ?></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<p style='font-size: 2rem;'>No new message available</p>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

</body>

</html>