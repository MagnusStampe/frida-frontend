<?php require_once(__DIR__.'/includes/top.php'); ?>
<h1>Add item to inventory</h1>
<form id="add_container" action="API/add-to-fridge.php">
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
    <select name="category" placeholder="undefined category">
        <option value="undefined">Undefined category</option>
        <option value="meat">Meat</option>
        <option value="dairy">Dairy</option>
        <option value="fruit">Fruit</option>
        <option value="vegatable">Vegatable</option>
        <option value="liquid">Liquid</option>
        <option value="etc">Etc</option>
    </select>
    <input name="expiration" type="text" placeholder="Days until expiration" required>
    <button>Add</button>
</form
<?php require_once(__DIR__.'/includes/bottom.php'); ?>