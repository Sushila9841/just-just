<?php
session_start();
require '../connection/connect.php'; // to connect database
include '../templates/adminheader.php'; // for admin header 
include '../templates/adminnavbar.php'; // for admin navbar
?>
<!-- Content are available here for deleting teams -->

	<main class="admin">
<!--To add the  sidebar  -->
	<?php
	
	include '../templates/adminsidebar.php';
	?>
	<section class="right">	
	<?php
// if logged in as admin 
		if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {

			$sus_products = $pdo->query('DELETE FROM team_member WHERE id = ' . $_POST['id']);
// message to delete the team member 
			echo 'The admin team member was deleted';

		}

		else {
			
			include 'login.php';
		
		}

	
	?>

</section>
	</main>
	<?php
	// to load the footer
	include '../templates/adminfooter.php';
	?>