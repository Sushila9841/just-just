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
		<h1>Aston Martin Cars</h1>
	<ul class="cars">
	<?php
	// select the cars and manufacture from the database 
	$sus_cars = $pdo->prepare('SELECT * FROM cars WHERE manufacturerId = 4');
	$sus_manu = $pdo->prepare('SELECT * FROM manufacturers WHERE id = :id');
	//selecting of cars is done
	$sus_cars->execute();
    //selecting manufacture is done using its id
	foreach ($sus_cars as $car) {
		$sus_manu->execute(['id' => $car['manufacturerId']]);
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
<!-- index footer is included -->
<?php
include 'templates/footer.php';
?>