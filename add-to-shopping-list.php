<?php require_once(__DIR__.'/includes/top.php'); ?>
<h1>Add item to shopping list</h1>
<form id="add_container" action="API/add-to-shopping-list.php">
    <input name="name" type="text" placeholder="Name" required>
    <select name="suffix">
        <option value="Unit(s)">Unit</option>
        <option value="G">Gram (G)</option>
        <option value="KG">Kilogram (KG)</option>
        <option value="L">Liter (L)</option>
        <option value="DL">Deciliter (DL)</option>
        <option value="">Undefined</option>
    </select>
    <input name="amount" type="text" placeholder="Amount" required>
    <button>Add</button>
</form
<?php require_once(__DIR__.'/includes/bottom.php'); ?>