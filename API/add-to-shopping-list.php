<?php
$sjInventory = file_get_contents(__DIR__.'/../json/shopping-list.json');
$jInventory = json_decode($sjInventory);

$jNewItem = new stdClass();
$jNewItem->name = $_GET['name'];
$jNewItem->suffix = $_GET['suffix'];
$jNewItem->amount = $_GET['amount'];

$cSlug = 'I'.rand(100,1000);

$jInventory->$cSlug = $jNewItem;
$sjInventory = json_encode($jInventory);

file_put_contents(__DIR__.'/../json/shopping-list.json', $sjInventory);
header('Location: ../shopping-list.php');
