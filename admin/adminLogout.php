<main class="admin">

<?php
	//when submit button is pressed 
if (isset($_POST['submit'])){
    //when logged in as admin 
    if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] == true) {
    session_destroy();
    }


?>
<section class="right">
<h2>You are now logged out</h2>
</section>
<?php
}
?>
<?php
include '../index.php';
?>
</main>