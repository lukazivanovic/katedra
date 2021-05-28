<?php 
//require('config/klase.php');
require('header.php');

$pred = $conn->getOsnоvniPredmeti();
?>

<h1>ОСНОВНЕ СТУДИЈЕ</h1>

<ul>
<?php
if($pred!=false){
foreach($pred as $predmeti){ ?>
	<?php echo $predmeti[2]; ?>
	<?php if(isset($_SESSION['login'])){ ?> 
		- <a href="pred.php?id=<?php echo $predmeti[0] ?>">линк</a>
	<?php }?>
	<br>
<?php
}}
?>
</ul>

<?php require('footer.php'); ?>