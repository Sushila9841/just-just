<?php
session_start();
require '../connection/connect.php'; // to connect database
include '../templates/adminheader.php'; // for admin header 
include '../templates/adminnavbar.php'; // for admin navbar
?>
<!-- Content are available here for manufacturers -->
	<main class="admin">
<!--To add the  sidebar  -->
	<?php
	include '../templates/adminsidebar.php';
	?>

	<section class="right">

		
		
	<?php
// logged in as user
		if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {
		?>
			<h2>Manufacturers</h2>

			<a class="new" href="addmanufacturer.php">Add new manufacturer</a>

			<?php
			echo '<table>';
			echo '<thead>';
			echo '<tr>';
			echo '<th>Name</th>';
			echo '<th style="width: 5%">&nbsp;</th>';
			echo '<th style="width: 5%">&nbsp;</th>';
			echo '</tr>';

			$sus_categories = $pdo->query('SELECT * FROM manufacturers');

			foreach ($sus_categories as $sus_category) {
				echo '<tr>';
				echo '<td>' . $sus_category['name'] . '</td>';
				echo '<td><a style="float: right" href="editmanufacturer.php?id=' . $sus_category['id'] . '">Edit</a></td>';
				echo '<td><form method="post" action="deletemanufacturer.php">
				<input type="hidden" name="id" value="' . $sus_category['id'] . '" />
				<input type="submit" name="submit" value="Delete" />
				</form></td>';
				
				echo '</tr>';
			}

			echo '</thead>';
			echo '</table>';

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