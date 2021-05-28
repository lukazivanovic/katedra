<?php 
//require('config/klase.php');
require('header.php');
?>
    <script src="ckeditor/ckeditor.js"></script>

<?php //require('errorlogin.php'); ?>

<h1>додавање обавештења</h1>
<?php if(isset($_SESSION['login'])){ ?>

<form method="POST" >
	<input type="text" name="id_predmeta" placeholder="id_predmeta" /> ид предмета<br>
	<input type="text" name="naslov" placeholder="naslov" /> наслов<br>
	садржај:
	<textarea placeholder="sadrzaj" name="sadrzaj" id="text"></textarea><br>
	<input type="date" name="datum_objave" placeholder="datum_objave" /> датум објаве<br>
	<input type="submit" name="add"	value="додај обавештење" />
</form>

<?php 

	if(isset($_POST['add'])){
		//$tip = $_POST['tip'];
		$id_predmeta = $_POST['id_predmeta'];
		$naslov = $_POST['naslov'];
		$sadrzaj = $_POST['sadrzaj'];
		$datum_objave = $_POST['datum_objave'];
		
		$conn->addObavestenje($id_predmeta,$naslov,$sadrzaj,$datum_objave);
	}

?>

<?php }else{ ?>
<h1>Ниси улогован</h1>
<?php } ?>

<script>
 CKEDITOR.replace( 'text' );
</script>

<?php require('footer.php'); ?>