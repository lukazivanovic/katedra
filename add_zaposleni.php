<?php 
//require('config/klase.php');
require('header.php');
?>
    <script src="ckeditor/ckeditor.js"></script>

<?php //require('errorlogin.php'); ?>

<h1>додавање запосленог</h1>
<?php if(isset($_SESSION['login'])){ ?>

<form method="POST" enctype="multipart/form-data">
	<input type="text" name="korisnicko_ime" placeholder="korisnicko_ime" /> корисничко име<br>
	<input type="text" name="lozinka" placeholder="lozinka" /> лозинка<br>
	<input type="text" name="ime" placeholder="ime" /> име<br>
	<input type="text" name="prezime" placeholder="prezime" /> презиме<br>
	<input type="text" name="adresa" placeholder="adresa" /> адреса<br>
	<input type="text" name="broj_telefona" placeholder="broj_telefona" /> контакт број<br>
	<input type="text" name="veb_sajt" placeholder="veb_sajt" /> веб сајт<br>
	лични подаци:
	<textarea placeholder="licni_podaci" name="licni_podaci" id="text"></textarea><br>
	<select name="zvanje">
		<option>редовни професор</option>
		<option>ванредни професор</option>
		<option>доцент</option>
		<option>асистент</option>
		<option>сарадник у настави</option>
		<option>истраживач</option>
		<option>лабораторијски инжењер</option>
		<option>лабораторијски техничар</option>
	</select> звање<br>
	<input type="number" name="br_kabineta" placeholder="br_kabineta" /> број кабинета<br>
	<input type="text" name="status" placeholder="status" /> статус (1=активан, 2=неактиван)<br>
<!--slika-->
<input type="file" name="slika" value="">
	<input type="submit" name="add"	value="додај корисника" />
</form>

<?php 



	if(isset($_POST['add'])){
		//$tip = $_POST['tip'];
		$korisnicko_ime = $_POST['korisnicko_ime'];
		$lozinka = md5($_POST['lozinka']);
		$ime = $_POST['ime'];
		$prezime = $_POST['prezime'];
		$adresa = $_POST['adresa'];
		$broj_telefona = $_POST['broj_telefona'];
		$veb_sajt = $_POST['veb_sajt'];
		$licni_podaci = $_POST['licni_podaci'];
		$zvanje = $_POST['zvanje'];
		$br_kabineta = $_POST['br_kabineta'];
		$status = $_POST['status'];

		$imgName = $_FILES['slika']['name'];
		$imgTmp = $_FILES['slika']['tmp_name'];
		$imgSize = $_FILES['slika']['size'];

		$upload_dir = 'slike/';

		$error = 1;
		$slikaMsg = "";

		$imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
		$allowExt  = array('jpeg', 'jpg', 'png', 'gif');
		$pic = time().'_'.rand(1000,9999).'.'.$imgExt;
		if(in_array($imgExt, $allowExt)){
			if($imgSize > 5000000){
				$error = 0;
				$slikaMsg .= ' Image too large';
			}
		}else{
			$error = 0;
			$slikaMsg .= ' Please select a valid image';
		}

		$korisnik = $conn->getKorisnik($korisnicko_ime,$lozinka);
		if(!$korisnik){
			$conn->addZaposleniLogin($korisnicko_ime,$lozinka);
			$korisnik = $conn->getKorisnik($korisnicko_ime,$lozinka);
			$id_korisnika = $korisnik['id'];
			$conn->addZaposleni($id_korisnika,$ime,$prezime,$adresa,$broj_telefona,$veb_sajt,$licni_podaci,$zvanje,$br_kabineta,$status,$pic);
			move_uploaded_file($imgTmp ,$upload_dir.$pic);
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