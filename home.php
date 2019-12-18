<?php require_once(__DIR__.'/includes/top.php'); ?>
<main id="home">
<section id="home_cards">
    <div class="card dish_of_the_day">
    <a class="header_link" href="recipe.php?id=R1">    
        <p>Dish of the day</p>
        <h2>Spagetti carbonara</h2>
    </a>
        <div class="bottom_container">
            <a href="recipe.php?id=R1">View recipe</a>
            <a href="shopping-list.php?id=R1">Add to shopping list</a>
        </div>
        <div class="overlay"></div>
        <img src="content/images/carbonara.jpg" alt="image">
    </div>
    <div class="card recipes">
        <a class="header_link" href="recipes.php">
            <h2>Recipes</h2>
        </a>
        <div class="bottom_container">
            <form action="recipes.php">
                <input type="text" placeholder="Search...">
                <button class="search"></button>
            </form>
            <a href="recipes.php" class="view_more">View more</a>
        </div>
        <div class="overlay"></div>
        <img src="content/images/burger.jpg" alt="image">
    </div>
    <div class="card inventory">
        <a class="header_link" href="inventory.php">
            <h2>Inventory</h2>
        </a>
        <div class="bottom_container">
            <a href="add-to-fridge.php">Add grocery</a>
            <a href="inventory.php">View inventory</a>
        </div>
        <div class="overlay"></div>
        <img src="content/images/duck.jpg" alt="image">
    </div>
    <div class="card shopping_listlist">
        <a class="header_link" href="shopping-list.php">
            <h2>Shopping list</h2>
        </a>
        <div class="bottom_container">
            <a href="add-to-shopping-list.php">Add item</a>
            <a href="shopping-list.php">View shopping list</a>
        </div>
        <div class="overlay"></div>
        <img src="content/images/lasagna.jpg" alt="image">
    </div>
</section>
<section id="right_section">
    <form action="inventory.php">
    <input type="text" id="index_search" placeholder="Search...">
    </form>
    <button id="toggle_inventory">Inventory</button>
    <button id="toggle_shopping">Shopping list</button>
    <div class="inventory_list">
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
</div>
<div class="inventory_list">
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
</div>
</section>
</main>

<script src="js/home.js"></script>
<script src="js/inventory.js"></script>
<?php require_once(__DIR__.'/includes/bottom.php'); ?>