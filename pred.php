<?php 
require('header.php');

//require('config/klase.php');
$id = $_GET['id'];

$pred = $conn->getPredmet($id);
$obavestenja = $conn->getObavestenja($id);
?>

<h2><?php echo $pred['ime']; ?></h2>
<p>
    <?php echo "тип: "; if($pred['tip']==1) echo "обавезни"; else if($pred['tip']==2) echo "изборни"; ?><br>
    <?php echo "шифра: ".$pred['sifra']; ?><br>
    <?php echo "еспб: ".$pred['espb']; ?><br>
    <?php echo "циљ и исход предмета: ".$pred['cilj_i_ishod_predmeta']; ?><br>
    <?php echo "фонд часова: ".$pred['fond_casova']; ?><br>
    <?php echo "термини: ".$pred['termini']; ?><br>
    <?php echo "коментар: ".$pred['komentar']; ?><br>
</p>

<?php
    if($obavestenja==false){
    echo "Нема коментара.";
}else{
    echo "<h2>Обавештења:</h2>";
    foreach($obavestenja as $obavestenje){
        echo $obavestenje[4]."<br>".$obavestenje[2]."<br>".$obavestenje[3]."<br><br>";
    }
}
?>

<?php require('footer.php'); ?>