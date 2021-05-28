<?php 
if(!isset($_SESSION['login'])){ ?>
	<form method="POST" >
		<input type="text" name="korisnicko_ime" placeholder="Email" />
		<input type="password" name="lozinka" placeholder="Лозинка" />
		<input type="submit" name="login" value="Пријави се" />
	</form>
<?php } else { ?>
	<a href="logout.php">Одјави се</a>
<?php } ?>
<?php if(isset($_SESSION['login'])){ ?>
<?php if ($_SESSION['tip'] == 1){ ?>
<a href="add_zaposleni.php">Додај запосленог</a>
<a href="add_student.php">Додај студента</a>
<a href="add_predmet.php">Додај предмет</a>
<a href="add_obavestenje.php">Додај обавештење</a>
<?php } else if ($_SESSION['tip'] == 2) { ?>
<a href="add_predavanje.php">Додај предавање</a>
<?php }} ?>


<?php 

	if(isset($_POST['login'])){
		$korisnicko_ime = $_POST['korisnicko_ime'];
		$lozinka = md5($_POST['lozinka']);
		$rez = $conn->getKorisnik($korisnicko_ime,$lozinka);

		if($rez){
			$_SESSION['id'] = $rez['id'];
			$_SESSION['korisnicko_ime'] = $rez['username'];
			$_SESSION['tip'] = $rez['tip'];
			$_SESSION['login'] = TRUE;
		}
		
		header('Location: index.php');
	}

?>
<?php if(isset($_SESSION['login'])){ ?>
	
<p><?php echo $_SESSION['tip']; ?></p>
<?php }else{ ?>
<p>[нерегистровани корисник]</p>
<?php } ?>