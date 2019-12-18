<?php require_once(__DIR__.'/includes/top.php'); ?>
<?php
    $sjInventory = file_get_contents(__DIR__.'/json/shopping-list.json');
    $jInventory = json_decode($sjInventory);
    
    $cID = $_GET['id'];
    $jItem = $jInventory->$cID;
?>
<h1>Edit <?= $jItem->name ?></h1>
<form id="add_container" action="API/edit-shopping-item.php">
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
    <input type="hidden" name="id" value="<?= $cID ?>">
    <button>Edit</button>
</form
<?php require_once(__DIR__.'/includes/bottom.php'); ?>