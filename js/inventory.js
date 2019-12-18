const itemContainers = document.querySelectorAll('.item_container');
itemContainers.forEach(item => {
    item.addEventListener('click', () => {
        toggleCard(item);
    });
});

function toggleCard(element) {
    let isOpen = false;
    if (element.classList.contains('open_card')) {
        isOpen = true;
    }
    const openElements = document.querySelectorAll('.open_card');
    openElements.forEach(element => {
        element.classList.remove('open_card');
    });
    if (!isOpen) {
        element.classList.add('open_card');
    }
}
