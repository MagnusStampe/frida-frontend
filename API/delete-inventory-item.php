<?php
$sjInventory = file_get_contents(__DIR__.'/../json/inventory.json');
$jInventory = json_decode($sjInventory);

$cID = $_GET['id'];
unset($jInventory->$cID);

$sjInventory = json_encode($jInventory);
file_put_contents(__DIR__.'/../json/inventory.json', $sjInventory);

header('Location: ../inventory.php');
