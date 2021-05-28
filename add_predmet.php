<?php 
//require('config/klase.php');
require('header.php');
?>
    <script src="ckeditor/ckeditor.js"></script>

<?php //require('errorlogin.php'); ?>

<h1>додавање предмета</h1>
<?php if(isset($_SESSION['login'])){ ?>

<form method="POST" >
    <?php $nastavnici = $conn->getSviZaposleni(); ?>
    <select name="id_nastavnik">
    <?php
        foreach($nastavnici as $nastavnik){
            echo "<option value=$nastavnik[0]>$nastavnik[2] $nastavnik[3]</option>";
        }
    ?>
    </select>
    <br>
	<input type="text" name="ime" placeholder="ime" /> ime<br>
	<input type="text" name="tip" placeholder="tip" /> tip (1=obavezni, 2=izborni)<br>
	<input type="text" name="sifra" placeholder="sifra" /> sifra<br>
	<input type="text" name="espb" placeholder="espb" /> espb<br>
    cilj i ishod predmeta: <br>
    <textarea placeholder="cilj_i_ishod_predmeta" name="cilj_i_ishod_predmeta" id="text"></textarea><br>
	<input type="text" name="fond_casova" placeholder="fond_casova" /> fond_casova<br>
    termini: <br>
    <textarea placeholder="termini" name="termini" id="text2"></textarea><br>
    komentar: <br>
    <textarea placeholder="komentar" name="komentar" id="text3"></textarea><br>
	<input type="text" name="studije" placeholder="studije" /> studije (1=osnovne, 2=master)<br>
	<!--<input type="file" name="file" placeholder="file" /> fajl<br>-->

	<input type="submit" name="add"	value="додај предавање" />
</form>

<?php 

	if(isset($_POST['add'])){
		$id_nastavnik = $_POST['id_nastavnik'];
		$ime = $_POST['ime'];
		$tip = $_POST['tip'];
		$sifra = $_POST['sifra'];
		$espb = $_POST['espb'];
		$cilj_i_ishod_predmeta = $_POST['cilj_i_ishod_predmeta'];
		$fond_casova = $_POST['fond_casova'];
		$termini = $_POST['termini'];
		$komentar = $_POST['komentar'];
		$studije = $_POST['studije'];
		//$file = $_POST['file'];
		
		$conn->addPredmet($id_nastavnik,$ime,$tip,$sifra,$espb,$cilj_i_ishod_predmeta,$fond_casova,$termini,$komentar,$studije);
	}

?>

<?php }else{ ?>
<h1>Ниси улогован</h1>
<?php } ?>

<script>
 CKEDITOR.replace( 'text' );
 CKEDITOR.replace( 'text2' );
 CKEDITOR.replace( 'text3' );
</script>

<?php require('footer.php'); ?>