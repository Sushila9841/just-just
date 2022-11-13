<?php
require 'connection/connect.php'; //to connect to the database
include 'templates/header.php';//index page header included
include 'templates/navbar.php';//index page navbar is incuded
?>
<img src="images/randombanner.php"/>
	<main class="home">
		<p>Welcome to Claire's Cars, Northampton's specialist in classic and import cars.</p>
	
	<ul>
			<?php
	// select data from the news 
	$sus_new = $pdo->prepare('SELECT * FROM news');
//    execute the selection process
	$sus_new->execute();
// fetch data from news in list
	$news = $sus_new->fetchAll();
	echo "Latest Cars which has been posted recently:  ";
	foreach($news as $news)
	{

		echo '<br>';
		echo '<li>';

		
		echo '<div class="details">';
		echo '<h2>' . $news['title']. '</h2>';
		echo '<h3>' . $news['description'] . '</h3>';
		echo 'Date Posted:' .$news['date'];

		echo '</div>';
		echo '</li>';
	
} 
	?>
		</ul>
		</main>
	<?php
	// to load the footer 
include 'templates/footer.php';
?>