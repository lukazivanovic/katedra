<?php require('config/klase.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<ul id=navigacija>
  <li><a href="index.php">почетна</a></li>
  <li><a href="zaposleni.php">запослени</a></li>
  <li><a href="obavestenja.php">обавештења</a></li>
  <li><a href="osnovnestudije.php">основне студије</a></li>
  <li><a href="masterstudije.php">мастер студије</a></li>
  <li><a href="projekti.php">пројекти</a></li>
  <li><a href="servisi.php">сервиси</a></li>
  <li><a href="kontakt.php">контакт</a></li>
</ul>

<?php include("blocks/login.php") ?>