<?php
require 'connection/connect.php'; //to onnect to the database 
include 'templates/header.php'; //to load the header of the index page
include 'templates/navbar.php'; //to load the navbar of index page 
?>
<img src="/images/randombanner.php" />
<main class="admin">
<!-- this section shows the manufacturers -->
	<section class="left">
		<ul>
					<?php
			// select from database manufacturers
			$sus_manu = $pdo->prepare('SELECT * FROM manufacturers');
			// execute the selection process
			$sus_manu->execute();
			// fetch the data from manufacturers
			$sus_manufacturers = $sus_manu->fetchAll();
			// fetch the data in list
			foreach($sus_manufacturers as $manufacturer)
			{
				echo '<li><a href="manufacturercars.php?manufacturer=' . $manufacturer['id'] . '">' . $manufacturer['name'] . '</a></li>';
			
			} 

			?>
		</ul>
	</section>

	<section class="right">
         <!-- available cars -->
		<h1>Our cars</h1>
		<!-- shows the car list -->
		<ul class="cars">
			<?php
			// select from cars 
			$sus_cars = $pdo->prepare("SELECT * FROM cars WHERE visible != 'Archive' LIMIT 10");
			// select from manufacturers
			$sus_manu = $pdo->prepare('SELECT * FROM manufacturers WHERE id = :id');
			// execute the selection in cars
			$sus_cars->execute();
			foreach ($sus_cars as $car) {
				// execute the selection of manufacturer 
				$sus_manu->execute(['id' => $car['manufacturerId']]);
				// fetch from the car in list 
				$sus_manufacturer = $sus_manu->fetch();
				echo '<li>';
				// shows images 
				if (file_exists('images/cars/' . $car['id'] . '.jpg')) {
					echo '<a href="images/cars/' . $car['id'] . '.jpg"><img src="images/cars/' . $car['id'] . '.jpg" /></a>';
				}

				echo '<div class="details">';
				echo '<h2>' . $sus_manufacturer['name'] . ' ' . $car['name'] . '</h2>';
				$discount = $car['price'] + 10/100* $car['price'];
				echo '<strike><h3>Was £' . $discount . '</h3></strike>';
				echo '<h3>Now £' . $car['price'] . '</h3>';
				echo '<h3>mileageofcars:' . $car['mileageofcars'] . '</h3>';
				echo '<h3>typeofengine:' . $car['typeofengine'] . '</h3>';
				echo '<p>' . $car['description'] . '</p>';

				echo '</div>';
				echo '</li>';
			}

	?>

		</ul>
<!-- section ends  -->
	</section>
	<!-- main ends -->
</main>
<?php
// to load te footer from the index 
include 'templates/footer.php';
?>