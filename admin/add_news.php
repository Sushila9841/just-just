
<?php
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
	<section class="right">
	<?php
// when submit button is pressed news are added in database 
	if (isset($_POST['submit'])) {
		// To insert  into the databse of news 
		$sus_stmt = $pdo->prepare('INSERT INTO news (title, description) 
							   VALUES (:title, :description)');
		// criteria is insert news to database
		$sus_criteria = [
			'title' => $_POST['title'],
			'description' => $_POST['description'],
			
		];
		// Executing to insert news to databse  
		$sus_stmt->execute($sus_criteria);
		echo 'BRAND NEW NEWS WAS ADDED.';
	}
	else {
		//only when admin logs into the admin page 
		if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {
		?>
            <!-- html template tof add news  -->
			<h2>ADD NEWS</h2>
			<!-- form for adding news -->
			<form action="add_news.php" method="POST" enctype="multipart/form-data">
				<label>news title</label>
				<input type="text" name="title" />
				<label>Description</label>
				<textarea name="description"></textarea>
				<input type="submit" name="submit" value="Add news" />
			</form>
			<!-- form ends here -->		
		<?php
		}
		// if user is not logged is than this else condition redirect into login page 
		else {
			?>
			<h2>Log in</h2>

			<form action="index.php" method="post">

				<label>Password</label>
				<input type="password" name="password" />

				<input type="submit" name="submit" value="Log In" />
			</form>
		<?php
		}

	}
	?>

	</section>
	<!-- section ends here  -->
</main>
<!-- main ends here -->
<!-- to load footer -->
	<?php
	include '../templates/adminfooter.php';
	?>