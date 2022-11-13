<?php
session_start();
require '../connection/connect.php'; // to connect database
include '../templates/adminheader.php'; // for admin header 
include '../templates/adminnavbar.php'; // for admin navbar
?>
<!-- Content are available here for deleting news -->
	<main class="admin">
<!--To add the  sidebar  -->
	<?php
	include '../templates/adminsidebar.php';
	?>
	<section class="right">	
	<?php
// if logged in as admin 
		if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {
// to delete news
			$sus_stmt = $pdo->prepare('DELETE FROM news WHERE id = :id');
			$sus_stmt->execute(['id' => $_POST['id']]);

			echo 'The News was deleted';

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