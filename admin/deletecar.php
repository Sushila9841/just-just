<?php
session_start();
require '../connection/connect.php'; // to connect database
include '../templates/adminheader.php'; // for admin header 
include '../templates/adminnavbar.php'; // for admin navbar
?>
<!-- Content are available here for deleting cars -->
	<main class="admin">
<!--To add the  sidebar  -->
	<?php
	include '../templates/adminsidebar.php';
	?>
	<section class="right">
	<?php


		if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {

			$sus_stmt = $pdo->prepare('DELETE FROM cars WHERE id = :id');
			$sus_stmt->execute(['id' => $_POST['id']]);

			echo 'The car was deleted';

		}

		else {
			else {
			
				include 'login.php';
			
			}
	
		}
		?>
	
	</section>
		</main>
	
	
		<?php
		// to load the footer
		include '../templates/adminfooter.php';
		?>
			