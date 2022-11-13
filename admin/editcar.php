<?php
session_start();
require '../connection/connect.php'; // to connect database
include '../templates/adminheader.php'; // for admin header 
include '../templates/adminnavbar.php'; // for admin navbar
?>
<!--  Content are available here for deleting teams -->
 
	<main class="admin">
<!--To add the  sidebar  -->

	<?php
	include '../templates/adminsidebar.php';
	?>
	<section class="right">
		
	<?php
// when submit button is pressed cars are updated 
	if (isset($_POST['submit'])) {

		$sus_stmt = $pdo->prepare('UPDATE cars
								SET name = :name, 
								    description = :description, 
								    price = :price,
								    manufacturerId = :manufacturerId
								   WHERE id = :id 
						');

		$sus_criteria = [
			'name' => $_POST['name'],
			'description' => $_POST['description'],
			'price' => $_POST['price'],
			'manufacturerId' => $_POST['manufacturerId'],
			'id' => $_POST['id']
		];

		$sus_stmt->execute($sus_criteria);

		if ($_FILES['image']['error'] == 0) {
			$fileName = $pdo->lastInsertId() . '.jpg';
			move_uploaded_file($_FILES['image']['tmp_name'], '../productimages/' . $fileName);
		}

		echo 'The Product are saved';
	}
	else {
		if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {

			$sus_car = $pdo->query('SELECT * FROM cars WHERE id = ' . $_GET['id'])->fetch();


		?>

			<h2>Edit Car</h2>

			<form action="editcar.php" method="POST" enctype="multipart/form-data">

				<input type="hidden" name="id" value="<?php echo $car['id']; ?>" />
				<label>Name</label>
				<input type="text" name="name" value="<?php echo $car['name']; ?>" />

				<label>Description</label>
				<textarea name="description"><?php echo $car['description']; ?></textarea>

				<label>Price</label>
				<input type="text" name="price" value="<?php echo $car['price']; ?>" />

				<label>Category</label>

				<select name="manufacturerId">
				<?php
					$sus_stmt = $pdo->prepare('SELECT * FROM manufacturers');
					$sus_stmt->execute();

					foreach ($sus_stmt as $sus_row) {
						if ($sus_car['categoryId'] == $sus_row['id']) {
							echo '<option selected="selected" value="' . $sus_row['id'] . '">' . $sus_row['name'] . '</option>';
						}
						else {
							echo '<option value="' . $sus_row['id'] . '">' . $sus_row['name'] . '</option>';	
						}
						
					}

				?>

				</select>

				<label>Engine Type</label>
				<input type="text" name="typeofengine" value="<?php echo $sus_car['typeofengine']; ?>" />

				<label>mileageofcars</label>
				<input type="text" name="mileageofcars" value="<?php echo $sus_car['mileageofcars']; ?>" />


				<?php

					if (file_exists('../productimages/' . $sus_car['id'] . '.jpg')) {
						echo '<img src="../productimages/' . $sus_car['id'] . '.jpg" />';
					}
				?>
				<label>Product image</label>

				<input type="file" name="image" />

				<input type="submit" name="submit" value="Save Product" />

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
	// to load the footer 
	include '../templates/adminfooter.php';
	?>