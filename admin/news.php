<?php
session_start();
require '../connection/connect.php'; // to connect database
include '../templates/adminheader.php'; // for admin header 
include '../templates/adminnavbar.php'; // for admin navbar
?>
<!-- Content are available here for news -->
	<main class="admin">

	<?php
	include '../templates/adminsidebar.php';
	?>


	<section class="right">
		
	<?php
// when logged in as admin
		if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {
		?>
			<h2>NEWS</h2>

			<a class="new" href="add_news.php">Add new News</a>

			<?php
			echo '<table>';
			echo '<thead>';
			echo '<tr>';
			echo '<th>Title</th>';
			echo '<th>Description</th>';
			
			echo '<th style="width: 12%">Price</th>';
			echo '<th style="width: 7%">&nbsp;</th>';
			echo '<th style="width: 8%">&nbsp;</th>';
			

			echo '</tr>';

			$sus_news = $pdo->query('SELECT * FROM news');

			foreach ($sus_news as $sus_new) {
				
				echo '<tr>';
				echo '<td>' . $sus_new['title'] . '</td>';
				echo '<td>' . $sus_new['description'] . '</td>';
			
				
				
				echo '<td><form method="post" action="deletenew.php">
				<input type="hidden" name="id" value="' . $sus_new['id'] . '" />
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
	// to load teh footer 
	include '../templates/adminfooter.php';
	?>