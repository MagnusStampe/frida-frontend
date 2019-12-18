<?php require_once(__DIR__.'/includes/top.php'); ?>

<h1>Recipes</h1>

<?php
$sjRecipes = file_get_contents(__DIR__.'/json/recipes.json');
$jRecipes = json_decode($sjRecipes);
$sjInventory = file_get_contents(__DIR__.'/json/inventory.json');
$jInventory = json_decode($sjInventory);

$bMealsInFridge = false;
$jInFridge = new stdClass();
$jIngredientsNeeded = new stdClass();
foreach($jRecipes as $key => $jRecipe) {
    $jRecipeCard = new stdClass();
    $jRecipeCard->name = $jRecipe->name;
    $jRecipeCard->imageUrl = $jRecipe->imageUrl;
    $jRecipeCard->ingredientCount = 0;
    $jRecipeCard->ingredientsInFridge = 0;
    foreach($jRecipe->ingredients as $jIngredient) {
        $jRecipeCard->ingredientCount = $jRecipeCard->ingredientCount + 1;
        foreach($jInventory as $jInventoryItem) {
            if($jInventoryItem->name === $jIngredient->name) {
                $jRecipeCard->ingredientsInFridge = $jRecipeCard->ingredientsInFridge + 1;
            }
        }
    }
    if($jRecipeCard->ingredientCount === $jRecipeCard->ingredientsInFridge ){
        $jInFridge->$key = $jRecipeCard;
        $bMealsInFridge = true;
    } else {
        $jIngredientsNeeded->$key = $jRecipeCard;
    }
}

if($bMealsInFridge){
?>
    <form action="recipes.php" style="max-width:500px;margin:0 auto;">
    <input type="text" id="index_search" placeholder="Search...">
    </form>
<h2 class="recipes_header">Meals in your fridge</h2>
<section id="in_fridge" class="recipes_container">

<?php
foreach($jInFridge as $key => $jRecipe) {
    ?>
     <a class="recipe_card" href="recipe.php?id=<?= $key ?>">
        <h3><?= $jRecipe->name ?></h3>
        <p><?= $jRecipe->ingredientsInFridge ?> / <?= $jRecipe->ingredientCount ?></p>
        <div class="overlay"></div>
        <img src="content/images/<?= $jRecipe->imageUrl ?>" alt="<?= $jRecipe->name ?>">
    </a>
    <?php
}
}
?>
</section>
<h2 class="recipes_header">Needs shopping</h2>
<section id="not_in_fridge" class="recipes_container">
<?php
$aIngredientsNeeded = [];
foreach($jIngredientsNeeded as $key => $jRecipe) {
    $jNewItem = $jRecipe;
    $jNewItem->id = $key;
    $jNewItem->status = $jRecipe->ingredientsInFridge / $jRecipe->ingredientCount;
    array_push($aIngredientsNeeded, $jNewItem);
}
usort($aIngredientsNeeded, 'sortInventoryByExpiration');
function sortInventoryByExpiration($a, $b) {
    return $a->status == $b->status ? 0 : (
        $a->status > $b->status ? -1 : 1
    );
}
foreach($aIngredientsNeeded as $jRecipe) {
    ?>
        <a class="recipe_card" href="recipe.php?id=<?= $jRecipe->id ?>">
            <h3><?= $jRecipe->name ?></h3>
            <p><?= $jRecipe->ingredientsInFridge ?> / <?= $jRecipe->ingredientCount ?></p>
            <div class="overlay"></div>
            <img src="content/images/<?= $jRecipe->imageUrl ?>" alt="<?= $jRecipe->name ?>">
        </a>
    <?php
}
?>   
</section>
<?php require_once(__DIR__.'/includes/bottom.php'); ?>
