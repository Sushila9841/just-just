<?php
session_start();
require '../connection/connect.php'; //to connect to the database
include '../templates/adminheader.php'; //for admin header 
include '../templates/adminnavbar.php'; //for admin navbar
?>
<!-- Content are available here for adding news -->
<main class="admin">
		<!--To add the  sidebar  -->
	<?php
	include '../templates/adminsidebar.php';
	?>
<!-- section for addig the manufacturer -->
	<section class="right">	
	<?php
// when submit button is pressed 
	if (isset($_POST['submit'])) {
		//to insert into manufacterers 
		$sus_stmt = $pdo->prepare('INSERT INTO manufacturers (name) VALUES (:name)');
		// criteria to insert into manufacterers
		$sus_criteria = [
			'name' => $_POST['name']
		];
		// when criteria is met execution to insert is proceed 
		$sus_stmt->execute($sus_criteria);
		// message for success in adding Manufacturer
		echo 'Congrats!! Manufacturer is successfullt added.';
	}
	else {
		// When logged in as admin 
		if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {
		?>
		<!-- template to add manufacturer -->
			<h2>Add Manufacturer</h2>
			<!-- form to add manufacturer -->
			<form action="" method="POST">
				<label>Name</label>
				<input type="text" name="name" />
				<input type="submit" name="submit" value="Add Manufacturer" />
			</form>
			<!-- form ends here -->
			<?php
		}
		else {
			// loads the login page 
			include 'login.php';
		}
	}
	?>
</section>
	</main>


	<?php
	include '../templates/adminfooter.php';
	?>