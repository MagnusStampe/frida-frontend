<?php require_once(__DIR__.'/includes/top.php'); ?>
<?php
    $sjInventory = file_get_contents(__DIR__.'/json/inventory.json');
    $jInventory = json_decode($sjInventory);
    
    $cID = $_GET['id'];
    $jItem = $jInventory->$cID;
?>
<h1>Edit <?= $jItem->name ?></h1>
<form id="add_container" action="API/edit-inventory-item.php">
    <input name="name" type="text" placeholder="Name" value="<?= $jItem->name ?>" required>
    <select name="suffix">
        <option value="Unit(s)">Unit</option>
        <option value="G">Gram (G)</option>
        <option value="KG">Kilogram (KG)</option>
        <option value="L">Liter (L)</option>
        <option value="DL">Deciliter (DL)</option>
        <option value="">Undefined</option>
    </select>
    <input name="amount" type="text" placeholder="Amount" value="<?= $jItem->amount ?>" required>
    <select name="category" placeholder="undefined category">
        <option value="undefined">Undefined category</option>
        <option value="meat">Meat</option>
        <option value="dairy">Dairy</option>
        <option value="fruit">Fruit</option>
        <option value="vegatable">Vegatable</option>
        <option value="liquid">Liquid</option>
        <option value="etc">Etc</option>
    </select>
    <input name="expiration" type="text" placeholder="Days until expiration" value="<?= $jItem->expire ?>" required>
    <input type="hidden" name="id" value="<?= $cID ?>">
    <button>Edit</button>
</form
<?php require_once(__DIR__.'/includes/bottom.php'); ?>