<?php require_once(__DIR__.'/includes/top.php'); ?>
<div id="recipe_container">
    <?php
    if(empty($_GET)) {
        header('Location: home.php');
        exit;
    }
    if(empty($_GET['id'])) {
        header('Location: home.php');
        exit;
    }
    $nIngredients = 0;
    $nInFridge = 0;
    $sjRecipes = file_get_contents(__DIR__.'/json/recipes.json');
    $jRecipes = json_decode($sjRecipes);
    $cID = $_GET['id'];
    $jRecipe = $jRecipes->$cID;
    if(!$jRecipe){
        header('Location: home.php');
        exit;
    }
    ?>
    <section id="recipe_splash">
        <img src="content/images/<?= $jRecipe->imageUrl ?>" alt="<?= $jRecipe->name ?>">
    </section>
    <section id="recipe_ingredients">
        <h1><?= $jRecipe->name ?></h1>
        <ul>
            <?php
            foreach($jRecipe->ingredients as $jIngredient) {
                $nIngredients = $nIngredients + 1;
                ?>
                <li>
                    <p><?= $jIngredient->amount.$jIngredient->suffix ?></p><p><?= $jIngredient->name ?></p>
                    <?php
                    $sjInventory = file_get_contents('json/inventory.json');
                    $jInventory = json_decode($sjInventory);
                    foreach($jInventory as $jInventoryItem) {
                        if($jIngredient->name === $jInventoryItem->name) {
                            $nInFridge = $nInFridge + 1;
                            ?>
                            <div class="checkmark"></div>
                            <?php
                        }
                    }
                    ?>
                </li>
                <?php
            }
            ?>
        </ul>
    </section>
    <section id="recipe_etc">
        <p><?= $jRecipe->description ?></p>
        <?php
        ?>
        <form action="shopping-list.php">
            <input type="hidden" name="id" value="<?= $cID ?>">
            <a href="recipes.php" class="return">Return to recipes</a>
            <?php
            if($nInFridge !== $nIngredients) {
            ?>
            <button class="add">Add to shopping list</button>
            <?php
            }
            ?>
            </form>
    </section>
</div>
<?php require_once(__DIR__.'/includes/bottom.php'); ?>
