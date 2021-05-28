<?php 
//require('config/klase.php');
require('header.php');
?>
    <script src="ckeditor/ckeditor.js"></script>

<?php //require('errorlogin.php'); ?>

<h1>додавање предавања</h1>
<?php if(isset($_SESSION['login'])){ ?>

<form method="POST" >
	<input type="text" name="id_predmeta" placeholder="id_predmeta" /> ид предмета<br>
	<input type="text" name="naslov" placeholder="naslov" /> наслов<br>
	<input type="file" name="file" placeholder="file" /> fajl<br>

	<input type="submit" name="add"	value="додај предавање" />
</form>

<?php 

	if(isset($_POST['add'])){
		$id_predmeta = $_POST['id_predmeta'];
		$naslov = $_POST['naslov'];
		$file = $_POST['file'];
		
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