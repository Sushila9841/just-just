<?php
session_start();
require '../connection/connect.php'; // to connect database
include '../templates/adminheader.php'; // for admin header 
include '../templates/adminnavbar.php'; // for admin navbar
?>
<?php
// to login as admin in backend
	if (isset($_POST['submit'])) {
		if ($_POST['password'] == 'opensesame' && $_POST['username'] == 'admin'){
			$_SESSION['logged_in_admin'] = true;	
			$_SESSION['main'] = $admin['main'];

		}
	}
    // when login as admin
	if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {		
	?>
    <main class="admin">
				<section class="left">
		<ul>
			<li><a href="manufacturers.php">Manufacturers</a></li>
			<li><a href="cars.php">Cars</a></li>
			<li><a href="archived.php">Archived Cars</a></li>
			<li><a href="admins.php"> Admins</a></li>
			<li><a href="enquiries.php"> Enquiries</a></li>
			<li><a href="articles.php"> Create Article</a></li>
			<li><a href="adminlogout.php"> Log Out</a></li>
		</ul>
	</section>

	<section class="right">
	<h2>You are now logged in</h2>
	</section>
	<?php
	}
	else {
		?>

		<main class="admin">
		<h2>Log in</h2>

		<form action="adminlogin.php" method="post" style="padding: 40px">

			<label>Enter Username</label>
		
			<input type="text" name="username" />
		
			<label>Enter Password</label>
			<input type="password" name="password" />

			<input type="submit" name="submit" value="Log In" />
		</form>
		</main>
	<?php
	}
	?>
