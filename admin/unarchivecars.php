<?php
session_start();
require '../connection/connect.php'; // to connect database
include '../templates/adminheader.php'; // for admin header 
include '../templates/adminnavbar.php'; // for admin navbar
?>
	<main class="admin">
<!-- to hide cars -->
	<?php
	include '../templates/adminsidebar.php';
	?>

	<section class="right">
		
	<?php
// when logged in as admin
		if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {
// update the cars 
			$sus_products = $pdo->query("UPDATE cars SET visible = 'UnArchive' WHERE id = " . $_POST['id']);

			echo ' Your car has been restored from Unarchive';

		}

		else {
			
			include 'login.php';
		
		}	
	?>

</section>
	</main>

<!-- for footer -->
	<?php
	include '../templates/adminfooter.php';
	?>