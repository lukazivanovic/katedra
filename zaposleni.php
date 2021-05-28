<?php 
//require('config/klase.php');
require('header.php');

$zap = $conn->getSviZaposleni();
?>

<h1>ЗАПОСЛЕНИ</h1>

<ul>
<?php
if($zap!=false){
foreach($zap as $zaposleni){ ?>
	<?php echo $zaposleni[2]." ".$zaposleni[3]." (".$zaposleni[8].")"; ?>
	<?php if(isset($_SESSION['login'])){ ?> 
		- <a href="zap.php?id=<?php echo $zaposleni[0] ?>">линк</a>
	<?php }?>
	<br>
<?php
}}
?>
</ul>

<?php require('footer.php'); ?>