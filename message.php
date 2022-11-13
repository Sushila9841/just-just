<?php
require 'connection/connect.php'; //to connect to the database
include 'templates/header.php';//index page header included
include 'templates/navbar.php';//index page navbar is incuded
?>
<main class="admin">
	<section class="right">
	<?php

// when submit button is pressed th inqueries of userr is inserted into the database
	if (isset($_POST['submit'])) {
        // for insert the inquery into databse 
		$sus_stmt = $pdo->prepare('INSERT INTO queries (name, feedback,report) 
							   VALUES (:name, :feedback,:report)');
		// criteria to insert inquery into database 
		$sus_criteria = [
			'name' => $_POST['name'],
			'feedback' => $_POST['feedback'],
		    'report'=> 'NOT DONE',
			
		];
		// execute the insertion into the table 
		$sus_stmt->execute($criteria);
		echo 'your Feedback has been sent. ';
	}
	else {
		
		?>
			<h2>Add queries</h2>

			<form action="add_query.php" method="POST" enctype="multipart/form-data">
				<label>Your Name:</label>
				<input type="text" name="name" />

				<label>feedback:</label>
				<textarea name="feedback"></textarea>

				<input type="submit" name="submit" value="Add queries" />

			</form>
			

		
		<?php
		

	}
	?>

</section>
	</main>
	<?php
	// to load the footer
include 'templates/footer.php';
?>


	