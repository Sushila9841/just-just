<?php
require 'connection/connect.php'; //to connect to the database
include 'templates/header.php';//index page header included
include 'templates/navbar.php';//index page navbar is incuded
?>


		<img src="/images/randombanner.php"/>
	<main class="admin">

	<section class="left">
		<ul>
			<li><a href="jaguar.php">Jaguar</a></li>
			<li><a href="mercedes.php">Mercedes</a></li>
			<li><a href="aston.php">Aston Martin</a></li>

		</ul>
	</section>

	<section class="right">

		<h1>Mercedes Cars</h1>

	<ul class="cars">


	<?php
	// to select the cars according to the selected car name 
	$sus_cars = $pdo->prepare('SELECT * FROM cars WHERE manufacturerId = 3');
	// to selct the cars according to the selected manufacturer
	$sus_manu = $pdo->prepare('SELECT * FROM manufacturers WHERE id = :id');
	// execute teh selection process of the cars 
	$sus_cars->execute();
	// execute for each rows 
	foreach ($sus_cars as $sus_car) {
		// execute the selection process of according to the manufacturer
		$sus_manu->execute(['id' => $car['manufacturerId']]);
		// fetch the data from database 
		$sus_manufacturer = $sus_manu->fetch();
		echo '<li>';

		if (file_exists('images/cars/' . $sus_car['id'] . '.jpg')) {
			echo '<a href="images/cars/' . $sus_car['id'] . '.jpg"><img src="images/cars/' . $sus_car['id'] . '.jpg" /></a>';
		}

		echo '<div class="details">';
		echo '<h2>' . $sus_manufacturer['name'] . ' ' . $sus_car['name'] . '</h2>';
		echo '<h3>£' . $sus_car['price'] . '</h3>';
		echo '<p>' . $sus_car['description'] . '</p>';

		echo '</div>';
		echo '</li>';
	}

	?>

</ul>

</section>
	</main>


	<?php
	// load the footer
include 'templates/footer.php';
?>