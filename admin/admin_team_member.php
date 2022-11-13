<?php
session_start();
require '../connection/connect.php'; // to connect databse
include '../templates/adminheader.php'; // for admin header
include '../templates/adminnavbar.php'; // for admin navbar
?>
<!-- Content are available here for adding news -->
	<main class="admin">
<!-- to add  menu -->
	<?php
	include '../templates/adminsidebar.php';
	?>
	<section class="right">
		
	<?php
// when login as admin
		if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {
		?>


			<h2>TeamMember</h2>

			<a class="new" href="addteam.php">ADD ADMIN TEAM MEMBER</a>

			<?php
			echo '<table>';
			echo '<thead>';
			echo '<tr>';
			echo '<th>Name</th>';
			echo '<th style="width: 5%">&nbsp;</th>';
			echo '<th style="width: 5%">&nbsp;</th>';
			echo '</tr>';
// to add admin team
			$sus_categories = $pdo->query('SELECT * FROM team_member');

			foreach ($sus_categories as $sus_category) {
				echo '<tr>';
				echo '<td>' . $sus_category['name'] . '</td>';
				echo '<td><a style="float: right" href="editteam.php?id=' . $category['id'] . '">Edit</a></td>';
				echo '<td><form method="post" action="deleteteam.php">
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
	// template for the footer 
	include '../templates/adminfooter.php';

	?>
			