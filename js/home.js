inventoryBtn = document.querySelector('#toggle_inventory');
shoppingBtn = document.querySelector('#toggle_shopping');
rightSection = document.querySelector('#right_section');

inventoryBtn.addEventListener('click', () => {
    rightSection.classList.remove('shopping');
});
shoppingBtn.addEventListener('click', () => {
    rightSection.classList.add('shopping');
});