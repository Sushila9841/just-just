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
// When submit button is pressed 
	if (isset($_POST['submit'])) {
// to insert  into cars 
		$sus_stmt = $pdo->prepare('INSERT INTO cars (name, description, price, manufacturerId,mileageofcars,typeofengine) 
							   VALUES (:model, :description, :price, :manufacturerId, :mileageofcars, :typeofengine)');
		// inserting criteria of cars is mentioned below
		$sus_criteria = [
			'model' => $_POST['model'],
			'description' => $_POST['description'],
			'price' => $_POST['price'],
			'manufacturerId' => $_POST['manufacturerId'],
			'mileageofcars' => $_POST['mileageofcars'],
			'typeofengine' => $_POST['typeofengine']
		];
		// when criteria is met its executed
		$sus_stmt->execute($sus_criteria);
		// to insert the image  
		if ($_FILES['image']['error'] == 0) {
			$fileName = $pdo->lastInsertId() . '.jpg';
			move_uploaded_file($_FILES['image']['tmp_name'], '../images/cars/' . $fileName);
		}
		//message of successfuladding into cars  
		echo 'Congrats!!! Car is successfully added.';
	}
	else {
		// if admin is logged in than below template is displayed 
		if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {
		?>
		<!-- html template to add cars  -->
			<h2>Add Car</h2>
			<!-- form for adding cars -->
			<form action="addcar.php" method="POST" enctype="multipart/form-data">
				<label>Car Model</label>
				<input type="text" name="model" />
				<label>Description</label>
				<textarea name="description"></textarea>
				<label>Price</label>
				<input type="text" name="price" />
				<label>Category</label>
				<select name="manufacturerId">
					<!-- manufacturer is imported from database -->
				<?php
					$sus_stmt = $pdo->prepare('SELECT * FROM manufacturers');
					$sus_stmt->execute();
					// displays the manufacturer from database in row
					foreach ($sus_stmt as $row) {
						echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
					}

				?>
				</select>
				<label>Image</label>

				<input type="file" name="image" />

				<label>Mileageofcars</label>
				<input type="text" name="mileageofcars"/>

				<label>Typeofengine</label>
				<input type="text" name="typeofengine" />

				<input type="submit" name="submit" value="Add Car" />

			</form>
			<!-- form ends here -->
			<?php
		}
		else {
			// loads login page if needed
			include 'login.php';
		}
	}
	?>

	</section>
</main>
<!-- loads the footer of admin -->
	<?php
	include '../templates/adminfooter.php';
	?>