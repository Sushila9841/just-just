<?php
session_start();
require '../connection/connect.php'; // to connect database
include '../templates/adminheader.php'; // for admin header 
include '../templates/adminnavbar.php'; // for admin navbar
?>
<!-- Content are available here for archiving cars -->
	<main class="admin">
<!--To add the  sidebar  -->
	<?php
	include '../templates/adminsidebar.php';
	?>

	<section class="right">
		
	<?php
	// when logged in as admin
		if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {

			$sus_products = $pdo->query("UPDATE cars SET visible = 'Archive' WHERE id = " . $_POST['id']);

			echo 'The car has been kept in archived';

		}

		else {
				include 'login.php';	
		}
		?>
	
	</section>
		</main>
		<?php
		// load te footer 
		include '../templates/adminfooter.php';
		?>