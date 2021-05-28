<?php
 class Konekcija {
	private $host;
	private $username;
	private $password;
	private $baza;
	private $konekt;
	
	function __construct($host,$username,$password,$baza){
		$this->host=$host;
		$this->username=$username;
		$this->password=$password;
		$this->baza=$baza;
		$this->konekt=new mysqli($this->host, $this->username,$this->password, $this->baza);
		mysqli_set_charset( $this->konekt, 'utf8');
	}

	function addZaposleni($id_korisnika,$ime,$prezime,$adresa,$broj_telefona,$veb_sajt,$licni_podaci,$zvanje,$br_kabineta,$status,$pic){
		$stmt=$this->konekt->prepare("insert into zaposleni(id_korisnika,ime,prezime,adresa,broj_telefona,veb_sajt,licni_podaci,zvanje,broj_kabineta,status,slika) values(?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("isssssssiss",$id_korisnika,$ime,$prezime,$adresa,$broj_telefona,$veb_sajt,$licni_podaci,$zvanje,$br_kabineta,$status,$pic);
		$stmt->execute();
		$stmt->close();
	}
	function addZaposleniLogin($korisnicko_ime,$lozinka){
		$stmt=$this->konekt->prepare("insert into korisnik(username,password,tip) values(?,?,2)");
		$stmt->bind_param("ss",$korisnicko_ime,$lozinka);
		$stmt->execute();
		$stmt->close();
	}

	function addStudent($id_korisnika,$indeks,$tip_studija,$ime,$prezime,$status){
		$stmt=$this->konekt->prepare("insert into student(id_korisnika,indeks,tip_studija,ime,prezime,status) values(?,?,?,?,?,?)");
		$stmt->bind_param("isssss",$id_korisnika,$indeks,$tip_studija,$ime,$prezime,$status);
		$stmt->execute();
		$stmt->close();
	}
	function addStudentLogin($korisnicko_ime,$lozinka){
		$stmt=$this->konekt->prepare("insert into korisnik(username,password,tip) values(?,?,3)");
		$stmt->bind_param("ss",$korisnicko_ime,$lozinka);
		$stmt->execute();
		$stmt->close();
	}


	function addPredmet($id_nastavnik,$ime,$tip,$sifra,$espb,$cilj_i_ishod_predmeta,$fond_casova,$termini,$komentar,$studije){
		$stmt=$this->konekt->prepare("insert into predmet(id_nastavnik,ime,tip,sifra,espb,cilj_i_ishod_predmeta,fond_casova,termini,komentar,studije) values(?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("isssisissi",$id_nastavnik,$ime,$tip,$sifra,$espb,$cilj_i_ishod_predmeta,$fond_casova,$termini,$komentar,$studije);
		$stmt->execute();
		$stmt->close();
	}

	function addObavestenje($id_predmeta,$naslov,$sadrzaj,$datum_objave){
		$stmt=$this->konekt->prepare("insert into obavestenje(id_predmeta,naslov,sadrzaj,datum_objave) values(?,?,?,?)");
		$stmt->bind_param("isss",$id_predmeta,$naslov,$sadrzaj,$datum_objave);
		$stmt->execute();
		$stmt->close();
	}

	function getObavestenja($id){
		$stmt=$this->konekt->prepare("SELECT * FROM obavestenje WHERE id_predmeta=?");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$obavestenja = $stmt->get_result();
		$obav = $obavestenja->fetch_all();
		if($obavestenja->num_rows > 0){
			return $obav;
		} else {
			return false;
		}
		$stmt->close();
	}

	function getKorisnik($korisnicko_ime,$lozinka){
		$stmt=$this->konekt->prepare("SELECT * FROM korisnik WHERE username=? AND password=?");
		$stmt->bind_param("ss",$korisnicko_ime,$lozinka);
		$stmt->execute();
		$korisnici = $stmt->get_result();
		$korisnik = $korisnici->fetch_assoc();
		if($korisnici->num_rows > 0){
			return $korisnik;
		} else {
			return false;
		}
		$stmt->close();
	}









	function getStrane(){	
		$stmt=$this->konekt->prepare("SELECT * FROM strane");
		$stmt->execute();
		$strane = $stmt->get_result();
		$str = $strane->fetch_all();
		if($strane->num_rows > 0){
			return $str;
		} else {
			return false;
		}
	}

	function getZaposleni($id){
		$stmt=$this->konekt->prepare("SELECT * FROM zaposleni WHERE id=?");
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$zaposleni = $stmt->get_result();
		$zap = $zaposleni->fetch_assoc();
		return $zap;
		$stmt->close();
	}

	function getPredmet($id){
		$stmt=$this->konekt->prepare("SELECT * FROM predmet WHERE id=?");
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$predmeti = $stmt->get_result();
		$pred = $predmeti->fetch_assoc();
		return $pred;
		$stmt->close();
	}


	function register($ime,$email,$lozinka,$tip){
		$stmt=$this->konekt->prepare("insert into korisnici(ime_prezime, email,lozinka,tip_korisnika) values(?,?,?,?)");
		$stmt->bind_param("sssi",$ime,$email,$lozinka,$tip);
		$stmt->execute();
	}

	function adminIndexLogin($email,$lozinka){
		$stmt=$this->konekt->prepare("SELECT * FROM korisnici WHERE email=? AND lozinka=? AND tip_korisnika=1");
		$stmt->bind_param("ss", $email,$lozinka);
		$stmt->execute();
		$rezultat=$stmt->get_result();

		if($rezultat->num_rows > 0){
			$rez=$rezultat->fetch_assoc();
			$_SESSION['id']= $rez['id'];
			$_SESSION['ime'] = $rez['ime_prezime'];
			$_SESSION['login'] = TRUE;
			return $rez;
		}else {
			echo "ГРЕШКА";
		}
	}

	/*function login($email,$lozinka){
		$stmt=$this->konekt->prepare("SELECT * FROM korisnici WHERE email=? AND lozinka=?");
		$stmt->bind_param("ss", $email,$lozinka);
		$stmt->execute();
		$rezultat=$stmt->get_result();
		$rez = $rezultat->fetch_assoc();
		return $rez;
	}*/

	function getKomentari($id){
		$stmt=$this->konekt->prepare("SELECT * FROM komentari WHERE id_strana=? AND status=1");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$komentari = $stmt->get_result();
		$komentar = $komentari->fetch_all();
		if($komentari->num_rows > 0){
			return $komentar;
		} else {
			return false;
		}
	}

	function deletePage($id){
		$stmt=$this->konekt->prepare("DELETE from strane where id_strana=?");
		$stmt->bind_param("i",$id);
		$stmt->execute();
		return true;
	}

	function updatePage($naslov,$sadrzaj,$autor,$id){
		$stmt=$this->konekt->prepare("UPDATE strane SET naslov=?, sadrzaj=?, autor=? WHERE id_strana=?");
		$stmt->bind_param("ssii",$naslov,$sadrzaj,$autor,$id);
		$stmt->execute();
	}

	function selectStrana($id){
		$stmt=$this->konekt->prepare("SELECT * FROM strane WHERE id_strana=?");
		$stmt->execute();
		$strane = $stmt->get_result();
		$strana = $strane->fetch_all();
		return $strana;
	}

	function insertKomentar($id,$sadrzaj,$ime){
		$stmt=$this->konekt->prepare("INSERT INTO komentari (id_strana, sadrzaj, status, ime)VALUES(?,?,0,?)");
		$stmt->bind_param("iss",$id,$sadrzaj,$ime);
		$stmt->execute();
	}

	function selectKorisnik(){
		$stmt=$this->konekt->prepare("SELECT * FROM tip_korisnika");
		$stmt->execute();
		$tipovi = $stmt->get_result();
		$korisnici = $tipovi->fetch_all();
		if($tipovi->num_rows > 0){
			return $korisnici;
		} else {
			return false;
		}
	}

	function getSviZaposleni(){
		$stmt=$this->konekt->prepare("SELECT * FROM zaposleni");
		$stmt->execute();
		$zaposleni = $stmt->get_result();
		$zap = $zaposleni->fetch_all();
		return $zap;
	}

	function getOsnоvniPredmeti(){
		$stmt=$this->konekt->prepare("SELECT * FROM predmet WHERE studije=1");
		$stmt->execute();
		$predmeti = $stmt->get_result();
		$pred = $predmeti->fetch_all();
		return $pred;
	}

	function getMasterPredmeti(){
		$stmt=$this->konekt->prepare("SELECT * FROM predmet WHERE studije=2");
		$stmt->execute();
		$predmeti = $stmt->get_result();
		$pred = $predmeti->fetch_all();
		return $pred;
	}

	function deleteKomentar($id){
		$stmt=$this->konekt->prepare("DELETE from komentari where id=?");
		$stmt->bind_param("i",$id);
		$stmt->execute();
		return true;
	}

	function editKomentar($id){
		$stmt=$this->konekt->prepare("UPDATE komentari SET status=1 WHERE id=?");
		$stmt->bind_param("i",$id);
		$stmt->execute();
		return true;
	}
}

$conn = new Konekcija('localhost','root','','katedra');

session_start();
?>

