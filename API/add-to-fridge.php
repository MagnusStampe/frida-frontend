<?php
$sjInventory = file_get_contents(__DIR__.'/../json/inventory.json');
$jInventory = json_decode($sjInventory);

$jNewItem = new stdClass();
$jNewItem->name = $_GET['name'];
$jNewItem->suffix = $_GET['suffix'];
$jNewItem->amount = $_GET['amount'];
$jNewItem->category = $_GET['category'];
$jNewItem->expire = $_GET['expiration'];

$cSlug = 'I'.rand(100,1000);

$jInventory->$cSlug = $jNewItem;
$sjInventory = json_encode($jInventory);

file_put_contents(__DIR__.'/../json/inventory.json', $sjInventory);
header('Location: ../inventory.php');
