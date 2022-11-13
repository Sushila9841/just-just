<?php
session_start();
require '../connection/connect.php'; // to connect database
include '../templates/adminheader.php'; // for admin header
include '../templates/adminnavbar.php'; // for admin navbar
?>
<!-- Content are available here for adding news -->
	<main class="admin">
<!--To add the  sidebar  -->
	<?php
	include '../templates/adminsidebar.php';
	?>

	<section class="right">

		
	<?php
// when submit is clicked
	if (isset($_POST['submit'])) {
    //    insertion into the admin team member table 
		$sus_stmt = $pdo->prepare('INSERT INTO team_member (name) VALUES (:name)');
        // inertion criteria
		$sus_criteria = [
			'name' => $_POST['name']
		];
    	// execute the inertion 
		$sus_stmt->execute($sus_criteria);
		echo 'Admin team member has been added';
	}
	else {
		// when login as admin
		if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {
		?>
<!-- to add a team member -->
			<h2>Add team_member</h2>

			<form action="" method="POST">
				<label>Name</label>
				<input type="text" name="name" />


				<input type="submit" name="submit" value="Add team_member" />

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
	// load the footer 
	include '../templates/adminfooter.php';
	?>