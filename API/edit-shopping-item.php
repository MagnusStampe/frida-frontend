<?php
$sjInventory = file_get_contents(__DIR__.'/../json/shopping-list.json');
$jInventory = json_decode($sjInventory);

$cID = $_GET['id'];

$jInventory->$cID->name = $_GET['name'];
$jInventory->$cID->suffix = $_GET['suffix'];
$jInventory->$cID->amount = $_GET['amount'];

$sjInventory = json_encode($jInventory);
echo $cID;
var_dump($jInventory->$cID);
file_put_contents(__DIR__.'/../json/shopping-list.json', $sjInventory);
header('Location: ../shopping-list.php');
