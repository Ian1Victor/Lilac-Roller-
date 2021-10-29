<?php
$dbh = new PDO('mysql:host=localhost;dbname=loja','root','');
$sql = "SELECT * FROM usuarios ";
$stmt = $dbh->prepare($sql);
$stmt -> execute();

echo ($stmt);