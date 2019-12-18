<?php require_once(__DIR__.'/includes/top.php'); ?>

<h1>Inventory</h1>


<section class="inventory_list">
<form action="inventory.php">
    <input type="text" id="index_search" placeholder="Search...">
    </form>
<?php
$sjInventory = file_get_contents(__DIR__.'/json/inventory.json');
$jInventory = json_decode($sjInventory);
$aInventory = [];
foreach($jInventory as $key => $jItem) {
    $jNewItem = $jItem;
    $jNewItem->id = $key;
    array_push($aInventory, $jNewItem);
}
usort($aInventory, 'sortInventoryByExpiration');
function sortInventoryByExpiration($a, $b) {
	if($a->expire == $b->expire){ return 0 ; }
	return ($a->expire < $b->expire) ? -1 : 1;
}
foreach($aInventory as $item) {
    ?>
    <div class="item_container">
        <div>
            <h2 class="name"><?= $item->name ?></h2>
            <p class="amount"><?= $item->amount.$item->suffix ?></p>
            <p class="days_until_expire">Expires in <?= $item->expire ?> days</p>
        </div>
        <div>
            <a href="edit-inventory-item.php?id=<?= $item->id ?>" class="edit">Edit grocery</a>
            <a href="API/delete-inventory-item.php?id=<?= $item->id ?>" class="delete">Delete</a>
        </div>
        <button class="options">Update</button>
    </div>
    <?php
}
?>
</section>

<a href="add-to-fridge.php" id="add_button">
    <div class="line"></div>
    <div class="line"></div>
</a>

<script src="js/inventory.js"></script>
<?php require_once(__DIR__.'/includes/bottom.php'); ?>