<?php
require 'connection/connect.php'; //to connect to the database
include 'templates/header.php';//index page header included
include 'templates/navbar.php';//index page navbar is incuded
?>
	<main class="admin">

	<section class="left">
		<ul>
			<li><a href="jaguar.php">Jaguar</a></li>
			<li><a href="mercedes.php">Mercedes</a></li>
			<li><a href="aston.php">Aston Martin</a></li>

		</ul>
	</section>

	<section class="right">

		<h1>Jaguar Cars</h1>

	<ul class="cars">


	<?php
	// select from the cars 
	$sus_cars = $pdo->prepare('SELECT * FROM cars WHERE manufacturerId = 2');
	// select from the manufacture 
	$sus_manu = $pdo->prepare('SELECT * FROM manufacturers WHERE id = :id');
   //execute the selection process of the cars 
	$sus_cars->execute();
	foreach ($sus_cars as $car) {
		//execute the selection process of manufacturer
		$sus_manu->execute(['id' => $car['manufacturerId']]);
		// fetch the data in in list according to the manufacturer
		$sus_manufacturer = $sus_manu->fetch();
		echo '<li>';
		if (file_exists('images/cars/' . $car['id'] . '.jpg')) {
			echo '<a href="images/cars/' . $car['id'] . '.jpg"><img src="images/cars/' . $car['id'] . '.jpg" /></a>';
		}

		echo '<div class="details">';
		echo '<h2>' . $sus_manufacturer['name'] . ' ' . $car['name'] . '</h2>';
		echo '<h3>£' . $car['price'] . '</h3>';
		echo '<p>' . $car['description'] . '</p>';

		echo '</div>';
		echo '</li>';
	}

	?>

</ul>

</section>
	</main>
	<?php
	// loads the footer 
include 'templates/footer.php';
?>