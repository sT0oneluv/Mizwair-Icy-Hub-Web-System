 <style>
 	/* Header -> navigation menu */
 	.navbar .menu {
 		display: flex;
 		justify-content: space-between;
 		align-items: center;
 		padding: 20px 2%;
 		background-color: #E8888A;
 	}

 	.navbar .logo {
 		font-size: 20px;
 		font-weight: bold;
 		padding: 8px 15px;
 		/*border: 3px solid black;*/
 		cursor: pointer;
 	}

 	.navbar ul {
 		z-index: 1;
 		padding: 0;
 		list-style: none;
 		display: flex;
 		justify-content: center;
 	}

 	.navbar li {
 		margin: 0 20px;
 		position: relative;
 	}

 	.navbar a {
 		text-decoration: none;
 		color: white;
 		transition: all 0.3s ease;
 	}

 	.navbar a:hover {
 		color: #B75264;
		font-weight: bold;
 	}

 	.navbar .icon {
 		display: flex;
 	}

 	.navbar .icon i {
 		text-decoration: none;
 		color: white;
 		padding: 0 10px
 	}

 	.navbar .icon form {
 		width: 70%;
 		border: 1px solid #D7D7CB;
 		border-radius: 4px;
 		display: flex;
 		flex-direction: row;
 		align-items: center;
 	}

 	.navbar .icon form input {
 		font-family: inherit;
 		border: none;
 		outline: none;
 		box-shadow: none;
 		background: none;
 		width: 100%;
 		font-size: 14px;
 		font-weight: 400;
 		padding: 7px 9px;
 	}

 	.navbar .icon .totalQuantity {
 		top: 0;
 		right: 0;
 		font-size: 14px;
 		background-color: #B75264;
 		width: 20px;
 		height: 20px;
 		color: #474737;
 		font-weight: bold;
 		display: flex;
 		justify-content: center;
 		align-items: center;
 		border-radius: 50%;
 		transform: translateX(-8px);
 	}

 	/* End Header */
 </style>


 <!-- Header section -->
 <nav class="navbar">
 	<div class="menu">
 		<div class="logo"><a href="Mizwair.php">Mizwair Ice Cream</a></div>
 		<ul>
 			<li><a href="Mizwair.php">HOME</a></li>
 			<li><a href="productPage.php">SHOP</a></li>
 			<li class="sub-menu">
 				<a href="event.php">EVENTS</a>
 			</li>
 			<li><a href="Contact.php">CONTACT</a></li>
 		</ul>
 		<div class="icon">
 			<?php
				//updated cart count
				$select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
				$row_count = mysqli_num_rows($select_rows);

				?>
 			<a href="addToCart.php"><i class="fa-solid fa-cart-shopping"></i></a>
 			<div class="totalQuantity"><span><?php echo $row_count; ?></span></div>
 			<a href="user_page.php"><i class="fa-solid fa-user"></i></a>
 		</div>
 	</div>
 </nav>