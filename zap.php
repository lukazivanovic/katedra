<?php 
require('header.php');

//require('config/klase.php');
$id = $_GET['id'];

$zap = $conn->getZaposleni($id);

?>

<h2><?php echo $zap['ime']." ".$zap['prezime']; ?></h2>
<p>
    <?php echo "адреса: ".$zap['adresa']; ?><br>
    <?php echo "број телефона: ".$zap['broj_telefona']; ?><br>
    <?php echo "веб сајт: "."<a href='".$zap['veb_sajt']."'>".$zap['veb_sajt']."</a>"; ?><br>
    <?php echo "лични подаци: ".$zap['licni_podaci']; ?><br>
    <?php echo "звање: ".$zap['zvanje']; ?><br>
    <?php echo "број кабинета: ".$zap['broj_kabineta']; ?><br>
    <?php echo "статус: "; if($zap['status']==1) echo "активан"; else if($zap['status']==2) echo "неактиван"; ?><br>
    <img src="slike/<?php echo $zap['slika']; ?>" width="300" height="300" alt=""><br>
</p>

<?php require('footer.php'); ?>