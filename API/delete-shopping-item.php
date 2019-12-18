<?php
$sjInventory = file_get_contents(__DIR__.'/../json/shopping-list.json');
$jInventory = json_decode($sjInventory);

$cID = $_GET['id'];
unset($jInventory->$cID);

$sjInventory = json_encode($jInventory);
file_put_contents(__DIR__.'/../json/shopping-list.json', $sjInventory);

header('Location: ../shopping-list.php');
