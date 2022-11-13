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

// when submit button is pressed 
	if (isset($_POST['submit'])) {
// to update the manufacturers
		$sus_stmt = $pdo->prepare('UPDATE manufacturers SET name = :name WHERE id = :id ');
// criteria to update the manufacters
		$sus_criteria = [
			'name' => $_POST['name'],
			'id' => $_POST['id']
		];
// execute the update 
		$sus_stmt->execute($sus_criteria);
		echo 'the Manufacturer is saved';
	}
	else {
		// when logged in as admin 
		if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {
// select from the amnufacturer
			$sus_currentMan = $pdo->query('SELECT * FROM manufacturers WHERE id = ' . $_GET['id'])->fetch();
		?>


			<h2>Edit Manufacturer</h2>

			<form action="" method="POST">

				<input type="hidden" name="id" value="<?php echo $sus_currentMan['id']; ?>" />
				<label>Name</label>
				<input type="text" name="name" value="<?php echo $sus_currentMan['name']; ?>" />


				<input type="submit" name="submit" value="Save Manufacturer" />

			</form>
			

		<?php
		}

		else {
			
			include 'login.php';
		
		}

	}
	?>

</section>
	</main>


	<?php
	include '../templates/adminfooter.php';
	?>