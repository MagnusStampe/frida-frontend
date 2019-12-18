<?php require_once(__DIR__.'/includes/top.php'); ?>
<?php
$sjList = file_get_contents(__DIR__.'/json/shopping-list.json');
$jList = json_decode($sjList);
if($_GET){
    if($_GET['id']) {
        $cID = $_GET['id'];
        $jMissingIngredients = new stdClass();
        $sjRecipes = file_get_contents(__DIR__.'/json/recipes.json');
        $sjInventory = file_get_contents(__DIR__.'/json/inventory.json');
        $jRecipes = json_decode($sjRecipes);
        $jInventory = json_decode($sjInventory);
        $jRecipe = $jRecipes->$cID;
        foreach($jRecipe->ingredients as $jIngredient) {
            $bInFridge = false;
            foreach($jInventory as $jInventoryItem) {
                if($jInventoryItem->name === $jIngredient->name) {
                    $bInFridge = true;
                }
            }
            if(!$bInFridge) {
                $cItemID = null;
                foreach($jList as $key => $jItem) {
                    if($jItem->name === $jIngredient->name) {
                        $cItemID = $key;
                    }
                }
                if($cItemID) {
                    $jList->$cItemID->amount = $jList->$cItemID->amount + $jIngredient->amount;
                } else {
                    $cNewKey = 'I'.rand(100 , 1000);
                    $jList->$cNewKey = $jIngredient;
                }
            }
        }
        $sjList = json_encode($jList);
        file_put_contents(__DIR__.'/json/shopping-list.json',$sjList);
        $sjMissingIngredients = json_encode($jMissingIngredients);
    }
}
?>
<h1>Shopping list</h1>
<section class="inventory_list">
    <?php
    foreach($jList as $key => $jItem) {
        ?>
        <div class="item_container">
            <h2><?= $jItem->name ?></h2>
            <p><?= $jItem->amount.$jItem->suffix ?></p>
            <button class="options">Update</button>
            <div>
                <a href="edit-shopping-item.php?id=<?= $key ?>" class="edit">Edit grocery</a>
                <a href="API/delete-shopping-item.php?id=<?= $key ?>" class="delete">Delete</a>
            </div>
        </div>
        <?php
    }
    ?>
</section>
<a href="add-to-shopping-list.php" id="add_button">
    <div class="line"></div>
    <div class="line"></div>
</a>
<script src="js/inventory.js"></script>
<?php require_once(__DIR__.'/includes/bottom.php'); ?>