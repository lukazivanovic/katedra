<?php 
//require('config/klase.php');
require('header.php');
?>
    <script src="ckeditor/ckeditor.js"></script>

<?php //require('errorlogin.php'); ?>

<h1>додавање студента</h1>
<?php if(isset($_SESSION['login'])){ ?>

<form method="POST" >
	<!--<input type="text" name="tip" placeholder="tip" /> тип (3=ученик, 2=запослени, 1=администратор)<br>-->
	<input type="text" name="korisnicko_ime" placeholder="korisnicko_ime" /> корисничко име<br>
	<input type="text" name="lozinka" placeholder="lozinka" /> лозинка<br>
	<input type="text" name="indeks" placeholder="indeks" /> индекс<br>
	<input type="text" name="tip_studija" placeholder="tip_studija" /> тип студија (d: основне академске, m: мастер академске, p: докторске студије)<br>
	<input type="text" name="ime" placeholder="ime" /> име<br>
	<input type="text" name="prezime" placeholder="prezime" /> презиме<br>
	<input type="text" name="status" placeholder="status" /> статус (1=активан, 2=неактиван)<br>
	<input type="submit" name="add"	value="додај студента" />
</form>

<?php 

	if(isset($_POST['add'])){
		$korisnicko_ime = $_POST['korisnicko_ime'];
		$lozinka = md5($_POST['lozinka']);
		$indeks = $_POST['indeks'];
		$tip_studija = $_POST['tip_studija'];
		$ime = $_POST['ime'];
		$prezime = $_POST['prezime'];
		$status = $_POST['status'];

		$korisnik = $conn->getKorisnik($korisnicko_ime,$lozinka);
		if(!$korisnik){
			$conn->addStudentLogin($korisnicko_ime,$lozinka);
			$korisnik = $conn->getKorisnik($korisnicko_ime,$lozinka);
			$id_korisnika = $korisnik['id'];
			$conn->addStudent($id_korisnika,$indeks,$tip_studija,$ime,$prezime,$status);
			echo "student uspesno dodat";
		}else{
			echo "vec postoji";
		}
	}

?>

<?php }else{ ?>
<h1>Ниси улогован</h1>
<?php } ?>

<script>
 CKEDITOR.replace( 'text' );
</script>

<?php require('footer.php'); ?>